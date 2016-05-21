/*
Primary key for Movie id
Check that the id is greater then 0
*/
CREATE TABLE Movie(
       id int NOT NULL,
       title varchar(100),
       year int,
       rating varchar(10), 
       company varchar(50),
       PRIMARY KEY(id),
       CHECK(id >= 0)
) ENGINE = INNODB;

/*
Primary key for Actor id
Check that the actor is male or female
*/
CREATE TABLE Actor(
       id int NOT NULL, 
       last varchar(20), 
       first varchar(20), 
       sex varchar(6), 
       dob date, 
       dod date,
       PRIMARY KEY(id),
       CHECK(sex = 'Female' OR sex = 'Male' OR sex = NULL)
) ENGINE = INNODB;

/*
mid linked to Movie.id
Check that it sold more than 0 tickets
*/
CREATE TABLE Sales(
       mid int, 
       ticketsSold int, 
       totalIncome int,
       FOREIGN KEY (mid) REFERENCES Movie(id),
       CHECK(ticketsSold >=  0)
) ENGINE = INNODB;

/*
Primary key for Director id
*/
CREATE TABLE Director(
       id int NOT NULL, 
       last varchar(20), 
       first varchar(20),
       dob date, 
       dod date, 
       PRIMARY KEY(id)
) ENGINE = INNODB;

/*mid linked with Movie.id*/
CREATE TABLE MovieGenre(
       mid int, 
       genre varchar(20),
       FOREIGN KEY (mid) REFERENCES Movie(id)
) ENGINE = INNODB;

/*
mid linked with Movie.id
did linked with Director.id
*/
CREATE TABLE MovieDirector(
       mid int, 
       did int,
       FOREIGN KEY (mid) REFERENCES Movie(id),
       FOREIGN KEY (did) REFERENCES Director(id)
) ENGINE =INNODB;

/*
mid linked with Movie.id
aid linked with Actor.id
*/
CREATE TABLE MovieActor(
       mid int, 
       aid int,
       role varchar(50),
       FOREIGN KEY (mid) REFERENCES Movie(id), 
       FOREIGN KEY (aid) REFERENCES Actor(id)
) ENGINE = INNODB;

/*mid linked with Movie.id*/
CREATE TABLE MovieRating(
       mid int, 
       imdb int, 
       rot int,
       FOREIGN KEY (mid) REFERENCES Movie(id)
) ENGINE = INNODB;

CREATE TABLE Review(
       name varchar(20), 
       time timestamp, 
       mid int,
       rating int, 
       comment varchar(500)
) ENGINE = INNODB;

CREATE TABLE MaxPersonID(
       id int
);

CREATE TABLE MaxMovieID(
       id int
);

