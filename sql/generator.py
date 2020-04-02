import faker
import random
import pandas
import psycopg2
import os
import numpy
from functools import partial
from multiprocessing import Process


fake = faker.Faker()
conn = psycopg2.connect(database='postgres', user='postgres', password='master', host='localhost')

def generate(func, number):
    res = []
    counter = len(res)
    for _ in range(number):
        res.append(func())
        counter = len(res)
        #print(f'\r{counter}/{number}', end='')
    #print('')
    return res

def generate_unique(func, number):
    res = set()
    counter = len(res)
    while(counter != number):
        res.add(func())
        counter = len(res)
        #print(f'\r{counter}/{number}', end='')
    #print('')
    return list(res)

def generate_bazooker(number):
    table = {}
    table['id'] = [i for i in range(number)]
    table['name'] = generate(fake.name, number)
    table['username'] = generate_unique(lambda : ''.join(fake.name().split()).lower()+f'_{random.randint(0,1000)}', number)
    table['email'] = generate_unique(fake.email, number)
    table['password'] = generate(lambda : fake.name().split()[0], number)
    table['trust_worthy'] = generate(lambda : random.randint(0, 1000)%100 == 0, number)
    table['oauth'] = [None]*number
    table['profile_pic'] = [None]*number
    table['description'] = [None]*number
    return table

def generate_payment_method(number_users):
    table = {}

    def cc_type():
        cc_types = ['mastercard', 'maestro', 'visa']
        return cc_types[random.randint(0,10)%3]

    number =  number_users*4
    table['id'] = [i for i in range(number)]
    table['bazooker_id'] = generate(lambda: int(random.uniform(0, number_users)), number)
    table['card_number'] = generate(lambda: str(int(random.randint(0, number))), number)
    table['validated'] = generate(lambda: int(random.randint(0, number))%200!=0, number)
    table['type'] = generate(cc_type, number)
    return table

AUCTION_MULTIPLIER=2
def generate_auction(number_users):
    table = {}
    '''
    id SERIAL PRIMARY KEY,
                    owner SERIAL NOT NULL REFERENCES bazooker,
                    base_bid INT NOT NULL,
                    start_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    duration INT NOT NULL CHECK (duration >= 60*30) DEFAULT (3600*24*7),
                    insta_buy INT CHECK (insta_buy > 0),
					item_name TEXT NOT NULL,
					item_description TEXT NOT NULL,
    '''

    
    def auction_name():
        guns = ['ak47', 'm4', 'g3', 'usp', 'glock', 'awp', 'mp5', 'mp3', 'mp7', 'rpk', 'bazooka', 'lm-96']
        return ' '.join([guns[random.randint(0, len(guns)-1)] for _ in range(3)])



    number = number_users*AUCTION_MULTIPLIER
    table['id'] = [i for i in range(number)]
    table['owner'] = generate(lambda: int(random.normalvariate(0, number_users))%number_users, number)
    table['duration'] = generate(lambda: 60*30+random.randint(0,900), number)
    table['insta_buy'] = generate(lambda: None if random.randint(0,5)%2==0 else int(random.randint(5, 900)), number)


    table['base_bid'] = table['insta_buy'].copy()
    table['base_bid'] = list(map(lambda x: random.randint(1, 6000) if x is None else int(x/2),table['base_bid']))


    table['item_name'] = generate(auction_name, number)
    table['item_description'] = generate(fake.name, number)

    return table

def generate_certification(number_of_users):
    number = int(number_of_users/4)

    def status():
        status_list = ['pending', 'rejected', 'accepted']
        return status_list[random.randint(0,5)%len(status_list)]
    table = {}
    table['id'] = [i for i in range(number)]
    table['auction_id'] = generate(lambda: int(random.normalvariate(0, number))%number_of_users, number)
    table['status'] = generate(status,number)
    table['certification_doc_path'] =  generate(lambda: fake.name().split()[0], number)
    return table


def generate_item_image(number_of_users):
    number = number_of_users
    table = {}
    table['id'] = [i for i in range(number)]
    table['auction_id'] = generate(lambda: random.randint(0, number), number)
    table['image_path'] = generate(lambda: fake.name().split()[0], number)
    return table

