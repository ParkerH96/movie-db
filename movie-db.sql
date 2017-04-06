DROP DATABASE IF EXISTS Databased_movie;
CREATE DATABASE Databased_movie;

USE Databased_movie;

DROP TABLE IF EXISTS MOVIE;
CREATE TABLE MOVIE
(
  movie_id int NOT NULL AUTO_INCREMENT,
  title varchar(64) NOT NULL,
  release_date date NOT NULL,
  summary varchar(1024),
  language varchar(64) NOT NULL,
  duration time NOT NULL,
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
  username varchar(16) NOT NULL,
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
  tag varchar(64) NOT NULL,
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
  FOREIGN KEY (tag_id) REFERENCES TAGS(tag_id),
  FOREIGN KEY (movie_id) REFERENCES MOVIE(movie_id)
);

INSERT INTO MOVIE(title, release_date, summary, language, duration) VALUES
('Neighbors', '2014-05-09', 'Neighbors is a 2014 American comedy film directed by Nicholas Stoller', 'English', '01:37:00'),
('Neighbors 2', '2016-05-20', 'Now that Mac and Kelly Radner have a second baby on the way, they are ready to make the final move into adulthood: the suburbs.', 'English', '01:32:00'),
('The Notebook', '2004-06-25', 'An epic love story centered around an older man who reads aloud to an older, invalid woman whom he regularly visits.', 'English', '02:04:00'),
('The Avengers', '2012-05-04', 'Marvels The Avengers, or simply The Avengers, is a 2012 American superhero film based on the Marvel Comics superhero team of the same name, produced by Marvel Studios and distributed by Walt Disney Studios Motion Pictures.', 'English', '02:23:00'),
('The Ring', '2002-10-18', 'It sounded like just another urban legend--videotape filled with nightmarish images, leading to a phone call foretelling the viewers death in exactly seven days.', 'English', '02:25:00'),
('American Psycho', '2000-04-14', 'Patrick Bateman is young, white, beautiful, ivy leagued, and indistinguishable from his Wall Street colleagues. Shielded by conformity, privilege, and wealth, Bateman is also the ultimate serial killer, roaming freely and fearlessly.', 'English', '01:44:00'),
('The Grudge', '2004-10-22', 'The Grudge is a 2004 American supernatural horror film and a remake of the Japanese film, Ju-on: The Grudge.', 'English', '01:36:00'),
('The Expendables', '2010-08-13', 'The Expendables is a 2010 American ensemble action film written by David Callaham and Sylvester Stallone, and directed by Stallone, who also starred in the lead role.', 'English', '01:53:00'),
('Deadpool', '2016-02-12', 'Based upon Marvel Comics most unconventional anti-hero, DEADPOOL tells the origin story of former Special Forces operative turned mercenary Wade Wilson, who after being subjected to a rogue experiment that leaves him with accelerated healing powers, adopts the alter ego Deadpool.', 'English', '01:48:00'),
('Thor', '2011-05-05', 'At the center of the story is The Mighty Thor, a powerful but arrogant warrior whose reckless actions reignite an ancient war.', 'English', '01:45:00');

INSERT INTO GENRE(genre) VALUES('Comedy'),('Romance'),('Fantasy'),('Science Fiction film'),('Drama film'),('Thriller'),('Mystery'),('Horror'),('Slasher'),('Action');

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
(0, 'Donald', 'John', 'Trump', '1946-05-14', 'Male', 'djtr233', '0cbf32966ac2ad6e21e5da39cf80e7203a04218b44edcca347afe435dd05bf3b');

INSERT INTO TAGS(tag) VALUES('funny'), ('scary'), ('suspenseful'), ('silly'), ('romantic'), ('hardcore'), ('superhero'), ('marvel'), ('gory'), ('adult');

INSERT INTO CREW(name) VALUES ('Deadpool-crew'), ('Thor-crew'), ('Grudge-crew'), ('Avengers-crew'), ('Neighbors-crew'), ('Expendables-crew'), ('Ring-crew'), ('Notebook-crew'), ('Psycho-crew'), ('crew10');

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
('Christian', 'Charles', 'Bale', '1974-01-30', 'Male');

INSERT INTO ROLE(role) VALUES ('Director'), ('Producer'), ('Screenwriter'), ('Actor'), ('Editor'), ('Production Designer'), ('Art Director'), ('Extra'), ('Cinematographer'), ('Tech');

INSERT INTO has_members(crew_id, mem_id, role_id) VALUES (1, 1, 4), (2, 2, 4), (3, 3, 1), (4, 4, 5), (5, 5, 4), (6, 6, 3), (7, 7, 4), (8, 8, 9), (8, 9, 4), (9, 10, 4);

INSERT INTO has_crew(movie_id, crew_id) VALUES (1, 5), (2, 5), (3, 8), (4, 4), (5, 7), (6, 9), (7, 3), (8, 6), (9, 1), (10, 2);

INSERT INTO is_genres(movie_id, genre_id) VALUES (1, 1), (2, 1), (3, 2), (3, 5), (4, 3), (4, 4), (5, 6), (5, 7), (6, 5), (6, 9), (7, 6), (7, 7), (8, 10), (8, 6), (9, 10), (9, 4), (10, 3), (10, 4);

INSERT INTO has_tags(tag_id, movie_id) VALUES (1, 1), (1, 2), (5, 3), (7, 4), (8, 4), (2, 5), (3, 5), (4, 6), (9, 7), (2, 7), (1, 8), (6, 8), (10, 9), (8, 9), (8, 10), (7, 10);

INSERT INTO user_actions(user_id, movie_id, rating, review) VALUES
(1, 1, 8, 'This movie was rather enjoyable and funny'),
(2, 2, 7, 'It was ok, but the first one was definitely better!'),
(3, 3, 10, 'The story told by this movie was absolutely beautiful in every single way'),
(4, 4, 9, 'Probably one of my favorite marvel movies in recent years'),
(5, 5, 10, 'It was very suspenseful and scary'),
(6, 6, 8, 'This movie was really good, but there were definitely some flaws'),
(7, 7, 9, 'Definitely one of my favorite horror movies of all time!'),
(8, 8, 10, 'I absolutely love sylvestor salone, and his role in this movie was outstanding!'),
(9, 9, 10, 'This movie has to be the greatest marvel movie of all time! A must see!'),
(10, 10, 7, 'It was good but not that good');
