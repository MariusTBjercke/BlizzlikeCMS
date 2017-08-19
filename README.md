<h3>Welcome to the repository for my try on a CMS for the TrinityCore Open Source MMO Framework.</h3>
This is focused on being easy to setup and use for your own private server.

**FEATURES** 
- Account creation page
- Easy to use and install
- A see who's online list that displays the players username, race, level and faction
- A "how to connect" page for the advantage of the users of the server
- Character search (Unfinished "armory")
- Server status
- CMS for editing posts/news on the website
- Administration panel for editing server accounts without using the console
- Gallery

**SETUP**

Simply import all the files into your desired website root folder, then open the site in your browser and follow the installation. Make sure you have **permission** to write to includes/config.php

For security reasons, remember to **delete both install.php** files after the installation is complete*

**If you are going to edit the stylesheets it is recommended to have <a href="https://nodejs.org">Node.js</a> installed as this project comes with a CSS watcher/minimizer script.**

**First setup Node by running the command "npm install". Then you can run "gulp" or "gulp watch" to start using the CSS-watcher.**

or...

**If you don't want to use minified CSS then simply change the CSS source in the header.php from the current /min folder to the /css folder instead.**

**PS: This is still a work in progress, but I will try to update the project frequently.**

<img src='img/demo.png' width='100%'>