category_names = ['knives', 'guns', 'big guns', 'sexy guns', 'old', 'new', 'hella cool']
def generate_category(number_of_users):

    number = len(category_names)
    table = {}
    table['id'] = [i for i in range(number)]
    table['name'] = category_names
    return table

def generate_auction_category(number_of_users):

    number = number_of_users*(AUCTION_MULTIPLIER+1)
    table = {}
    table['auction_id'] = [i%(number_of_users*AUCTION_MULTIPLIER) for i in range(number)]
    table['cat_id'] = generate(lambda: random.randint(0,len(category_names)-4), number_of_users*AUCTION_MULTIPLIER)
    table['cat_id'].extend(generate(lambda: random.randint(len(category_names)-3, len(category_names)-1), number-len(table['cat_id'])))
    return table
    

def generate_feedback(number_of_users):

    '''
    id SERIAL PRIMARY KEY, 
                        ftype feedback_type, 
                        rating INT CHECK(0 <= RATING AND RATING <= 10),
                        opinion TEXT, 
                        rater_id SERIAL NOT NULL REFERENCES bazooker(id),
                        rated_id SERIAL NOT NULL REFERENCES bazooker(id),
                        auction SERIAL NOT NULL REFERENCES auction(id))
    '''
    number = int(number_of_users*AUCTION_MULTIPLIER/2)

    table = {}
    table['id'] = [i for i in range(number)]
    table['rating'] = generate(lambda: random.randint(0,10), number)
    table['opinion'] = generate(lambda: fake.name().split()[1], number)

    def feedback(number_of_users):
        rater = random.randint(0, number_of_users-1)
        rated = (rater+random.randint(1, 20))%number_of_users
        auction = random.randint(0, number_of_users*AUCTION_MULTIPLIER-1)
        return (rater, rated, auction)

    tmp = generate_unique(partial(feedback, number_of_users), number)
    table['rater_id'] = list([t for t,_,_ in tmp])
    table['rated_id'] = list([t for _,t,_ in tmp])
    table['auction'] = list([t for _,_,t in tmp])
    return table

BID_MULTIPLIER = 2
def generate_bid(number_of_users):
    '''
    id SERIAL PRIMARY KEY, 
    auction_id SERIAL NOT NULL REFERENCES auction(id),
    bidder_id SERIAL NOT NULL REFERENCES bazooker(id),
    amount INT NOT NULL CHECK (amount > 0),
    TIME TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP);
    '''    

    number = number_of_users*AUCTION_MULTIPLIER*BID_MULTIPLIER
    table = {}
    table['id'] = [i for i in range(number)]
    table['auction_id'] = generate(lambda: random.randint(0, number_of_users*AUCTION_MULTIPLIER-1), number)
    table['bidder_id'] = generate(lambda: random.randint(0, number_of_users-1), number)
    table['amount'] = generate(lambda: random.randint(1, 2000), number)
    table['time'] = generate(fake.iso8601, number)
    return table



NUMBER_OF_MODERATORS = 5
def generate_moderator(numbers_user):
    number = NUMBER_OF_MODERATORS
    table = {}
    table['id'] = [i for i in range(number)]
    table['email'] = generate(fake.email, number)
    table['password'] = generate(lambda: fake.name().split()[1], number)
    return table

NUMBER_OF_ADMINS = 2
def generate_administrator(numbers_user):

    number = NUMBER_OF_ADMINS
    table = {}
    table['mod_id'] = [i for i in range(number)]
    return table


def generate_watch_list(number_of_users):
    number = int(number_of_users / 2)
    table = {}
    tmp = generate_unique(lambda: (random.randint(0, number_of_users*AUCTION_MULTIPLIER-1), random.randint(0, NUMBER_OF_MODERATORS-1)), number)

    table['auction_id'] = [t for t,_ in tmp]
    table['mod_id'] = [t for _,t in tmp]
    return table

