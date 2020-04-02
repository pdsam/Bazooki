DROP TABLE IF EXISTS bazooker CASCADE;
CREATE TABLE bazooker(id BIGSERIAL PRIMARY KEY, 
                      name text NOT NULL, 
                      username TEXT UNIQUE NOT NULL,
                      password TEXT, 
                      email TEXT UNIQUE NOT NULL,
                      profile_pic TEXT, 
                      oauth TEXT,
                      description TEXT, 
                      trust_worthy BOOL NOT NULL DEFAULT TRUE,
                      CONSTRAINT pass_oauth_xor CHECK((oauth IS NOT NULL AND password  IS NULL) OR (oauth IS NULL AND password IS NOT NULL))
  				      );

DROP TABLE IF EXISTS payment_method;
DROP TYPE IF EXISTS payment_type;
CREATE TYPE payment_type AS ENUM ('visa', 'maestro', 'mastercard');
CREATE TABLE payment_method(id BIGSERIAL PRIMARY KEY, 
                           bazooker_id BIGSERIAL NOT NULL REFERENCES bazooker(id),
                           card_number TEXT NOT NULL,
                           type payment_type NOT NULL,
                           validated BOOLEAN NOT NULL DEFAULT FALSE
                           );

DROP TABLE IF EXISTS moderator CASCADE;
CREATE TABLE moderator(id BIGSERIAL PRIMARY KEY, email TEXT NOT NULL UNIQUE, password TEXT NOT NULL);    

DROP TABLE IF EXISTS administrator CASCADE;
CREATE TABLE administrator(mod_id BIGSERIAL PRIMARY KEY NOT NULL REFERENCES moderator(id));

DROP TABLE IF EXISTS auction CASCADE;
CREATE TABLE auction(id BIGSERIAL PRIMARY KEY,
                    owner BIGSERIAL NOT NULL REFERENCES bazooker(id),
                    base_bid INT NOT NULL,
                    start_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    duration INT NOT NULL CHECK (duration >= 60*30) DEFAULT (3600*24*7),
                    insta_buy INT CHECK (insta_buy > 0),
					item_name TEXT NOT NULL,
					item_description TEXT NOT NULL,
					search tsvector,
                    CONSTRAINT base_bid_lower_than_insta CHECK (base_bid >=0 AND base_bid < insta_buy)
                    );

DROP TABLE IF EXISTS item_image;
CREATE TABLE item_image(
    id BIGSERIAL PRIMARY KEY,
    auction_id BIGSERIAL NOT NULL REFERENCES auction,
    image_path TEXT NOT NULL
);

DROP TABLE IF EXISTS auction_category CASCADE;
DROP TABLE IF EXISTS category CASCADE; 
CREATE TABLE category(id BIGSERIAL PRIMARY KEY, name TEXT UNIQUE NOT NULL);
CREATE TABLE auction_category(auction_id BIGSERIAL NOT NULL REFERENCES auction(id),
                           cat_id BIGSERIAL NOT NULL REFERENCES category(id),
                           PRIMARY KEY(auction_id, cat_id));
                           
DROP TABLE IF EXISTS certification;
DROP TYPE IF EXISTS certification_status;
CREATE TYPE certification_status AS ENUM ('pending', 'rejected', 'accepted');
CREATE TABLE certification(id BIGSERIAL PRIMARY KEY,
                        auction_id BIGSERIAL NOT NULL REFERENCES auction(id),
                        status certification_status NOT NULL DEFAULT 'pending',
                        certification_doc_path TEXT NOT NULL
                        );

DROP TABLE IF EXISTS bid CASCADE;
CREATE TABLE bid(id BIGSERIAL PRIMARY KEY, 
                auction_id BIGSERIAL NOT NULL REFERENCES auction(id),
                bidder_id BIGSERIAL NOT NULL REFERENCES bazooker(id),
                amount INT NOT NULL CHECK (amount > 0),
                TIME TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP);

DROP TABLE IF EXISTS auction_moderator_action;
DROP TYPE IF EXISTS moderator_action CASCADE;
CREATE TYPE moderator_action AS ENUM('freezed', 'removed');
CREATE TABLE auction_moderator_action(id BIGSERIAL PRIMARY KEY,
                                      reason TEXT NOT NULL,
                                      activate BOOL NOT NULL DEFAULT TRUE,
                                      time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                      action moderator_action,
                                      auction_id BIGSERIAL NOT NULL REFERENCES auction(id),
                                      mod_id BIGSERIAL NOT NULL REFERENCES moderator(id));

