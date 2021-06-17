# !! UNFORTUNATELY, THIS PROJECT IS DEAD FOR NOW. YOU ARE STILL FREE TO PULL AND FORK AS YOU LIKE. !!

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
*We currently do not support hosting your Characters, Auth, World, or BlizzlikeCMS databases on different servers.*
- You have the ability to sudo on the CMS server and the TrinityCore server.
*You can host both TrinityCore and Blizzlike on the same machine, but it is not recommended*
- You have some familiartiy with using Linux and have configured networking correctly.
*It is recommended that you use static IP addresses for your servers*

### Things to be aware of

- BlizzlikeCMS does not include it's own user accounts.  It will connect to your TrinityCore Auth DB and use the
existing user accounts from the Trinity server.  
- The GM level of your Trinity user accounts will determine who can access the Admin Panel on the CMS.

### Create the BlizzlikeCMS database and SQL user account.

1.  Log into the TrinityCore WoW SQL server and create a dedicated blizzlike db user account:
`sudo mysql`
`CREATE USER 'BLIZZLIKE_USER'@'BLIZZLIKE_SERVER_IP' IDENTIFIED BY 'SOME_PASSWORD';`
2.  Create an empty Blizzlike CMS Database.
`CREATE DATABASE BLIZZLIKE_DB_NAME DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;`
3.  Allow the Blizzlike user to have admin access to the DB server
`GRANT ALL PRIVILEGES ON *.* TO 'BLIZZLIKE_USER'@'BLIZZLIKE_SERVER_IP' WITH GRANT OPTION;`

### Setup the BlizzlikeCMS web server.

1.  Install the project dependencies.
`sudo apt-get install -y mysql-client apache2 php php-gmp php-imagick php-mysql php-gd php-soap git`
2.  Clone in the project repo into the Apache web server root.
`sudo git clone git@github.com:MariusTBjercke/BlizzlikeCMS.git /var/www/html`
3.  Clean up file system permissions.
`sudo chown www-data:www-data /var/www/html -R`
`sudo chmod 775 /var/www/html -R`
`sudo chmod 777 /var/www/html/img`
`sudo chmod 777 /var/www/html/config.php`
4. Add the PHP_GMP extension to php.ini
`sudo vi /etc/php/{PHP_Version}/apache2/php.ini`
Add the following line anywhere inside:
`extension=php_gmp.so`
5.  Restart the Apache webserver.
`sudo service apache2 restart`

### Run the server install script

1.  From your computer.  Open a web browser and navigate to http://BLIZZLIKE_SERVER_IP/install.php
2.  Use the database user you created in the SQL setup stage above.

### Cleanup

Delete or move the file /var/www/html/install.php in order to keep your installation secure.  Example:
`sudo rm /var/www/html/install.php` to delete the file.
`sudo mv /var/www/html/install.php /home/$USER/install.php` to move it into your home folder.

### Log in and configure the CMS via the admin panel.
1.  Navigate to http://BLIZZLIKE_SERVER_IP/admin.php
2.  You will need to have a GM user in TrinityCore setup before you can log in here.
*If you do not have a GM user in TrinityCore yet, make sure you follow the steps outlined by the TrinityCore project*
*https://trinitycore.atlassian.net/wiki/spaces/tc/pages/77971021/Final+Server+Steps*

## Working with CSS/Javascript

If you are going to edit the stylesheet/javascript files you are going to need <a href="https://nodejs.org">Node.js</a> installed as this project comes with watcher/sass scripts.**

1. Setup Node.js by running the command `npm install`. 
2. Next run `npm run watch` to start using the watcher. 
3. Now you can edit the CSS and JS files located in the /src folder.

**PS: This is still a work in progress, but I will try to update the project frequently.**

**Preview of the Legion theme**
<img src='img/demo/legion_demo.png' width='100%'>
