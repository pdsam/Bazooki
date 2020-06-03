-- noinspection SqlDialectInspectionForFile

DROP TABLE IF EXISTS bazooker CASCADE;
DROP TYPE IF EXISTS bazooker_status;
CREATE TYPE bazooker_status AS ENUM('deleted', 'live', 'suspended', 'banned');
CREATE TABLE bazooker(id BIGSERIAL PRIMARY KEY,
                      name text NOT NULL,
		              status bazooker_status NOT NULL DEFAULT 'live',
                      username TEXT UNIQUE NOT NULL,
                      password TEXT, 
                      email TEXT UNIQUE NOT NULL,
                      profile_pic TEXT, 
                      oauth TEXT,
                      description TEXT, 
                      trust_worthy BOOL NOT NULL DEFAULT TRUE,
                      remember_token VARCHAR(100),
                      CONSTRAINT pass_oauth_xor CHECK((oauth IS NOT NULL AND password  IS NULL) OR (oauth IS NULL AND password IS NOT NULL))
  				      );

DROP TABLE IF EXISTS payment_method;
DROP TYPE IF EXISTS payment_type;
CREATE TYPE payment_type AS ENUM ('visa', 'maestro', 'mastercard');
CREATE TABLE payment_method(id BIGSERIAL PRIMARY KEY, 
                           bazooker_id BIGINT NOT NULL REFERENCES bazooker(id),
                           card_number TEXT NOT NULL,
                           type payment_type NOT NULL,
                           validated BOOLEAN NOT NULL DEFAULT FALSE
                           );

DROP TABLE IF EXISTS moderator CASCADE;
CREATE TABLE moderator(id BIGSERIAL PRIMARY KEY, email TEXT NOT NULL UNIQUE, password TEXT NOT NULL);    

DROP TABLE IF EXISTS administrator CASCADE;
CREATE TABLE administrator(mod_id BIGINT PRIMARY KEY NOT NULL REFERENCES moderator(id));

DROP TABLE IF EXISTS auction CASCADE;
DROP TYPE IF EXISTS auction_status;
CREATE TYPE auction_status AS ENUM('pending', 'live', 'over', 'frozen', 'removed');
CREATE TABLE auction(id BIGSERIAL PRIMARY KEY,
                    owner BIGINT NOT NULL REFERENCES bazooker(id),
                    base_bid INT NOT NULL,
                    start_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    duration INT NOT NULL CHECK (duration >= 60*30) DEFAULT (3600*24*7),
                    insta_buy INT CHECK (insta_buy > 0),
                    current_price INT,
                    highest_bidder BIGINT REFERENCES bazooker(id),
                    status auction_status NOT NULL DEFAULT 'live',
					item_name TEXT NOT NULL,
					item_description TEXT NOT NULL,
                    item_short_description TEXT NOT NULL,
					search tsvector,
                    CONSTRAINT base_bid_lower_than_insta CHECK (base_bid >=0 AND base_bid < insta_buy)
                    );

DROP TABLE IF EXISTS item_image;
CREATE TABLE item_image(
    id BIGSERIAL PRIMARY KEY,
    auction_id BIGINT NOT NULL REFERENCES auction,
    image_path TEXT NOT NULL
);

DROP TABLE IF EXISTS auction_category CASCADE;
DROP TABLE IF EXISTS category CASCADE; 
CREATE TABLE category(id BIGSERIAL PRIMARY KEY, name TEXT UNIQUE NOT NULL);
CREATE TABLE auction_category(auction_id BIGINT NOT NULL REFERENCES auction(id),
                           cat_id BIGINT NOT NULL REFERENCES category(id),
                           PRIMARY KEY(auction_id, cat_id));
                           
DROP TABLE IF EXISTS certification;
DROP TYPE IF EXISTS certification_status;
CREATE TYPE certification_status AS ENUM ('pending', 'rejected', 'accepted');
CREATE TABLE certification(id BIGSERIAL PRIMARY KEY,
                        auction_id BIGINT NOT NULL REFERENCES auction(id),
                        status certification_status NOT NULL DEFAULT 'pending',
                        certification_doc_path TEXT NOT NULL
                        );

DROP TABLE IF EXISTS bid CASCADE;
CREATE TABLE bid(id BIGSERIAL PRIMARY KEY, 
                auction_id BIGINT NOT NULL REFERENCES auction(id),
                bidder_id BIGSERIAL NOT NULL REFERENCES bazooker(id),
                amount INT NOT NULL CHECK (amount > 0),
                TIME TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP);

