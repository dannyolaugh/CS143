
SELECT CONCAT(first, ' ', last) AS ActorsInDieAnotherDay
FROM Actor, MovieActor
WHERE Actor.id = MovieActor.aid AND MovieActor.mid =
(SELECT id 
FROM Movie
WHERE title = 'Die Another Day');
/*
Use CONCAT to get the correct formating and then search for
corressponding actos in Actor and MovieActor and then pair
movie id with id of Die Another Day
*/

SELECT COUNT(*) AS ActorsInMultipleMovies
FROM 
(SELECT aid
FROM MovieActor
GROUP BY aid
HAVING count(aid) > 1) AS aidNum;
/*
Simply count the number of times that a movie actor
is in more than one movie. Outer portion counts number
of times subquery occurs. Inner portion checks if
the actor is in more than one movie through that actors
actor id.
*/


SELECT title AS MoviesSellingMoreThanOneMillionTickets
FROM Movie, Sales
WHERE Movie.id = Sales.mid AND ticketsSold > 1000000; 
/*
Go through all the titles and check to see if their
ids are the same as the sales id and check if
it has sold more than one million tickets
*/ 

SELECT count(DISTINCT M1.did) AS DirectorsOfMultipleMovies
FROM MovieDirector M1, MovieDirector M2
WHERE M1.mid <> M2.mid AND M1.did = M2.did;
/*
This query gets the number of directors that have
directed more than one movie. I realize it is much like
test case #2 so I did it in a different way by checking
if the director on two different movies in MovieDirector
are the same but the movie ids are different.
*/

SELECT title AS LowestGrossingFilm
FROM Movie, Sales
WHERE Sales.mid = Movie.id AND totalIncome =
(
SELECT MIN(totalIncome)
FROM Sales
);

/*
Fing the movie that made the least total income over its lifespan.
Compare the totalIncome of a movie with the min totalIncome
in Sales. Then check what the title is based off id of the movie.
*/

