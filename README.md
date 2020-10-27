# Blizzlike is a CMS for the TrinityCore Open Source MMO Framework.
This is project is designed to be a simple, easy to use web content management system and user
registration portal for World of Warcraft private servers powered by TrinityCore.
This is project is a work in progress, community contributions are always welcome!

## Features
- Account creation page
- Easy to use and install
- A see who's online list that displays the players username, race, level and faction
- A "how to connect" page for the advantage of the users of the server
- Character search (Unfinished "armory")
- Server status
- CMS for editing posts/news on the website
- Forum (Working, but still requires more work.)
- Administration panel for editing server accounts without using the console
- Google Analytics, Ad and Auto Ads management. (Admin panel)
- Gallery

## Installation on Ubuntu 18.04

(optional) Watch the setup video located here:  https://www.youtube.com/watch?v=1h0Cpr5Osg4

### Pre-Requsites

- The project currently requires that all Trinity and CMS databases are located on the same SQL Server.
* We currently do not support hosting your Characters, Auth, World, or BlizzlikeCMS databases on different machines *

**REMINDER: THE WEBSITE IS USING THE "auth" and "characters" databases that comes with Trinity. Without these the site will not work, and you will not be able to log in as the users are the same as the the ones in the "auth" database.**

**The video(s) doesn't mean that you shouldn't read the material underneath, as it explains you more about how to edit the theme/appearance.**

Simply import all the files into your desired website root folder, then open the site in your browser and follow the installation. Make sure you have **permission** to write to includes/config.php

For security reasons, remember to **delete both install.php** files after the installation is complete*

In order to log in to the administration panel, use the same credentials as your server accounts with admin rights.

## Working with CSS/Javascript

If you are going to edit the stylesheet/javascript files you are going to need <a href="https://nodejs.org">Node.js</a> installed as this project comes with watcher/sass scripts.**

1. Setup Node.js by running the command `npm install`. 
2. Next run `npm run watch` to start using the watcher. 
3. Now you can edit the CSS and JS files located in the /src folder.

**PS: This is still a work in progress, but I will try to update the project frequently.**

**Preview of the Legion theme**
<img src='img/demo/legion_demo.png' width='100%'>

## How to Get Help
If you need help or want to contribute, join us on Discord: https://discord.gg/Y9TTaNk