DROP TABLE IF EXISTS auction_moderator_action;
DROP TYPE IF EXISTS moderator_action CASCADE;
CREATE TYPE moderator_action AS ENUM('freezed', 'removed');
CREATE TABLE auction_moderator_action(id BIGSERIAL PRIMARY KEY,
                                      reason TEXT NOT NULL,
                                      active BOOL NOT NULL DEFAULT TRUE,
                                      time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                      action moderator_action,
                                      auction_id BIGINT NOT NULL REFERENCES auction(id),
                                      mod_id BIGINT NOT NULL REFERENCES moderator(id));

DROP TABLE IF EXISTS bid_moderator_action;
CREATE TABLE bid_moderator_action(id BIGSERIAL PRIMARY KEY,
                                   reason TEXT NOT NULL,
                                   active BOOL NOT NULL DEFAULT TRUE,
                                   time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, 
                                   action moderator_action,
                                   bid_id BIGINT NOT NULL REFERENCES bid(id),
                                   mod_id BIGINT NOT NULL REFERENCES moderator(id));

DROP TABLE IF EXISTS auction_transaction CASCADE;
CREATE TABLE auction_transaction(id BIGSERIAL PRIMARY KEY,
                                 value int NOT NULL CHECK (value > 0),
                                 date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                 auction_id BIGINT NOT NULL REFERENCES auction(id),
                                 receiver BIGINT NOT NULL REFERENCES bazooker(id),
                                 sender BIGINT NOT NULL REFERENCES bazooker(id),
                                 UNIQUE(auction_id, receiver, sender),
                                 CONSTRAINT sender_receiver CHECK (sender <> receiver));

DROP TABLE IF EXISTS watch_list;
CREATE TABLE watch_list(auction_id BIGINT NOT NULL REFERENCES auction(id),
                        mod_id BIGINT NOT NULL REFERENCES moderator(id),
                        PRIMARY KEY (auction_id, mod_id));

DROP TABLE IF EXISTS suspension;
CREATE TABLE suspension(id BIGSERIAL PRIMARY KEY,
                        mod_id BIGINT NOT NULL REFERENCES moderator(id),
                        bazooker_id BIGINT NOT NULL REFERENCES bazooker(id),
                        reason TEXT NOT NULL, 
                        time_of_suspension TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                        duration INT NOT NULL CHECK (duration >0));

DROP TABLE IF EXISTS ban;
CREATE TABLE ban(id BIGSERIAL PRIMARY KEY,
                 admin_id BIGINT NOT NULL REFERENCES administrator(mod_id),
                 bazooker_id BIGINT NOT NULL REFERENCES bazooker(id),
                 reason TEXT NOT NULL, 
                 time_of_ban TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                 active BOOLEAN NOT NULL DEFAULT TRUE);

DROP TABLE IF EXISTS feedback;
DROP TYPE IF EXISTS feedback_type;
CREATE TYPE feedback_type AS ENUM ('auction', 'winner');
CREATE TABLE feedback(id BIGSERIAL PRIMARY KEY, 
                        ftype feedback_type, 
                        rating INT CHECK(0 <= RATING AND RATING <= 10),
                        opinion TEXT, 
                        rater_id BIGINT NOT NULL REFERENCES bazooker(id),
                        rated_id BIGINT NOT NULL REFERENCES bazooker(id),
                        transaction_id BIGINT NOT NULL REFERENCES auction_transaction(id),
						UNIQUE (rater_id, rated_id, transaction_id),
						CONSTRAINT cant_rate_same CHECK (rater_id != rated_id));


---- ONLY ONE BAN
DROP FUNCTION IF EXISTS only_one_ban();
CREATE FUNCTION only_one_ban() RETURNS TRIGGER AS $$
BEGIN
    IF NEW.active = false THEN
        RETURN NEW;
    END IF;
    IF EXISTS (SELECT * FROM ban AS B WHERE B.bazooker_id = NEW.bazooker_id AND B.active = true) THEN
        RAISE EXCEPTION 'There can only be at most one active ban against each bazooker';
    END IF;
    RETURN NEW;
END
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS ban ON ban;
CREATE TRIGGER only_one_ban
    BEFORE INSERT OR UPDATE ON ban
    FOR EACH ROW
    EXECUTE PROCEDURE only_one_ban();
    
---- BID ON OWN AUCTION
DROP FUNCTION IF EXISTS bid_on_own_auction();
CREATE FUNCTION bid_on_own_auction() RETURNS TRIGGER AS $$
BEGIN
    IF EXISTS (SELECT * FROM auction AS A WHERE A.id = NEW.auction_id AND A.owner = NEW.bidder_id) THEN
        RAISE EXCEPTION 'A bazooker cannot bid on his own auction.';
    END IF;
    RETURN NEW;