def generate_suspension(number_of_users):

    number = int(number_of_users/5)
    table = {}
    '''
    id SERIAL PRIMARY KEY,
    mod_id SERIAL NOT NULL REFERENCES moderator(id),
    bazooker_id SERIAL NOT NULL REFERENCES bazooker(id), 
    reason TEXT NOT NULL, 
    time_of_suspension TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    duration INT NOT NULL CHECK (duration >0));
    '''
    table['id'] = [i for i in range(number)]
    table['duration'] = generate(lambda: random.randint(1, 5000), number)
    table['time_of_suspension'] = generate(fake.iso8601, number)
    table['reason'] = generate(lambda: fake.name().split()[1], number)
    table['mod_id'] = generate(lambda: random.randint(0, NUMBER_OF_MODERATORS-1), number)
    table['bazooker_id'] = generate(lambda: int(random.normalvariate(0, number_of_users))%number_of_users, number)
    return table

def generate_ban(number_of_users):

    number = int(number_of_users/9)
    table = {}
    '''
    id SERIAL PRIMARY KEY,
    admin_id SERIAL NOT NULL REFERENCES administrator(mod_id), 
    bazooker_id SERIAL NOT NULL REFERENCES bazooker(id), 
    reason TEXT NOT NULL, 
    time_of_ban TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    activate BOOLEAN NOT NULL DEFAULT TRUE);
    '''
    table['id'] = [i for i in range(number)]
    table['admin_id'] = generate(lambda: random.randint(0, NUMBER_OF_ADMINS-1), number)
    table['bazooker_id'] = generate(lambda: int(random.normalvariate(0, number_of_users))%number_of_users, number)
    table['time_of_ban'] = generate(fake.iso8601, number)
    table['activate'] = generate(lambda: random.randint(0,number_of_users)%2==0, number)
    table['reason'] = generate(lambda: fake.name().split()[1], number)
    return table
    
def generate_auction_transaction(number_of_users):
    '''
    value int NOT NULL CHECK (value > 0),
    date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    auction_id SERIAL NOT NULL REFERENCES auction(id),
    receiver SERIAL NOT NULL REFERENCES bazooker(id),
    sender SERIAL NOT NULL REFERENCES bazooker(id),
    PRIMARY KEY(auction_id, receiver, sender),
    CONSTRAINT sender_receiver CHECK (sender <> receiver));
    '''
    number = int(number_of_users*AUCTION_MULTIPLIER/3)
    table = {}
    table['value'] = generate(partial(random.randint, 1, 8000), number)
    table['date'] = generate(fake.iso8601, number)

    def pk_auction_transaction(number_of_users):
        auction_id = random.randint(0, number_of_users*AUCTION_MULTIPLIER-1)
        receiver = random.randint(0, number_of_users-1)
        sender = (receiver + random.randint(2, 20))%number_of_users
        return (auction_id, receiver, sender)

    tmp = generate_unique(partial(pk_auction_transaction, number_of_users), number)
    table['auction_id'] = [t for t,_,_ in tmp]
    table['receiver'] = [t for _,t,_ in tmp]
    table['sender'] = [t for _,_,t in tmp]
    return table

moderator_actions = ['freezed', 'removed']
def generate_bid_moderator_action(number_of_users):
    '''
    CREATE TABLE bid_moderator_action(id SERIAL PRIMARY KEY,
    reason TEXT NOT NULL,
    activate BOOL NOT NULL DEFAULT TRUE,
    time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    action moderator_action,
    bid_id SERIAL NOT NULL REFERENCES bid(id),
    mod_id SERIAL NOT NULL REFERENCES moderator(id));
    '''
    number = int(number_of_users*AUCTION_MULTIPLIER*BID_MULTIPLIER/9)
    table = {}
    table['id'] = [i for i in range(number)]
    table['reason'] = generate(lambda: fake.name().split()[0], number)
    table['time'] = generate(fake.iso8601, number)
    table['activate'] = generate(lambda: random.randint(0,50)%2==0, number)
    table['action'] = generate(lambda: moderator_actions[random.randint(0, len(moderator_actions)-1)], number)
    table['bid_id'] = generate(lambda: random.randint(0, number_of_users*AUCTION_MULTIPLIER*BID_MULTIPLIER-1), number)
    table['mod_id'] = generate(lambda: random.randint(0, NUMBER_OF_MODERATORS-1), number)
    return table

