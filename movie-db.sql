DROP DATABASE IF EXISTS Databased_movie;
CREATE DATABASE Databased_movie;

USE Databased_movie;

/* --------------Main Tables-------------- */
DROP TABLE IF EXISTS MOVIE;
CREATE TABLE MOVIE
(
  movie_id int NOT NULL AUTO_INCREMENT,
  title varchar(64) NOT NULL,
  release_date varchar(64) NOT NULL,
  summary varchar(1024),
  language varchar(64) NOT NULL,
  duration int NOT NULL,
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
  dob varchar(64) NOT NULL,
  gender varchar(64),
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
  dob varchar(64) NOT NULL,
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

DROP TABLE IF EXISTS LOGIN;
CREATE TABLE LOGIN
(
  username varchar(16) NOT NULL,
  password varchar(16) NOT NULL,
  user_id int NOT NULL,
  PRIMARY KEY (username),
  FOREIGN KEY (user_id) REFERENCES USER(user_id)
);

/* --------------Relationship Tables-------------- */
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

/* --------------Example Insertions-------------- */
INSERT INTO MOVIE(title, release_date, summary, language, duration) VALUES
('Neighbors', '05/09/2014', 'Neighbors is a 2014 American comedy film directed by Nicholas Stoller', 'English', 97),
('Neighbors 2', '05/20/2016', 'Now that Mac and Kelly Radner have a second baby on the way, they are ready to make the final move into adulthood: the suburbs.', 'English', 92),
('The Notebook', '06/25/2004', 'An epic love story centered around an older man who reads aloud to an older, invalid woman whom he regularly visits.', 'English', 124),
('The Avengers', '05/04/2012', 'Marvels The Avengers, or simply The Avengers, is a 2012 American superhero film based on the Marvel Comics superhero team of the same name, produced by Marvel Studios and distributed by Walt Disney Studios Motion Pictures.', 'English', 143),
('The Ring', '10/18/2002', 'It sounded like just another urban legend--videotape filled with nightmarish images, leading to a phone call foretelling the viewers death in exactly seven days.', 'English', 145),
('American Psycho', '04/14/2000', 'Patrick Bateman is young, white, beautiful, ivy leagued, and indistinguishable from his Wall Street colleagues. Shielded by conformity, privilege, and wealth, Bateman is also the ultimate serial killer, roaming freely and fearlessly.', 'English', 104),
('The Grudge', '10/22/2004', 'The Grudge is a 2004 American supernatural horror film and a remake of the Japanese film, Ju-on: The Grudge.', 'English', 96),
('The Expendables', '08/13/2010', 'The Expendables is a 2010 American ensemble action film written by David Callaham and Sylvester Stallone, and directed by Stallone, who also starred in the lead role.', 'English', 113),
('Deadpool', '02/12/2016', 'Based upon Marvel Comics most unconventional anti-hero, DEADPOOL tells the origin story of former Special Forces operative turned mercenary Wade Wilson, who after being subjected to a rogue experiment that leaves him with accelerated healing powers, adopts the alter ego Deadpool.', 'English', 108),
('Thor', '05/05/2011', 'At the center of the story is The Mighty Thor, a powerful but arrogant warrior whose reckless actions reignite an ancient war.', 'English', 115);

INSERT INTO GENRE(genre) VALUES('Comedy'),('Romance'),('Fantasy'),('Science Fiction film'),('Drama film'),('Thriller'),('Mystery'),('Horror'),('Slasher'),('Action');

INSERT INTO USER(admin_tag, first_name, middle_name, last_name, dob, gender) VALUES
(1, 'Parker', 'Alexander', 'Householder', '05/01/1996', 'Male'),
(1, 'Evan', 'Phillip', 'Heaton', '02/02/1995', 'Male'),
(1, 'David', 'Clark', 'Cottrell', '04/03/1995', 'Male'),
(1, 'John', 'Mathew', 'Dingess', '03/24/1996', 'Male'),
(0, 'Morgan', 'Shay', 'Lewis', '10/10/1995', 'Female'),
(0, 'Sarah', 'Elizabeth', 'Foster', '04/08/1993', 'Female'),
(0, 'Ashley', 'Anna', 'Householder', '09/17/1992', 'Female'),
(0, 'James', 'Bryan', 'Householder', '09/17/1963', 'Male'),
(0, 'Monica', 'Ott', 'Householder', '03/14/1967', 'Female'),
(0, 'Donald', 'John', 'Trump', '05/14/1946', 'Male');

INSERT INTO TAGS(tag) VALUES('funny'), ('scary'), ('suspenseful'), ('silly'), ('romantic'), ('hardcore'), ('superhero'), ('marvel'), ('gory'), ('adult');

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
