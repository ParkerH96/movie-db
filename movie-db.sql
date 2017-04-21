/*
  Team Databased 2017: Movie-DB
  Author(s): Parker Householder, Jonathen Dingess

  Name: movie-db.sql

  Description: **DUMP FILE** This file contains the main MySQL code used to create
  the Database used by the site.

*/

DROP DATABASE IF EXISTS Databased_movie;
CREATE DATABASE Databased_movie;

USE Databased_movie;

DROP TABLE IF EXISTS MOVIE;
CREATE TABLE MOVIE
(
  movie_id int NOT NULL AUTO_INCREMENT,
  title varchar(64) NOT NULL,
  release_date date NOT NULL,
  summary varchar(4096),
  language varchar(64) NOT NULL,
  duration time NOT NULL,
  trailer varchar(1024) NOT NULL,
  poster varchar(1024) NOT NULL,
  PRIMARY KEY (movie_id)
);

DROP TABLE IF EXISTS USER;
CREATE TABLE USER
(
  user_id int AUTO_INCREMENT,
  admin_tag int NOT NULL,
  first_name varchar(64) NOT NULL,
  middle_name varchar(64),
  last_name varchar(64) NOT NULL,
  dob date NOT NULL,
  gender varchar(64),
  username varchar(64) NOT NULL,
  password varchar(64) NOT NULL,
  PRIMARY KEY (user_id)
);

DROP TABLE IF EXISTS GENRE;
CREATE TABLE GENRE
(
  genre_id int NOT NULL AUTO_INCREMENT,
  genre varchar(64) NOT NULL,
  PRIMARY KEY (genre_id)
);

DROP TABLE IF EXISTS TAGS;
CREATE TABLE TAGS
(
  tag_id int NOT NULL AUTO_INCREMENT,
  tag varchar(16) NOT NULL,
  PRIMARY KEY (tag_id)
);

DROP TABLE IF EXISTS CREW;
CREATE TABLE CREW
(
  crew_id int NOT NULL AUTO_INCREMENT,
  name varchar(64) NOT NULL,
  PRIMARY KEY (crew_id)
);

DROP TABLE IF EXISTS MEMBER;
CREATE TABLE MEMBER
(
  mem_id int NOT NULL AUTO_INCREMENT,
  first_name varchar(64) NOT NULL,
  middle_name varchar(64),
  last_name varchar(64) NOT NULL,
  dob date NOT NULL,
  gender varchar(64),
  PRIMARY KEY (mem_id)
);

DROP TABLE IF EXISTS ROLE;
CREATE TABLE ROLE
(
  role_id int NOT NULL AUTO_INCREMENT,
  role varchar(64) NOT NULL,
  PRIMARY KEY (role_id)
);

DROP TABLE IF EXISTS has_members;
CREATE TABLE has_members
(
  crew_id int NOT NULL,
  mem_id int NOT NULL,
  role_id int NOT NULL,
  FOREIGN KEY (crew_id) REFERENCES CREW(crew_id),
  FOREIGN KEY (mem_id) REFERENCES MEMBER(mem_id),
  FOREIGN KEY (role_id) REFERENCES ROLE(role_id)
);

DROP TABLE IF EXISTS has_crew;
CREATE TABLE has_crew
(
  movie_id int NOT NULL,
  crew_id int NOT NULL,
  FOREIGN KEY (movie_id) REFERENCES MOVIE(movie_id),
  FOREIGN KEY (crew_id) REFERENCES CREW(crew_id)
);

DROP TABLE IF EXISTS user_actions;
CREATE TABLE user_actions
(
  user_id int NOT NULL,
  movie_id int NOT NULL,
  rating int,
  review varchar(16384),
  FOREIGN KEY (movie_id) REFERENCES MOVIE(movie_id),
  FOREIGN KEY (user_id) REFERENCES USER(user_id)
);

DROP TABLE IF EXISTS is_genres;
CREATE TABLE is_genres
(
  movie_id int NOT NULL,
  genre_id int NOT NULL,
  FOREIGN KEY (movie_id) REFERENCES MOVIE(movie_id),
  FOREIGN KEY (genre_id) REFERENCES GENRE(genre_id)
);

DROP TABLE IF EXISTS has_tags;
CREATE TABLE has_tags
(
  tag_id int NOT NULL,
  movie_id int NOT NULL,
  user_id int NOT NULL,
  FOREIGN KEY (tag_id) REFERENCES TAGS(tag_id),
  FOREIGN KEY (movie_id) REFERENCES MOVIE(movie_id),
  FOREIGN KEY (user_id) REFERENCES USER(user_id)
);