DROP TABLE IF EXISTS bid_moderator_action;
CREATE TABLE bid_moderator_action(id BIGSERIAL PRIMARY KEY,
                                   reason TEXT NOT NULL,
                                   activate BOOL NOT NULL DEFAULT TRUE,
                                   time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, 
                                   action moderator_action,
                                   bid_id BIGSERIAL NOT NULL REFERENCES bid(id),
                                   mod_id BIGSERIAL NOT NULL REFERENCES moderator(id));

DROP TABLE IF EXISTS auction_transaction;
CREATE TABLE auction_transaction(value int NOT NULL CHECK (value > 0),
                                 date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                 auction_id BIGSERIAL NOT NULL REFERENCES auction(id),
                                 receiver BIGSERIAL NOT NULL REFERENCES bazooker(id),
                                 sender BIGSERIAL NOT NULL REFERENCES bazooker(id),
                                 PRIMARY KEY(auction_id, receiver, sender),
                                 CONSTRAINT sender_receiver CHECK (sender <> receiver));

DROP TABLE IF EXISTS watch_list;
CREATE TABLE watch_list(auction_id BIGSERIAL NOT NULL REFERENCES auction(id),
                        mod_id BIGSERIAL NOT NULL REFERENCES moderator(id),
                        PRIMARY KEY (auction_id, mod_id));

DROP TABLE IF EXISTS suspension;
CREATE TABLE suspension(id BIGSERIAL PRIMARY KEY,
                        mod_id BIGSERIAL NOT NULL REFERENCES moderator(id),
                        bazooker_id BIGSERIAL NOT NULL REFERENCES bazooker(id), 
                        reason TEXT NOT NULL, 
                        time_of_suspension TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                        duration INT NOT NULL CHECK (duration >0));

DROP TABLE IF EXISTS ban;
CREATE TABLE ban(id BIGSERIAL PRIMARY KEY,
                 admin_id BIGSERIAL NOT NULL REFERENCES administrator(mod_id), 
                 bazooker_id BIGSERIAL NOT NULL REFERENCES bazooker(id), 
                 reason TEXT NOT NULL, 
                 time_of_ban TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                 activate BOOLEAN NOT NULL DEFAULT TRUE);

DROP TABLE IF EXISTS feedback;
DROP TYPE IF EXISTS feedback_type;
CREATE TYPE feedback_type AS ENUM ('auction', 'winner');
CREATE TABLE feedback(id BIGSERIAL PRIMARY KEY, 
                        ftype feedback_type, 
                        rating INT CHECK(0 <= RATING AND RATING <= 10),
                        opinion TEXT, 
                        rater_id BIGSERIAL NOT NULL REFERENCES bazooker(id),
                        rated_id BIGSERIAL NOT NULL REFERENCES bazooker(id),
                        auction BIGSERIAL NOT NULL REFERENCES auction(id),
						UNIQUE (rater_id, rated_id, auction),
						CONSTRAINT cant_rate_same CHECK (rater_id != rated_id));



DROP FUNCTION IF EXISTS only_one_ban;
CREATE FUNCTION only_one_ban() RETURNS TRIGGER AS $$
BEGIN
    IF EXISTS (SELECT * FROM ban AS B WHERE B.bazooker_id = NEW.bazooker_id AND B.active = true AND NEW.active = true) THEN
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
    
    
    
    
    
    
DROP FUNCTION IF EXISTS bid_on_auction;
CREATE FUNCTION bid_on_auction() RETURNS TRIGGER AS $$
BEGIN
    IF EXISTS (SELECT * FROM auction AS A WHERE A.id = NEW.auction_id AND A.owner = NEW.bidder_id) THEN
        RAISE EXCEPTION 'A bazooker cannot bid on his own auction.';
    END IF;
    RETURN NEW;
END
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS bid_on_auction ON bid;
CREATE TRIGGER bid_on_auction
    BEFORE INSERT OR UPDATE ON bid
    FOR EACH ROW
    EXECUTE PROCEDURE bid_on_auction();





