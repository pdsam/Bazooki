DROP TABLE IF EXISTS ban;
DROP TABLE IF EXISTS feedback_auction;
DROP TABLE IF EXISTS feedback_winner;
DROP TABLE IF EXISTS auction_transaction;
DROP TABLE IF EXISTS bazooker;

CREATE TABLE bazooker(id SERIAL PRIMARY KEY, name text not NULL, username TEXT UNIQUE NOT NULL,
                      password TEXT NOT NULL, email TEXT UNIQUE NOT NULL,
                      profile_pic TEXT, oauth TEXT,
                      description TEXT, trust_worthy BOOL NOT NULL DEFAULT TRUE
  						);

DROP TABLE IF EXISTS payment_method;
DROP TYPE IF EXISTS payment_type;
CREATE TYPE payment_type AS ENUM ('visa', 'maestro', 'mastercard');
CREATE TABLE payment_method(id SERIAL PRIMARY KEY, card_number TEXT NOT NULL,
                           type payment_type NOT NULL,
                           validated BOOLEAN NOT NULL DEFAULT FALSE
                           );




DROP TABLE IF EXISTS auction_moderator_action;
DROP TABLE IF EXISTS bid_moderator_action;
DROP TYPE IF EXISTS moderator_action;
DROP TABLE IF EXISTS watch_list;
DROP TABLE IF EXISTS auction;


DROP TABLE IF EXISTS administrator;
DROP TABLE IF EXISTS moderator;
CREATE TABLE moderator(id SERIAL PRIMARY KEY, email TEXT UNIQUE, password TEXT unique);    
CREATE TABLE administrator(mod_id int NOT NULL UNIQUE REFERENCES moderator(id));
CREATE TABLE auction(id SERIAL PRIMARY KEY,
                     base_bid INT NOT NULL,
                     start_time TIMESTAMP NOT NULL,
                     duration INT NOT NULL CHECK (duration >= 60*30),
                     insta_buy INT CHECK (insta_buy > 0)
                     );
                     
DROP TABLE IF EXISTS bid;
CREATE TABLE bid(id SERIAL PRIMARY KEY, amount INT NOT NULL,
                 TIME TIMESTAMP NOT NULL);
CREATE TYPE moderator_action AS ENUM('freezed', 'removed');
CREATE TABLE auction_moderator_action(id SERIAL PRIMARY KEY,
                                      reason TEXT NOT NULL,
                                      activate BOOL NOT NULL DEFAULT TRUE,
                                      time timestamp NOT NULL,
                                      action moderator_action,
                                      auction_id INT NOT NULL REFERENCES auction(id),
                                      mod_id INT NOT NULL REFERENCES moderator(id));
CREATE TABLE bid_moderator_action(id SERIAL PRIMARY KEY,
                                   reason TEXT NOT NULL,
                                   activate BOOL NOT NULL DEFAULT TRUE,
                                   time timestamp NOT NULL, action moderator_action,
                                   auction_id INT NOT NULL REFERENCES bid(id),
                                   mod_id INT NOT NULL REFERENCES moderator(id));


CREATE TABLE auction_transaction(value int NOT NULL,
                                 DATE TIMESTAMP NOT NULL,
                                 auction_id INT NOT NULL REFERENCES auction(id),
                                 receiver INT NOT NULL REFERENCES bazooker(id),
                                 sender INT NOT NULL REFERENCES bazooker(id),
                                 UNIQUE(auction_id, receiver, sender));
CREATE TABLE watch_list(auction_id INT NOT NULL REFERENCES auction(id),
                        mod_id INT NOT NULL REFERENCES moderator(id));



DROP TABLE IF EXISTS suspension;
CREATE TABLE suspension(id SERIAL PRIMARY KEY, reason TEXT NOT NULL, time_of_suspension TIMESTAMP NOT NULL,
                        duration INT NOT NULL CHECK (duration >0));
                        
                        

DROP TABLE IF EXISTS item_category;
DROP TABLE IF EXISTS item;
DROP TABLE IF EXISTS category; 


          
CREATE TABLE item(id SERIAL PRIMARY KEY,
                  name TEXT NOT NULL, description TEXT NOT NULL);

                                                                      
CREATE TABLE category(id SERIAL PRIMARY KEY, name TEXT UNIQUE NOT NULL);
CREATE TABLE item_category(item_id INT NOT NULL REFERENCES item(id),
                           cat_id INT NOT NULL REFERENCES category(id));
                           
DROP TABLE IF EXISTS certification;
DROP TYPE IF EXISTS certification_status;

CREATE TYPE certification_status AS ENUM ('pending', 'rejected', 'accepted');
CREATE TABLE certification(id SERIAL PRIMARY KEY, status certification_status NOT NULL DEFAULT 'pending');


CREATE TABLE ban(id SERIAL PRIMARY KEY,
                 admin_id INT NOT NULL REFERENCES administrator(mod_id), 
                 bazooker_id INT NOT NULL REFERENCES bazooker(id), 
                 reason TEXT NOT NULL, time_of_ban TIMESTAMP NOT NULL,
                 activate BOOLEAN NOT NULL DEFAULT TRUE);




CREATE TABLE feedback_auction(id SERIAL PRIMARY KEY, rating INT CHECK(0 <= RATING AND RATING <= 10),
                             opinion TEXT NOT NULL, rater_id INT NOT NULL REFERENCES bazooker(id),
                             rated_id int not null REFERENCES bazooker(id));
CREATE TABLE feedback_winner(id SERIAL PRIMARY KEY, rating INT CHECK(0 <= RATING AND RATING <= 10),
                             opinion TEXT NOT NULL, rater_id INT NOT NULL REFERENCES bazooker(id),
                             rated_id int not null REFERENCES bazooker(id));