END
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS bid_on_own_auction ON bid;
CREATE TRIGGER bid_on_own_auction
    BEFORE INSERT OR UPDATE ON bid
    FOR EACH ROW
    EXECUTE PROCEDURE bid_on_auction();

-- FTS UPDATE
DROP FUNCTION IF EXISTS fts_auction_update();
CREATE FUNCTION fts_auction_update() RETURNS TRIGGER AS $$
BEGIN
	IF TG_OP = 'INSERT' THEN
		NEW.search = to_tsvector('english', NEW.item_name);
	END IF;
	IF TG_OP = 'UPDATE' THEN
		IF NEW.item_name <> OLD.item_name THEN
			NEW.search = to_tsvector('english', NEW.item_name);
		END IF;
	END IF;
	RETURN NEW;
END
$$ LANGUAGE 'plpgsql';

DROP TRIGGER IF EXISTS precalculate_auction_fts on auction;
CREATE TRIGGER precalculate_auction_fts
    BEFORE INSERT OR UPDATE ON auction
    FOR EACH ROW
    EXECUTE PROCEDURE fts_auction_update();

-- CHECK DATE BOUNDS
 DROP FUNCTION IF EXISTS check_auction_time_bounds();
    CREATE FUNCTION check_auction_time_bounds() RETURNS TRIGGER AS $$
BEGIN
    IF NEW.time IS NULL THEN
        NEW.time = CURRENT_TIMESTAMP;
    END IF;
    IF NEW.time > (SELECT start_time + duration * interval '1 second' FROM auction WHERE id = NEW.auction_id ) THEN
        RAISE EXCEPTION 'Auction has already closed.';
    END IF;
    IF NEW.time < (SELECT start_time FROM auction WHERE id = NEW.auction_id ) THEN
        RAISE EXCEPTION  'Auction hasnt started yet';
    END IF;
    RETURN NEW;
END
$$ LANGUAGE 'plpgsql';

DROP TRIGGER IF EXISTS check_auction_time_bounds ON bid;
CREATE TRIGGER check_auction_time_bounds
    BEFORE INSERT OR UPDATE ON bid
    FOR EACH ROW
    EXECUTE PROCEDURE check_auction_time_bounds();

-- EXTEND AUCTION DURATION WHEN BIDDING
 DROP FUNCTION IF EXISTS extend_auction();
    CREATE FUNCTION extend_auction() RETURNS TRIGGER AS $$
BEGIN
    IF (SELECT start_time + duration * interval '1 second' from auction where id = NEW.auction_id) - NEW.TIME < interval '120 seconds' THEN
        UPDATE auction set duration = duration + 60 WHERE id = NEW.auction_id;
    END IF;
    RETURN NEW;
END
$$ LANGUAGE 'plpgsql';

DROP TRIGGER IF EXISTS extend_auction ON bid;
CREATE TRIGGER extend_auction
    AFTER INSERT ON bid
    FOR EACH ROW
    EXECUTE PROCEDURE extend_auction();

-- SET AUCTION CURRENT PRICE WHEN IT IS CREATED
DROP FUNCTION IF EXISTS set_current_auction_price();
    CREATE FUNCTION set_current_auction_price() RETURNS TRIGGER AS $$
BEGIN
    NEW.current_price = NEW.base_bid;
    RETURN NEW;
END
$$ LANGUAGE 'plpgsql';

DROP trigger if exists set_current_auction_price on auction;
CREATE TRIGGER set_current_auction_price
    BEFORE INSERT ON auction
    FOR EACH ROW
    EXECUTE PROCEDURE set_current_auction_price();

-- PREVENT BIDS OF LOWER VALUE
DROP Function if exists prevent_lower_value_bids();
create function prevent_lower_value_bids() returns trigger as $$
Begin
    IF NEW.amount <= (select current_price from auction where id = NEW.auction_id) then
        raise exception 'Bid is lower or equal to current biggest bid';
    end if;
    RETURN new;
END
$$ LANGUAGE  'plpgsql';

DROP TRIGGER IF EXISTS prevent_lower_value_bid on bid;
CREATE TRIGGER prevent_lower_value_bid
    BEFORE INSERT ON bid
    FOR EACH ROW
    EXECUTE PROCEDURE prevent_lower_value_bids();