def generate_auction_moderator_action(number_of_users):
    '''
    CREATE TYPE moderator_action AS ENUM('freezed', 'removed');
    CREATE TABLE auction_moderator_action(id SERIAL PRIMARY KEY,
    reason TEXT NOT NULL,
    activate BOOL NOT NULL DEFAULT TRUE,
    time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    action moderator_action,
    auction_id SERIAL NOT NULL REFERENCES auction(id),
    mod_id SERIAL NOT NULL REFERENCES moderator(id));
    '''
    number = int(number_of_users*AUCTION_MULTIPLIER/8)
    table = {}
    table['id'] = [i for i in range(number)]
    table['reason'] = generate(lambda: fake.name().split()[0], number)
    table['time'] = generate(fake.iso8601, number)
    table['activate'] = generate(lambda: random.randint(0,50)%2==0, number)
    table['action'] = generate(lambda: moderator_actions[random.randint(0, len(moderator_actions)-1)], number)
    table['mod_id'] = generate(lambda: random.randint(0, NUMBER_OF_MODERATORS-1), number)
    return table

slash='C:\\Users\\Public\\'
def individual_process(number_of_users, table_name):
        print(f'Exporting {table_name}')
        df = pandas.DataFrame.from_dict(eval('generate_'+table_name+'(number_of_users)'))

        if table_name == 'auction':
            df['insta_buy'] = df['insta_buy'].astype('Int64')

        df.to_csv(f'{slash+table_name}.csv', header=True, index=False)
        print(f'Exported {table_name}')

def generate_db(number_of_users):
    table_names = [
        'bazooker',
        'payment_method',
        'auction',
        'certification',
        'item_image',
        'category',
        'auction_category',
        'feedback',
        'bid',
        'moderator',
        'administrator',
        'watch_list',
        'suspension',
        'ban',
        'auction_transaction',
        'auction_moderator_action',
        'bid_moderator_action'
            ]
    '''
    database = {}
    database['bazooker'] = generate_bazooker(number_of_users)
    database['payment_method'] = generate_payment_method(number_of_users)
    database['auction'] = generate_auction(number_of_users)
    database['certification'] = generate_certification(number_of_users)
    database['item_image'] = generate_item_image(number_of_users)
    database['category'] = generate_category(number_of_users)
    database['auction_category'] = generate_auction_category(number_of_users)
    database['feedback'] = generate_feedback(number_of_users)
    database['bid'] = generate_bid(number_of_users)
    database['moderator'] = generate_moderator(number_of_users)
    database['administrator'] = generate_administrator(number_of_users)
    database['watch_list'] = generate_watch_list(number_of_users)
    database['suspension'] = generate_suspension(number_of_users)
    database['ban'] = generate_ban(number_of_users)
    database['auction_transaction'] = generate_auction_transaction(number_of_users)
    database['auction_moderator_action'] = generate_auction_moderator_action(number_of_users)
    database['bid_moderator_action'] = generate_bid_moderator_action(number_of_users)
    '''

    cur = conn.cursor()
    for entry in table_names:
        cur.execute(f'TRUNCATE {entry} CASCADE;')
    conn.commit()

    processes = []
    #for table_name in table_names:
    #    processes.append(Process(target=individual_process, name=table_name, args=(number_of_users, table_name,)))

    #for process in processes:
    #    process.start()

    #for process in processes:
    #    process.join()
    #    print('Procees has finished!')

    #return

    for table_name in table_names:
        print(f'Dumping {table_name} to db')
        df= pandas.read_csv(f'{slash+table_name}.csv')
        final = f"COPY {table_name} ({','.join(list(df.columns))}) FROM '{slash+table_name+'.csv'}' WITH HEADER CSV;"
        cur.execute(final) 
        conn.commit()
        print(f'Dumped {table_name} to db')


if __name__ == '__main__':
    generate_db(1000000)
