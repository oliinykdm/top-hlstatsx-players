# Top HLStatsX Players
Script to display the rating of the hlstatsx players

- ![Alt text](http://top-demo.dev.lab.dima.rv.ua/images/1.png "Screenshot 1") ![Alt text](http://top-demo.dev.lab.dima.rv.ua/images/2.png "Screenshot 2")
- Live demo: http://top-demo.dev.lab.dima.rv.ua/?game=csgo2


# About
Do you want to place on the forum mini-ranked players on your servers (team fortress 2, counter-strike: source, counter-strike: global offensive, etc)?
This script will help you!
It displays not just the last 10 players, and also allows you to watch the rest of the list!

# Advantages
* Not using jQuery and other large libraries
* Runs entirely on Ajax
* Very easy to set up
* Can be used absolutely anywhere (using frames)

# Requirements 
* PHP 5.4 or higher
* Installed hlstatsx

# Installation
* Copy all files to any dir in your web-server.
* Configure include/config.php file (and include/database.class.php for database)
* Add following code to display (e.g. to xenforo right block):
<code>
<iframe src="PATH_TO_SCRIPT/?game=GAME_TYPE" width="245" height="290" frameborder="0" scrolling="no">
</iframe>
</code>