-- UPDATE AUCTION CURRENT PRICE ON BID
DROP Function if exists update_auction_current_price();
create function update_auction_current_price() returns trigger as $$
Begin
    update auction set current_price = NEW.amount, highest_bidder = NEW.bidder_id where auction.id = NEW.auction_id;
    return NEW;
END
$$ LANGUAGE  'plpgsql';

DROP TRIGGER IF EXISTS update_auction_current_price on bid;
CREATE TRIGGER update_auction_current_price
    AFTER INSERT ON bid
    FOR EACH ROW
    EXECUTE PROCEDURE update_auction_current_price();

-- PREVENT MULTIPLE ACTIVE OVERLAPPING SUSPENSIONS
DROP FUNCTION IF EXISTS prevent_repeated_suspentions();
CREATE FUNCTION prevent_repeated_suspentions() RETURNS TRIGGER AS $$
BEGIN
    IF EXISTS(SELECT * FROM suspension WHERE bazooker_id = NEW.id AND suspension.id <> NEW.id AND
        NEW.time_of_suspension <= suspension.time_of_suspension + suspension.duration * interval '1 second' AND
        NEW.time_of_suspension + NEW.duration * interval '1 second' >= suspension.time_of_suspension) THEN
        RAISE EXCEPTION 'User already suspended';
    END IF;
    RETURN NEW;
END
$$ LANGUAGE 'plpgsql';

DROP TRIGGER IF EXISTS prevent_repeated_suspentions on suspension;
CREATE TRIGGER prevent_repeated_suspentions
    BEFORE INSERT OR UPDATE ON suspension
    FOR EACH ROW
    EXECUTE PROCEDURE prevent_repeated_suspentions();

-- PREVENT MULTIPLE AUCTION ACTIONS
DROP FUNCTION IF EXISTS prevent_repeated_auction_action();
CREATE FUNCTION prevent_repeated_auction_action() RETURNS TRIGGER AS $$
BEGIN
    IF NEW.active = false THEN
        RETURN NEW;
    END IF;
    IF EXISTS(SELECT * FROM auction_moderator_action WHERE auction_id = NEW.auction_id AND active = true) THEN
        RAISE EXCEPTION 'There is already an action on this auction.';
    END IF;
    RETURN NEW;
END
$$ LANGUAGE 'plpgsql';

DROP TRIGGER IF EXISTS prevent_repeated_auction_action ON auction_moderator_action;
CREATE TRIGGER prevent_repeated_auction_action
    BEFORE INSERT OR UPDATE ON auction_moderator_action
    FOR EACH ROW
    EXECUTE PROCEDURE prevent_repeated_auction_action();

-- UPDATE AUCTION STATUS BASED WHEN ADDING/UPDATING MOD ACTIONS
DROP FUNCTION IF EXISTS mod_action_update_auctions_status();
CREATE FUNCTION mod_action_update_auctions_status() RETURNS TRIGGER AS $$
BEGIN
    IF TG_OP = 'INSERT' THEN
        IF NEW.action = 'freezed' THEN
            UPDATE auction set status = 'frozen' where id = NEW.auction_id;
        END IF;
        IF NEW.action = 'removed' THEN
            UPDATE auction set status = 'removed' where id = NEW.auction_id;
        END IF;
    END IF;
    IF TG_OP = 'UPDATE' THEN
        IF NEW.active = false THEN
            UPDATE auction set status = 'live' where id = NEW.auction_id;
        END IF;
    END IF;
    RETURN NEW;
END
$$ LANGUAGE 'plpgsql';

DROP TRIGGER IF EXISTS mod_action_update_auctions_status ON auction_moderator_action;
CREATE TRIGGER mod_action_update_auctions_status
    AFTER INSERT OR UPDATE ON auction_moderator_action
    FOR EACH ROW
    EXECUTE PROCEDURE mod_action_update_auctions_status();

-- PREVENT MULTIPLE BID ACTIONS
DROP FUNCTION IF EXISTS prevent_repeated_bid_action();
CREATE FUNCTION prevent_repeated_bid_action() RETURNS TRIGGER AS $$
BEGIN
    IF NEW.active = false THEN
        RETURN NEW;
    END IF;
    IF EXISTS(SELECT * FROM bid_moderator_action WHERE bid_id = NEW.bid_id AND active = true) THEN
        RAISE EXCEPTION 'There is already an action on this bid.';
    END IF;
    RETURN NEW;
END
$$ LANGUAGE 'plpgsql';

