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

						
CREATE FUNCTION bid_on_auction() RETURNS TRIGGER AS $$
BEGIN
    IF EXISTS (SELECT * FROM auction AS A WHERE A.id = NEW.auction_id AND A.owner = NEW.bidder_id) THEN
        RAISE EXCEPTION 'A bazooker cannot bid on his own auction.';
    END IF;
    RETURN NEW;
END
$$ LANGUAGE plpgsql;

CREATE TRIGGER bid_on_auction
    BEFORE INSERT OR UPDATE ON bid
    FOR EACH ROW
    EXECUTE PROCEDURE bid_on_auction();

