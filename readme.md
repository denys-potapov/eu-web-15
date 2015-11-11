# EU Web 2015 Submission

## To run locally:

	composer install

	php -S localhost:8080

## Task

Prepare a web application.

### Introduction

Krakow is a famous city with a lot of tourist attractions, hotels, restaurants. You can see Main Square, Wawel castle, Floriańska street, Barbican and many, many other beautiful locations. But of course, moving from point A to point B takes time. When your time for sightseeing is limited, you may want to optimize your tour and find the shortest path between two points on the map.

### Task

Prepare a web application, where users will be able to add, delete and edit connections on the map, each connection will be described by:
1. name of the first point,
2. name of the second point,
3. number of minutes needed to travel between these points.
4. ask to find a shortest path between two points on the map, for example, by selecting them from dropdown menus; as the result, total number of minutes in the shortest path between them should be displayed.

As you may notice, one point may be connected to many other points on the map. As a data storage you may use any SQL database or text files, only databases supporting graph structures are forbidden.

###  Limits for usage specific programs or technologies

Web frameworks are allowed, pick your favorite one. You can't use any external library or software for graph processing, you have to implement it on your own.

### Bonus points

Extra bonus points will be granted for displaying list of all the points in shortest path.

## Evaluation criteria
 - quality of the code
 - object oriented programming usage
 - error handling logic.

# Helpfull commands
	git archive --format zip --output UWCUA.zip master
	