DROP TRIGGER IF EXISTS prevent_repeated_bid_action ON bid_moderator_action;
CREATE TRIGGER prevent_repeated_bid_action
    BEFORE INSERT OR UPDATE ON bid_moderator_action
    FOR EACH ROW
    EXECUTE PROCEDURE prevent_repeated_bid_action();

-- UPDATE BAZOOKER STATUS on ban
DROP FUNCTION IF EXISTS bazooker_update_status_ban();
CREATE FUNCTION bazooker_update_status_ban() RETURNS TRIGGER AS $$
BEGIN
	IF(TG_OP = 'INSERT') THEN
	UPDATE bazooker set status = 'banned' where id = NEW.bazooker_id;
	END IF;
	RETURN NEW;
END
$$ LANGUAGE 'plpgsql';

DROP TRIGGER IF EXISTS bazooker_update_status_ban ON ban;
CREATE TRIGGER bazooker_update_status_ban
    AFTER INSERT ON ban
    FOR EACH ROW
    EXECUTE PROCEDURE bazooker_update_status_ban();


-- UPDATE BAZOOKER STATUS on suspension 
DROP FUNCTION IF EXISTS bazooker_update_status_suspension();
CREATE FUNCTION bazooker_update_status_suspension() RETURNS TRIGGER AS $$
BEGIN
	IF(TG_OP = 'INSERT') THEN
		UPDATE bazooker set status = 'suspended' where id = NEW.bazooker_id AND status='live';
	ELSIF(TG_OP = 'UPDATE') THEN
		UPDATE bazooker set status = 'live' where id = NEW.bazooker_id AND status='suspended' and OLD.duration=0;
	END IF;
	RETURN NEW;
END
$$ LANGUAGE 'plpgsql';

DROP TRIGGER IF EXISTS bazooker_update_status_suspension ON suspension;
CREATE TRIGGER bazooker_update_status_suspension
    AFTER INSERT OR UPDATE ON suspension
    FOR EACH ROW
    EXECUTE PROCEDURE bazooker_update_status_suspension();

-- CHECK AUCTION LIVE STATUS
DROP FUNCTION IF EXISTS check_auction_still_live();
CREATE FUNCTION check_auction_still_live() RETURNS VOID AS $$
DECLARE
    A RECORD;
BEGIN
    FOR A IN (select * from auction where status = 'live') LOOP
        IF ((A.start_time + A.duration * interval '1 second') < CURRENT_TIMESTAMP) THEN
            -- SET STATUS TO OVER
            UPDATE auction set status = 'over' WHERE id = A.id;

            --CREATE TRANSACTION
            IF A.highest_bidder IS NOT NULL THEN
                INSERT INTO auction_transaction(auction_id, receiver, sender, value) values (A.id, A.owner, A.highest_bidder, A.current_price);
            END IF;

        END IF;
    END LOOP;
END
$$ LANGUAGE 'plpgsql';

-- CHECK AUCTION PENDING STATUS
DROP FUNCTION IF EXISTS check_auction_still_pending();
CREATE FUNCTION check_auction_still_pending() RETURNS VOID AS $$
BEGIN
    UPDATE auction set status='live' where status='pending' AND start_time < CURRENT_TIMESTAMP;
END
$$ LANGUAGE 'plpgsql';

-- CHECK USER SUSPENDED STATUS
DROP FUNCTION IF EXISTS check_user_suspended_status();
CREATE FUNCTION check_user_suspended_status() RETURNS VOID AS $$
DECLARE
    A RECORD;
BEGIN
    FOR A IN (select * from bazooker where status = 'suspended') LOOP
        IF NOT EXISTS(select * from suspension where bazooker_id = A.id and ((time_of_suspension + duration * interval '1 second') > CURRENT_TIMESTAMP)) THEN
            update bazooker set status='live' where id = A.id;
        END IF;
    END LOOP;
END
$$ LANGUAGE 'plpgsql';

CREATE INDEX bid_auction_id ON bid USING hash(auction_id);
CREATE INDEX bid_bidder_id ON bid USING hash(bidder_id);
CREATE INDEX item_image_auction_id ON item_image USING hash(auction_id);
CREATE INDEX feedback_f_type ON feedback USING hash(ftype);
CREATE INDEX bid_moderator_action_active ON bid_moderator_action USING hash(active);
CREATE INDEX auction_moderator_action_active ON auction_moderator_action USING hash(active);
CREATE INDEX start_auction ON auction USING btree(start_time);
CREATE INDEX end_time on auction using btree((start_time + duration * interval '1 second'));
CREATE INDEX auction_status on auction using hash(status);
CREATE INDEX auction_search_dix ON auction USING GIST(search);

