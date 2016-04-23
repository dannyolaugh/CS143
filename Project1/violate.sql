/*
PRIMARY KEYS
Movie.id
Actor.id
Director.id
*/

INSERT INTO Movie VALUES (2, 'Stuff', 2016, 'G', 'None');
/*There is already a movie with id 2, thus violates primary key constaint.*/
INSERT INTO Actor VALUES (1, 'Smith','Fred','Male','1990-01-01','2000-12-12');
/*There is already an actor with id 1, thus violates primary key constraint*/
INSERT INTO Director VALUES (16,'Lucas','Greg','1800-12-12','1900-11-11');
/*There is alreadt a Director with id 16, thus violates primary key constaint*/
/*
ERRORS (In Order)
ERROR 1062 (23000) at line 8: Duplicate entry '2' for key 'PRIMARY'
ERROR 1062 (23000) at line 9: Duplicate entry '1' for key 'PRIMARY'
ERROR 1062 (23000) at line 10: Duplicate entry '16' for key 'PRIMARY'
*/


/*
FOREIGN KEYS
Sales.mid is some Movie.id
MovieGenre.mid is some Movie.id
MovieDirector.mid is some Movie.id
MovieDirector.did is some Director.id
MovieActor.mid is some Movie.id
MovieActor.aid is some Actor.id
MovieRating.mid is some Movie.id
*/

INSERT INTO Sales VALUES (7, 100, 100);
/* 7 is not a viable movie id, there is no movie with id 7*/
INSERT INTO MovieGenre VALUES (7, 'Drama');
/* 7 is not a viable movie id, there is no movie with id 7*/
INSERT INTO MovieDirector VALUES (7, 16);
/* 7 is not a viable movie id, there is no movie with id 7*/
INSERT INTO MovieDirector VALUES (2, 1);
/* 1 is not a viable director id, there is no director with id 1*/
INSERT INTO MovieActor VALUES (7, 1);
/* 7 is not a viable movie id, there is no movie with id 7*/
INSERT INTO MovieActor VALUES (2, 2);
/* 2 is not a viable actor, there is no actor with id 2*/
INSERT INTO MovieRating VALUES (7, 0, 0);
/* 7 is not a viable movie id, there is no movie wiht id 7*/
/*
ERRORS (In Order)
ERROR 1452 (23000) at line 30: Cannot add or update a child row: a foreign key constraint fails ('CS143'.'Sales', CONSTRAINT 'Sales_ibfk_1' FOREIGN KEY ('mid') REFERENCES 'Movie' ('id'))

ERROR 1452 (23000) at line 31: Cannot add or update a child row: a foreign key constraint fails ('CS143'.'MovieGenre', CONSTRAINT 'MovieGenre_ibfk_1' FOREIGN KEY ('mid') REFERENCES 'Movie' ('id'))

ERROR 1452 (23000) at line 32: Cannot add or update a child row: a foreign key constraint fails ('CS143'.'MovieDirector', CONSTRAINT 'MovieDirector_ibfk_1' FOREIGN KEY ('mid') REFERENCES 'Movie' ('id'))

ERROR 1452 (23000) at line 33: Cannot add or update a child row: a foreign key constraint fails ('CS143'.'MovieDirector', CONSTRAINT 'MovieDirector_ibfk_1' FOREIGN KEY ('did') REFERENCES 'Director' ('id'))

ERROR 1452 (23000) at line 34: Cannot add or update a child row: a foreign key constraint fails ('CS143'.'MovieActor', CONSTRAINT 'MovieActor_ibfk_1' FOREIGN KEY ('mid') REFERENCES 'Movie' ('id'))

ERROR 1452 (23000) at line 35: Cannot add or update a child row: a foreign key constraint fails ('CS143'.'MovieActor', CONSTRAINT 'MovieActor_ibfk_1' FOREIGN KEY ('aid') REFERENCES 'Actor' ('id'))

ERROR 1452 (23000) at line 36: Cannot add or update a child row: a foreign key constraint fails ('CS143'.'MovieRating', CONSTRAINT 'MovieRating_ibfk_1' FOREIGN KEY ('mid') REFERENCES 'Movie' ('id'))
*/


/*
CHECKS
Check that Movie.id is a positive number
Check that the sex of the actor is 'Male' or 'Female'
Check that the tickects sold is greater than or equal to 0
*/

INSERT INTO Movie VALUES (-1, 'a', '1994', 'G' 'None');
/* -1 is not a positive number, cannot be a movie id*/
INSERT INTO Actor VALUES (2, 'Sand', 'Alex', '?', '1992-12-12', '1995-12-12');
/* you can not have a ? as your sex, must be Male or Female*/
INSERT INTO Sales VALUES (2, -1, 10000);
/* cannot sell a negative amount of tickets, -1 is negative*/