DROP TABLE IF EXISTS watch_list;
CREATE TABLE watch_list
(
  user_id int NOT NULL,
  movie_id int NOT NULL,
  FOREIGN KEY (user_id) REFERENCES USER(user_id),
  FOREIGN KEY (movie_id) REFERENCES MOVIE(movie_id)
);

INSERT INTO MOVIE(title, release_date, summary, language, duration, trailer, poster) VALUES
('Neighbors', '2014-05-09', "New parents Mac (Seth Rogen) and Kelly (Rose Byrne) move to the suburbs when they welcome an infant daughter into their lives. All goes well with the couple, until the Delta Psi Beta fraternity moves in next door. Mac and Kelly don't want to seem uncool, and they try their best to get along with frat president Teddy (Zac Efron) and the rest of the guys. However, when the
couple finally call the cops during a particularly raucous frat party, a full-scale war erupts.", 'English', '01:37:00', 'https://www.youtube.com/embed/KrAf5ALLxGI', 'neighbors.jpg'),
('Neighbors 2', '2016-05-20', "Life is good for Mac Radner (Seth Rogen) and pregnant wife Kelly (Rose Byrne) until the unruly sisters of Kappa Nu move in next door. As the loud parties threaten the sale of their home, the couple turn to ex-neighbor and one-time enemy Teddy Sanders (Zac Efron) for help. Now united with the former college student, the trio devises schemes to get the wild sorority off
the block. Unfortunately, the rebellious young women refuse to go down without a fight.", 'English', '01:32:00', 'https://www.youtube.com/embed/X2i9Zz_AqTg', 'neighbors2.jpg'),
('The Notebook', '2004-06-25', "In 1940s South Carolina, mill worker Noah Calhoun (Ryan Gosling) and rich girl Allie (Rachel McAdams) are desperately in love. But her parents don't approve. When Noah goes off to serve in World War II, it seems to mark the end of their love affair. In the interim, Allie becomes involved with another man (James Marsden). But when Noah returns to their small town years
later, on the cusp of Allie's marriage, it soon becomes clear that their romance is anything but over.", 'English', '02:04:00', 'https://www.youtube.com/embed/4M7LIcH8C9U', 'notebook.jpg'),
('The Avengers', '2012-05-04', "When Thor's evil brother, Loki (Tom Hiddleston), gains access to the unlimited power of the energy cube called the Tesseract, Nick Fury (Samuel L. Jackson), director of S.H.I.E.L.D., initiates a superhero recruitment effort to defeat the unprecedented threat to Earth. Joining Fury's 'dream team' are Iron Man (Robert Downey Jr.), Captain America (Chris Evans), the Hulk
(Mark Ruffalo), Thor (Chris Hemsworth), the Black Widow (Scarlett Johansson) and Hawkeye (Jeremy Renner).", 'English', '02:23:00', 'https://www.youtube.com/embed/hIR8Ar-Z4hw', 'avengers.jpg'),
('The Ring', '2002-10-18', "It sounds like just another urban legend -- a videotape filled with nightmarish images leads to a phone call foretelling the viewer's death in exactly seven days. Newspaper reporter Rachel Keller (Naomi Watts) is skeptical of the story until four teenagers all die mysteriously exactly one week after watching just such a tape. Allowing her investigative curiosity to get the
better of her, Rachel tracks down the video and watches it. Now she has just seven days to unravel the mystery.", 'English', '02:25:00', 'https://www.youtube.com/embed/vhdqYkXor5s', 'ring.jpg'),
('American Psycho', '2000-04-14', "In New York City in 1987, a handsome, young urban professional, Patrick Bateman (Christian Bale), lives a second life as a gruesome serial killer by night. The cast is filled by the detective (Willem Dafoe), the fiance (Reese Witherspoon), the mistress (Samantha Mathis), the coworker (Jared Leto), and the secretary (Chloë Sevigny). This is a biting, wry comedy examining
the elements that make a man a monster.", 'English', '01:44:00', 'https://www.youtube.com/embed/2GIsExb5jJU', 'american-psycho.jpg'),
('The Grudge', '2004-10-22', "Matthew Williams (William Mapother), his wife, Jennifer (Clea DuVall), and mother, Emma (Grace Zabriskie), are Americans making a new life in Tokyo. Together they move into a house that has been the site of supernatural occurrences in the past, and it isn't long before their new home begins terrorizing the Williams family as well. The house, as it turns out, is the site of a
curse that lingers in a specific place and claims the lives of anyone that comes near.", 'English', '01:36:00', 'https://www.youtube.com/embed/YC3bzK_i9_s', 'grudge.jpg'),
('The Expendables', '2010-08-13', "Mercenary leader Barney Ross (Sylvester Stallone) and his loyal men take on what they think is a routine assignment: a covert operation to invade the South American country of Vilena and overthrow its dictator. But, when they learn that the job will be a suicide mission, they must choose redemption or the destruction of their brotherhood.", 'English', '01:53:00',
'https://www.youtube.com/embed/IN63RwnB9NA', 'expendables.jpg'),
('Deadpool', '2016-02-12', "Wade Wilson (Ryan Reynolds) is a former Special Forces operative who now works as a mercenary. His world comes crashing down when evil scientist Ajax (Ed Skrein) tortures, disfigures and transforms him into Deadpool. The rogue experiment leaves Deadpool with accelerated healing powers and a twisted sense of humor. With help from mutant allies Colossus and Negasonic Teenage
Warhead (Brianna Hildebrand), Deadpool uses his new skills to hunt down the man who nearly destroyed his life.", 'English', '01:48:00', 'https://www.youtube.com/embed/ONHBaC-pfsk', 'deadpool.jpg'),
('Thor', '2011-05-05', "As the son of Odin (Anthony Hopkins), king of the Norse gods, Thor (Chris Hemsworth) will soon inherit the throne of Asgard from his aging father. However, on the day that he is to be crowned, Thor reacts with brutality when the gods' enemies, the Frost Giants, enter the palace in violation of their treaty. As punishment, Odin banishes Thor to Earth. While Loki (Tom Hiddleston),
Thor's brother, plots mischief in Asgard, Thor, now stripped of his powers, faces his greatest threat.", 'English', '01:45:00', 'https://www.youtube.com/embed/JOddp-nlNvQ', 'thor.jpg'),
('Guardians of the Galaxy', '2014-08-01', "Brash space adventurer Peter Quill (Chris Pratt) finds himself the quarry of relentless bounty hunters after he steals an orb coveted by Ronan, a powerful villain. To evade Ronan, Quill is forced into an uneasy truce with four disparate misfits: gun-toting Rocket Raccoon, treelike-humanoid Groot, enigmatic Gamora, and vengeance-driven Drax the Destroyer.
But when he discovers the orb's true power and the cosmic threat it poses, Quill must rally his ragtag group to save the universe.", 'English', '02:02:00', 'https://www.youtube.com/embed/d96cjJhvlMA', 'guardians.jpg'),
('Star Wars: The Force Awakens', '2015-12-18', "Star Wars: The Force Awakens (also known as Star Wars: Episode VII – The Force Awakens) is a 2015 American epic space opera film directed, co-produced, and co-written by J. J. Abrams. The direct sequel to 1983's Return of the Jedi, The Force Awakens is the first installment of the Star Wars sequel trilogy, and stars Harrison Ford, Mark Hamill, Carrie Fisher,
Adam Driver, Daisy Ridley, John Boyega, Oscar Isaac, Lupita Nyong'o, Andy Serkis, Domhnall Gleeson, Anthony Daniels, Peter Mayhew, and Max von Sydow. Produced by Lucasfilm Ltd. and Abrams' production company Bad Robot Productions and distributed worldwide by Walt Disney Studios Motion Pictures, The Force Awakens marks a break in creative control from the original series as the first Star Wars film not
produced by franchise creator George Lucas. Set 30 years after Return of the Jedi, it follows Rey, Finn and Poe Dameron's search for Luke Skywalker and their fight alongside the Resistance, led by veterans of the Rebel Alliance, against Kylo Ren and the First Order, a successor organization to the Galactic Empire.", 'English', '02:15:00', 'https://www.youtube.com/embed/sGbxmsDFVnE', 'force-awakens.jpg'),
('The 40-Year-Old Virgin', '2005-08-19', "Andy Stitzer (Steve Carell) is an amiable single guy who works at a big-box store. Living alone, 40-year-old Andy spends his free time playing video games and curating his action-figure collection. Despite his age, Andy has never had sex, so his friends, including the laid-back David (Paul Rudd), push Andy towards losing his virginity. While attempting to get over
his awkwardness around female customers, Andy meets local shop owner Trish (Catherine Keener), and they begin a tentative romance.", 'English', '02:13:00', 'https://www.youtube.com/embed/b9TeAHszSh0', '40yo-virgin.jpg'),
('Fight Club', '1999-09-21', "A depressed man (Edward Norton) suffering from insomnia meets a strange soap salesman named Tyler Durden (Brad Pitt) and soon finds himself living in his squalid house after his perfect apartment is destroyed. The two bored men form an underground club with strict rules and fight other men who are fed up with their mundane lives. Their perfect partnership frays when Marla
(Helena Bonham Carter), a fellow support group crasher, attracts Tyler's attention.", 'English', '02:31:00', 'https://www.youtube.com/embed/SUXWAEX2jlg', 'fight-club.jpg'),
('Jaws', '1975-06-20', "When a young woman is killed by a shark while skinny-dipping near the New England tourist town of Amity Island, police chief Martin Brody (Roy Scheider) wants to close the beaches, but mayor Larry Vaughn (Murray Hamilton) overrules him, fearing that the loss of tourist revenue will cripple the town. Ichthyologist Matt Hooper (Richard Dreyfuss) and grizzled ship captain Quint
(Robert Shaw) offer to help Brody capture the killer beast, and the trio engage in an epic battle of man vs. nature.", 'English', '02:10:00', 'https://www.youtube.com/embed/U1fu_sA7XhE', 'jaws.jpg'),
('Titanic', '1997-12-19', "James Cameron's 'Titanic' is an epic, action-packed romance set against the ill-fated maiden voyage of the R.M.S. Titanic; the pride and joy of the White Star Line and, at the time, the largest moving object ever built. She was the most luxurious liner of her era -- the 'ship of dreams' -- which ultimately carried over 1,500 people to their death in the ice cold waters of
the North Atlantic in the early hours of April 15, 1912.", 'English', '03:15:00', 'https://www.youtube.com/embed/zCy5WQ9S4c0', 'titanic.jpg'),
('Jurassic Park', '1993-06-07', "In Steven Spielberg's massive blockbuster, paleontologists Alan Grant (Sam Neill) and Ellie Sattler (Laura Dern) and mathematician Ian Malcolm (Jeff Goldblum) are among a select group chosen to tour an island theme park populated by dinosaurs created from prehistoric DNA. While the park's mastermind, billionaire John Hammond (Richard Attenborough), assures everyone
that the facility is safe, they find out otherwise when various ferocious predators break free and go on the hunt.", 'English', '02:07:00', 'https://www.youtube.com/embed/lc0UehYemQA', 'jurassic-park.jpg'),
('Her', '2013-12-18', "A sensitive and soulful man earns a living by writing personal letters for other people. Left heartbroken after his marriage ends, Theodore (Joaquin Phoenix) becomes fascinated with a new operating system which reportedly develops into an intuitive and unique entity in its own right. He starts the program and meets 'Samantha' (Scarlett Johansson), whose bright voice reveals
a sensitive, playful personality. Though 'friends' initially, the relationship soon deepens into love.", 'English', '02:06:00', 'https://www.youtube.com/embed/WzV6mXIOVl4', 'her.jpg'),
('Interstellar', '2014-10-26', "In Earth's future, a global crop blight and second Dust Bowl are slowly rendering the planet uninhabitable. Professor Brand (Michael Caine), a brilliant NASA physicist, is working on plans to save mankind by transporting Earth's population to a new home via a wormhole. But first, Brand must send former NASA pilot Cooper (Matthew McConaughey) and a team of researchers
through the wormhole and across the galaxy to find out which of three planets could be mankind's new home.", 'English', '02:49:00', 'https://www.youtube.com/embed/2LqzF5WauAw', 'interstellar.jpg'),
('Inception', '2010-07-13', "Dom Cobb (Leonardo DiCaprio) is a thief with the rare ability to enter people's dreams and steal their secrets from their subconscious. His skill has made him a hot commodity in the world of corporate espionage but has also cost him everything he loves. Cobb gets a chance at redemption when he is offered a seemingly impossible task: Plant an idea in someone's mind. If
he succeeds, it will be the perfect crime, but a dangerous enemy anticipates Cobb's every move.", 'English', '02:28:00', 'https://www.youtube.com/embed/YoHD9XEInc0', 'inception.jpg'),
('Frank', '2014-10-10', "An aspiring musician (Domhnall Gleeson) finds himself way out of his element after he joins a pop group led by an enigmatic figure (Michael Fassbender) who wears a giant fake head.", 'English', '01:36:00', 'https://www.youtube.com/embed/-catC4tBVyY', 'frank.jpg'),
('Divergent', '2014-03-21', "Tris Prior (Shailene Woodley) lives in a futuristic world in which society is divided into five factions. As each person enters adulthood, he or she must choose a faction and commit to it for life. Tris chooses Dauntless -- those who pursue bravery above all else. However, her initiation leads to the discovery that she is a Divergent and will never be able to fit into
just one faction. Warned that she must conceal her status, Tris uncovers a looming war which threatens everyone she loves.", 'English', '02:19:00', 'https://www.youtube.com/embed/sutgWjz10sM', 'divergent.jpg'),
('Anchorman 2: The Legend Continues', '2013-12-18', "Seven years after capturing the heart of co-anchor Veronica Corningstone (Christina Applegate), newsman Ron Burgundy (Will Ferrell) is offered the chance of a lifetime: a spot on the world's first 24-hour global cable news network. Ron quickly assembles his team: Champ Kind (David Koechner), Brian Fantana (Paul Rudd) and Brick Tamland
(Steve Carell). Challenged by his tough female boss, a network owner and a popular anchor, Ron and his pals must find their own way to the top of the ratings.", 'English', '01:59:00', 'https://www.youtube.com/embed/Elczv0ghqw0', 'anchorman2.jpg'),
('Bruce Almighty', '2003-05-23', "Bruce Nolan's (Jim Carrey) career in TV has been stalled for a while, and when he's passed over for a coveted anchorman position, he loses it, complaining that God is treating him poorly. Soon after, God (Morgan Freeman) actually contacts Bruce and offers him all of his powers if he thinks he can do a better job. Bruce accepts and goes on a spree, using his new-found
abilities for selfish, personal use until he realizes that the prayers of the world are going unanswered.", 'English', '01:41:00', 'https://www.youtube.com/embed/fe-luzrqWSk', 'bruce.jpg'),
('The Grand Budapest Hotel', '2014-03-07', "In the 1930s, the Grand Budapest Hotel is a popular European ski resort, presided over by concierge Gustave H. (Ralph Fiennes). Zero, a junior lobby boy, becomes Gustave's friend and protege. Gustave prides himself on providing first-class service to the hotel's guests, including satisfying the sexual needs of the many elderly women who stay there. When one
of Gustave's lovers dies mysteriously, Gustave finds himself the recipient of a priceless painting and the chief suspect in her murder.", 'English', '01:40:00', 'https://www.youtube.com/embed/1Fg5iWmQjwk', 'budapest.jpg'),
('Forrest Gump', '1994-07-06', "Slow-witted Forrest Gump (Tom Hanks) has never thought of himself as disadvantaged, and thanks to his supportive mother (Sally Field), he leads anything but a restricted life. Whether dominating on the gridiron as a college football star, fighting in Vietnam or captaining a shrimp boat, Forrest inspires people with his childlike optimism. But one person Forrest cares
about most may be the most difficult to save -- his childhood love, the sweet but troubled Jenny (Robin Wright).", 'English', '02:22:00', 'https://www.youtube.com/embed/bLvqoHBptjg', 'gump.png'),
('Big Hero 6', '2014-11-07', "Robotics prodigy Hiro (Ryan Potter) lives in the city of San Fransokyo. Next to his older brother, Tadashi, Hiro's closest companion is Baymax (Scott Adsit), a robot whose sole purpose is to take care of people. When a devastating turn of events throws Hiro into the middle of a dangerous plot, he transforms Baymax and his other friends, Go Go Tamago (Jamie Chung),
Wasabi (Damon Wayans Jr.), Honey Lemon (Genesis Rodriguez) and Fred (T.J. Miller) into a band of high-tech heroes.", 'English', '01:42:00', 'https://www.youtube.com/embed/z3biFxZIJOQ', 'hero6.jpg'),
('Your Name', '2017-04-07', "A teenage boy and girl embark on a quest to meet each other for the first time after they magically swap bodies.", 'Japanese', '01:47:00', 'https://www.youtube.com/embed/hRfHcp2GjVI', 'kimi.jpg'),
('Taken', '2009-01-30', "Bryan Mills (Liam Neeson), a former government operative, is trying to reconnect with his daughter, Kim (Maggie Grace). Then his worst fears become real when sex slavers abduct Kim and her friend shortly after they arrive in Paris for vacation. With just four days until Kim will be auctioned off, Bryan must call on every skill he learned in black ops to rescue her.", 'English',
'01:33:00', 'https://www.youtube.com/embed/uPJVJBm9TPA', 'taken.jpg'),
('Tenacious D in The Pick of Destiny', '2006-11-22', "Musicians JB (Jack Black) and KG (Kyle Gass) begin a friendship that could lead to the formation of the greatest rock band in the world. To make that dream come true, the righteous duo embark on a quest to find a legendary guitar pick that possesses supernatural powers.", 'English', '01:35:00', 'https://www.youtube.com/embed/TXxQFMG86HA', 'tenacious.jpg');

INSERT INTO GENRE(genre) VALUES('Comedy'),('Romance'),('Fantasy'),('Science Fiction'),('Drama'),('Thriller'),('Mystery'),('Horror'),('Slasher'),('Action'), ('Buddy'), ('Disaster'), ('Farce'), ('Crime'), ('Western'), ('Animation'), ('Romantic Comedy'), ('War'), ('Adventure'), ('Fiction'), ('Documentary'), ('Art'), ('Biographical'), ('Family'),
('Spy'), ('Experimental'), ('Heist'), ('Melodrama'), ('Cult'), ('Epic');

INSERT INTO USER(admin_tag, first_name, middle_name, last_name, dob, gender, username, password) VALUES
(1, 'Parker', 'Alexander', 'Householder', '1996-05-01', 'Male', 'paho224', 'd96dafb2beaab65e1abb358c6f2ba54d28afb293f97166cfad806fdd71a1258e'),
(1, 'Evan', 'Phillip', 'Heaton', '1995-02-02', 'Male', 'ephe225', '8016110fdcdea61ba0f3a072700e7e2a5458d3e073d2091cb7c733a7678cafc1'),
(1, 'David', 'Clark', 'Cottrell', '1995-04-03', 'Male', 'dcco226', '0df8b790dcca0b6fbdb3cff266c917061ff4c0e56ef4de988c2384eab0ef8436'),
(1, 'Jonathan', 'Mark', 'Dingess', '1997-01-24', 'Male', 'jmdi234', '4ad85f2050e0c1edac2c51540778c762f03df8f4603923907ffc85615fbbc431'),
(0, 'Morgan', 'Shay', 'Lewis', '1995-10-10', 'Female', 'msle228', 'e71320b00399d4e6e125d5fff397966dd40901a5ca9ad42529601808e888af08'),
(0, 'Sarah', 'Elizabeth', 'Foster', '1993-04-08', 'Female', 'sefo229', '83e5df9e4c786be5b1b32da1dda5ae79348b99e281497f6d81152a777ba1bdcc'),
(0, 'Ashley', 'Anna', 'Householder', '1992-09-17', 'Female', 'aaho230', 'f600076ea2edeb7487c6f4d622c5f018bac4bd7b6caa6781b8f1d9db8da296d2'),
(0, 'James', 'Bryan', 'Householder', '1963-09-17', 'Male', 'jbho231', '2f88f54f1ba682f86c86a81a1430cc0f0bedea61cec04af71ec2cd32eea941e2'),
(0, 'Monica', 'Ott', 'Householder', '1967-03-14', 'Female', 'moho232', '4dfdad8afbcf7135eba27c9145aa62d0d0890dacdac1f459c19f9169f11745b6'),
(0, 'Donald', 'John', 'Trump', '1946-05-14', 'Male', 'djtr233', '0cbf32966ac2ad6e21e5da39cf80e7203a04218b44edcca347afe435dd05bf3b'),
(0, 'Caleb', 'Daniel', 'Settle', '1997-1-16', 'Male', 'cdse123', '2eaf32312fdr4323fy42315123dbb34345534132d1234as23d05afeca23421sz'),
(0, 'Barack', 'Hussein', 'Obama', '1961-8-4', 'Male', 'bhob234', '54ab31feu263h7l78hagsb4mn6la71sh47126153h5kdas12938475as123412'),
(0, 'Michelle', 'Lavaughn Robinson', 'Obama', '1964-1-17', 'Female', 'mlob234', 'w123412kahdyh27102da1231c3845mh1as2361slkru471w234231'),
(0, 'Ben', 'Geza', 'Affleck', '1972-8-15', 'Male', 'bena123', 'w123412kahdyh27102da1231c3845mh1as2361slkru471w234231'),
(0, 'Serena', 'Jameka', 'Williams', '1981-9-26', 'Female', 'sjwi232','0cbf32966ac2ad6e21e5da39cf80e7203a04218b44edcca347afe435dd05bf3b'),
(0, 'Abraham', '', 'Lincoln', '1808-2-12', 'Male', 'abli243','0cfa231fe231f5e2abce31291283acef123abf13a98361bae3671b31b23'),
(0, 'Christian', 'Charles', 'Bale', '1974-01-30', 'Male','crba231', '4de148bcfe23a59e1984bvee312a83712456867bae23e2434efc12ac'),
(0, 'Thomas', 'Jeffrey', 'Hanks', '1956-07-09', 'Male', 'tjha254', '5dae321bcfe8574ae32ce345371aefcdc32d34d5612ab29681beca'),
(0, 'John', 'William', 'Ferrell', '1967-07-16', 'Male', 'jwfe261', '31af31da2b3578ae3312e34aa3411b234bb3567a31aabe341fe3125'),
(0, 'Rachel', 'Anne', 'McAdams', '1978-11-17', 'Female', 'rama324', '3bafe318267ad31ab361bbaef38162f293aabc317ef9371adf472'),
(0, 'Christopher', 'Michael', 'Pratt', '1979-05-21', 'Male', 'cmpr321', '46821abf4fe35891abc948102a4371bbba3d31dbd21a3f3492a'),
(0,'Liam', 'John', 'Neeson', '1952-05-07', 'Male', 'ljne352', '278abedaf15ab31bc42af43716afbae21ab3e16ba1937b2af41a3173ba'),
(0, 'Scarlett', '', 'Johansson', '1984-11-22', 'Female', 'sjoh192', '564781a37b1a7fe716ab371fd231aic30182dab31a9173a31df451ff217'),
(0, 'Edward', 'Harrison', 'Norton', '1969-08-18', 'Male', 'ehno353', 'a3fa33111la737102ab381fca2371daef1933b3e301abeff10381aa1127'),
(0, 'Joaquin', 'Rafael', 'Phoenix', '1974-10-28', 'Male', 'jrph234', '746ab1253baf49ac471a431bb842f71973abed10baaa7361b3017362454'),
(0, 'Leonardo', 'Wilhelm', 'DiCaprio', '1974-11-11', 'Male', 'lwdi432', '31abf3131d31adb31314566bbb345a4434ab213b456614bb4313aefca'),
(0, 'Christian', 'Charles', 'Bale', '1974-01-30', 'Male', 'ccba102', 'ab3619ad8ef34f41316984b17aabe1837dde18a3aa103984f1417a0281d'),
(0, 'Maggie', '', 'Grace', '1983-09-21', 'Female', 'mgra432', '723baf816abfe6451bacffff1324bd301afbabbe3039194f16ad5619471'),
(0, 'Michael', 'Sylvester', 'Stallone', '1946-07-06', 'Male', 'msst241', '514b17b8173a8345b197ba301f165af4ab0389adb10d734123afbce61'),
(0,'Jim', 'Eugene', 'Carrey', '1962-01-17', 'Male', 'jeca453', 'baef3165ad03816babdfcea39178f13f8d198a1039573fffec541a17f4130451');



INSERT INTO TAGS(tag) VALUES('funny'), ('scary'), ('suspenseful'), ('silly'), ('romantic'), ('hardcore'), ('superhero'), ('marvel'), ('gory'), ('adult'), ('action'), ('hero'), ('antihero'), ('competition'), ('corruption'), ('conspiracy'), ('criminal'), ('futuristic'), ('murder'), ('kidnapping'), ('parenthood'), ('supernatural'), ('fantasy'), ('fictional'),
('musical'), ('satire'), ('spoof'), ('slasher'), ('intense'), ('parody');

INSERT INTO CREW(name) VALUES ('Deadpool-crew'), ('Thor-crew'), ('Grudge-crew'), ('Avengers-crew'), ('Neighbors-crew'), ('Expendables-crew'), ('Ring-crew'), ('Notebook-crew'), ('Psycho-crew'), ('Star Wars-crew'), ('Taken-crew'), ('40yo-virgin-crew'), ('Anchorman2-crew'), ('Forrest-crew'), ('Bruce-Almighty-crew'), ('guardians-crew'), ('Titanic-crew'), ('fight-club-crew'), ('Divergent-crew'),
('Jurassic-park-crew');

INSERT INTO MEMBER(first_name, middle_name, last_name, dob, gender) VALUES
('Ryan', 'Rodney', 'Reynolds', '1976-10-23', 'Male'),
('Chris', NULL, 'Hemsworth', '1983-08-11', 'Male'),
('Takashi', NULL, 'Shimizu', '1972-07-27', 'Male'),
('Lisa', NULL, 'Lassek', '1970-05-21', 'Female'),
('Zach', 'David', 'Efron', '1987-10-18', 'Male'),
('Michael', 'Sylvester', 'Stallone', '1946-07-06', 'Male'),
('Daveigh', 'Elizabeth', 'Chase', '1990-07-24', 'Female'),
('Robert', NULL, 'Fraisse', '1940-05-05', 'Male'),
('Rachel', 'Anne', 'McAdams', '1978-11-17', 'Female'),
('Christian', 'Charles', 'Bale', '1974-01-30', 'Male'),
('Seth', 'Aaron', 'Rogen', '1982-04-15', 'Male'),
('Jim', 'Eugene', 'Carrey', '1962-01-17', 'Male'),
('Mary', 'Rose', 'Byrne', '1979-07-24', 'Female'),
('Thomas', 'Jeffrey', 'Hanks', '1956-07-09', 'Male'),
('Christopher', 'Michael', 'Pratt', '1979-05-21', 'Male'),
('Liam', 'John', 'Neeson', '1952-05-07', 'Male'),
('Leonardo', 'Wilhelm', 'DiCaprio', '1974-11-11', 'Male'),
('John', 'William', 'Ferrell', '1967-07-16', 'Male'),
('Brent', NULL, 'White', '1950-03-04', 'Male'),
('Edward', 'Harrison', 'Norton', '1969-08-18', 'Male'),
('Shailene', 'Diann', 'Woodley', '1991-11-15', 'Female'),
('Jeffrey', 'Lynn', 'Goldblum', '1952-10-22', 'Male'),
('Steven', 'John', 'Carell', '1962-08-16', 'Male'),
('Sarah', 'Michelle', 'Gellar', '1977-04-14', 'Female'),
('Maggie', NULL, 'Grace', '1983-09-21', 'Female'),
('Daisy', 'Isobel', 'Ridley', '1992-04-10', 'Female'),
('Harrison', NULL, 'Ford', '1942-07-13', 'Male'),
('Carrie', 'Frances', 'Fisher', '1956-10-21', 'Female'),
('Scarlett', NULL, 'Johansson', '1984-11-22', 'Female'),
('Joaquin', 'Rafael', 'Phoenix', '1974-10-28', 'Male');

INSERT INTO ROLE(role) VALUES ('Director'), ('Producer'), ('Screenwriter'), ('Actor'), ('Editor'), ('Production Designer'), ('Art Director'), ('Extra'), ('Cinematographer'), ('Tech');

INSERT INTO has_members(crew_id, mem_id, role_id) VALUES (1, 1, 4), (2, 2, 4), (3, 3, 1), (4, 4, 5), (5, 5, 4), (6, 6, 3), (7, 7, 4), (8, 8, 9), (8, 9, 4), (9, 10, 4), (10, 26, 4), (10, 27, 4), (10, 28, 4), (5, 11, 4), (5, 13, 4), (11, 25, 4),
(11, 16, 4), (12, 19, 5), (13, 19, 5), (14, 14, 4), (15, 12, 4), (16, 15, 4), (17, 17, 4), (13, 18, 4), (18, 20, 4), (19, 21, 4), (20, 22, 4);

INSERT INTO has_crew(movie_id, crew_id) VALUES (1, 5), (2, 5), (3, 8), (4, 4), (5, 7), (6, 9), (7, 3), (8, 6), (9, 1), (10, 2), (12, 10), (23, 13), (13, 12), (29, 11), (26, 14), (24, 15), (11, 16), (16, 17), (14, 18), (22, 19), (17, 20);

INSERT INTO is_genres(movie_id, genre_id) VALUES (1, 1), (2, 1), (3, 2), (3, 5), (4, 3), (4, 4), (5, 6), (5, 7), (6, 5), (6, 9), (7, 6), (7, 7), (8, 10), (8, 6), (9, 10), (9, 4), (10, 3),
(10, 4), (12, 3), (12, 4), (11, 3), (11, 10), (13, 2), (13, 11), (14, 5), (15, 7), (15, 5), (16, 12), (16, 5), (17, 3), (17, 4), (18, 2), (18, 5), (19, 4), (19, 7), (20, 4), (20, 6), (21, 3),
(21, 5), (22, 4), (22, 6), (30, 1), (30, 13), (29, 6), (29, 10), (28, 3), (28, 5), (27, 10), (27, 4), (26, 1), (26, 5), (25, 14), (25, 5), (24, 5), (24, 3), (23, 1);

INSERT INTO has_tags VALUES (1, 1, 1), (1, 2, 2), (5, 3, 3), (7, 4, 4), (8, 4, 5), (2, 5, 6), (3, 5, 7), (4, 6, 8), (9, 7, 9), (2, 7, 10), (1, 8, 1), (6, 8, 2), (10, 9, 3), (8, 9, 4), (8, 10, 5), (7, 10, 6);

INSERT INTO user_actions(user_id, movie_id, rating, review) VALUES
(1, 1, 8, 'This movie was rather enjoyable and funny'),
(2, 2, 8, 'It was ok, but the first one was definitely better!'),
(3, 3, 10, 'The story told by this movie was absolutely beautiful in every single way'),
(4, 4, 10, 'Probably one of my favorite marvel movies in recent years'),
(5, 5, 8, 'It was very suspenseful and scary'),
(6, 6, 8, 'This movie was really good, but there were definitely some flaws'),
(7, 7, 8, 'Definitely one of my favorite horror movies of all time!'),
(8, 8, 8, 'I absolutely love sylvestor salone, and his role in this movie was outstanding!'),
(9, 9, 10, 'This movie has to be the greatest marvel movie of all time! A must see!'),
(10, 10, 6, 'It was good but not that good');