DROP FUNCTION IF EXISTS fts_auction_update;
CREATE FUNCTION fts_auction_update() RETURNS TRIGGER AS $$
BEGIN
	IF TG_OP = 'INSERT' THEN
		NEW.search = to_tsvector('english', NEW.name);
	END IF;
	IF TG_OP = 'UPDATE' THEN
		IF NEW.name <> OLD.name THEN
			NEW.search = to_tsvector('english', NEW.name);
		END IF;
	END IF;
	RETURN NEW;
END
$$ LANGUAGE 'plpgsql';

DROP TRIGGER IF EXISTS precalculate_auction_fts on auction;
CREATE TRIGGER precalculate_auction_fts
    AFTER INSERT OR UPDATE ON auction
    FOR EACH ROW
    EXECUTE PROCEDURE fts_auction_update();
    
    
    
    
    
    
 DROP FUNCTION IF EXISTS prevent_bid_on_finished_auction;
    CREATE FUNCTION prevent_bid_on_finished_auction() RETURNS TRIGGER AS $$
BEGIN
    IF NEW.time > (SELECT start_time + duration * interval '1 second' FROM auction WHERE id = NEW.auction_id ) THEN
        RAISE EXCEPTION 'Auction has already closed.';
    END IF;
    RETURN NEW;
END
$$ LANGUAGE 'plpgsql';

DROP TRIGGER IF EXISTS prevent_bid_on_finished_auction ON bid;
CREATE TRIGGER prevent_bid_on_finished_auction
    AFTER INSERT OR UPDATE ON bid
    FOR EACH ROW
    EXECUTE PROCEDURE prevent_bid_on_finished_auction();





DROP FUNCTION IF EXISTS prevent_repeated_suspentions;
CREATE FUNCTION prevent_repeated_suspentions() RETURNS TRIGGER AS $$
BEGIN
    IF EXISTS(SELECT * FROM suspension WHERE bazooker_id = NEW.id AND NEW.time_of_suspension < suspension.time_of_suspension + suspension.duration * interval '1 second') THEN
        RAISE EXCEPTION 'User already suspended';
    END IF;
    RETURN NEW;
END
$$ LANGUAGE 'plpgsql';


DROP TRIGGER IF EXISTS prevent_repeated_suspentions on suspension;
CREATE TRIGGER prevent_repeated_suspentions
    AFTER INSERT OR UPDATE ON suspension
    FOR EACH ROW
    EXECUTE PROCEDURE prevent_repeated_suspentions();



DROP FUNCTION IF EXISTS prevent_repeated_auction_action;
CREATE FUNCTION prevent_repeated_auction_action() RETURNS TRIGGER AS $$
BEGIN
    IF EXISTS(SELECT * FROM auction_moderator_action WHERE auction_id = NEW.auction_id AND active = true AND NEW.active = true) THEN
        RAISE EXCEPTION 'There is already an action on this auction.';
    END IF;
    RETURN NEW;
END
$$ LANGUAGE 'plpgsql';

DROP TRIGGER IF EXISTS prevent_repeated_auction_action ON auction_moderator_action;
CREATE TRIGGER prevent_repeated_auction_action
    AFTER INSERT OR UPDATE ON auction_moderator_action
    FOR EACH ROW
    EXECUTE PROCEDURE prevent_repeated_auction_action();
    
    


DROP FUNCTION IF EXISTS prevent_repeated_bid_action;
CREATE FUNCTION prevent_repeated_bid_action() RETURNS TRIGGER AS $$
BEGIN
    IF EXISTS(SELECT * FROM bid_moderator_action WHERE bid_id = NEW.bid_id AND active = true AND NEW.active = true) THEN
        RAISE EXCEPTION 'There is already an action on this bid.';
    END IF;
    RETURN NEW;
END
$$ LANGUAGE 'plpgsql';

DROP TRIGGER IF EXISTS prevent_repeated_bid_action ON bid_moderator_action;
CREATE TRIGGER prevent_repeated_bid_action
    AFTER INSERT OR UPDATE ON bid_moderator_action
    FOR EACH ROW
    EXECUTE PROCEDURE prevent_repeated_bid_action();




