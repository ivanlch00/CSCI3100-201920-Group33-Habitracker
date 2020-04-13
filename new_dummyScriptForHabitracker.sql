

-- Creating seven users --


INSERT INTO login(username, email, password, image_status, first_name, last_name, welcome_message)
VALUES(
    "John23",
    "john234@gmail.com",
    "2347893john",
    "1",
    "John",
    "Chan",
    "Welcome to my page!"

),(
    "PeterLol",
    "peterrwong@gmail.com",
    "2n3rfpeter",
    "1",
    "Peter",
    "Wong",
    "Nice to meet you all!"

),(
    "Mary223",
    "marychan@gmail.com",
    "h3n4corona",
    "1",
    "Mary",
    "Lee",
    "Let's reach our goals together!"
),(
    "Ivan118",
    "ivan1144@gmail.com",
    "135ivan345",
    "1",
    "Ivan",
    "Lai",
    "Nice to meet you!"

),(
    "AndyTsang",
    "andy667t4@gmail.com",
    "andyyts114",
    "1",
    "Andy",
    "Tsang",
    "Keep going!"

    
),(
    "CaptainAmerica",
    "capa2020@gmail.com",
    "tonystark3000",
    "1",
    "Captain",
    "America",
    "Captain Cmerica is the best!"
),(
    "PikachuMaster",
    "ashhketchamp@gmail.com",
    "iwannacatchtemall23",
    "1",
    "Pikachu",
    "Master",
    "Let's go catch pikachu!"
);

--Creating goals for users

INSERT INTO goals(
    username,
    goal_name,
    goal_description,
    goal_subtask,
    goal_enddate,
    goal_startime,
    goal_endtime,
    goal_public,
    goal_completed
)VALUES(
    "PikachuMaster",
    "Espanolll",
    "Spainish netflix everyday",
    "",
    "2020-03-06",
    "00:03:07",
    "00:21:23",
    "1",
    "0"
),(
    "PikachuMaster",
    "Cook",
    "Everyday cook breakfast",
    "",
    "2020-03-07",
    "",
    "",
    "0",
    "0"
),(
    "CaptainAmerica",
    "DC plan",
    "Everyday watch one Batman Movie",
    "",
    "2020-02-14",
    "00:14:07",
    "00:23:04",
    "1",
    "0"
),(
    "CaptainAmerica",
    "Biceps plan",
    "Everyday go to gym",
    "Help girlfriend with errands",
    "2020-02-15",
    "00:00:07",
    "00:12:24",
    "1",
    "0"
),(
    "CaptainAmerica",
    "Learn to use Swift",
    "Watch YT tutorial",
    "Write notes",
    "2020-02-12",
    "00:00:07",
    "00:27:24",
    "0",
    "0"
),(
    "AndyTsang",
    "Travel plan",
    "Everyday go to the Victoria Harbour",
    "Find a girlfriend asap",
    "2020-02-14",
    "",
    "",
    "0",
    "0"
),(
    "AndyTsang",
    "Biceps training",
    "Everyday go to gym",
    "Help mama with errands",
    "2020-01-23",
    "",
    "",
    "1",
    "0"
),(
    "Ivan118",
    "Sleeping plan",
    "Everyday sleep for 4 hours or more",
    "Read Kindle before sleep",
    "2020-02-25",
    "",
    "",
    "1",
    "0"
),(
    "Mary223",
    "Lose weight",
    "Go to gym",
    "Not eat cakes",
    "2020-01-15",
    "",
    "",
    "1",
    "0"
),(
    "Mary223",
    "Get a boyfriend",
    "Practise makeup",
    "",
    "2020-02-14",
    "",
    "",
    "0",
    "0"
),(
    "PeterLol",
    "Write a novel",
    "ONe week 6 pages",
    "",
    "2020-03-04",
    "00:00:17",
    "00:22:24",
    "1",
    "0"
),(
    "PeterLol",
    "Learn spanish",
    "Go to duolinguo",
    "",
    "2020-02-19",
    "00:00:47",
    "00:12:34",
    "1",
    "0"
),(
    "John23",
    "Biceps!!!",
    "Everyday go to gym",
    "You need a gf next year",
    "2020-02-13",
    "00:00:01",
    "00:04:24",
    "1",
    "0"
);

--Generate some messages

INSERT INTO chat_message(
    to_user_id,
    from_user_id,
    chat_message
)
VALUES(
    "6",
    "1",
    "Lets go to gym tgt xd!!!!"
),(
    "1",
    "6",
    "Go!!! Where do you live???"
),(
    "1",
    "6",
    "I am in MongKok let's go to the public gym!"
),(
    "2",
    "7",
    "Let's learn spanish tgt?!"
),(
    "7",
    "2",
    "Good I need someone to motivate me"
),(
	"2", 
	"7", 
	"I will be on Zoom!");
