# NetRelay 

(To do:  write overview of what Netrelay does.  Point user to Wiki.)

# NetRelay Installation Instructions

Here are NetRelay installation instructions.   

# Installation Overview
For a home automation system you would probably use a Raspberry Pi or other computing card to install NetRelay, meaning something small and inexpensive.  But you can install the software on any Linux OS.  Here we use Debian since that is what the Raspberry Pi has.  

# Prerequisites
You need to install the following before you start:

**Debian**—(n/a)  
**Apache**— ```yum install apache```
**MySQL**— ```sudo yum install mysql-server```
**Python**—(already installed in Debian)
**PHP**—```sudo yum install php php-mysql php-devel php-gd php-pecl-memcache php-pspell php-snmp php-xmlrpc php-xml```

# Installation Overview
You can use root to install everything, as it keeps you from having to worry about of fix Apache folder permissions issues. If you want to install RelayControl as another user then you will have to set folder and user permissions issues for that yourself as we do not explain those here.

1. Clone Git repository.
2. Copy that to Apache document root.
3. Install MySQL server, change root password.
4. Create RelayControl Database.
5. Create Replay Control Tables.
6. Open Application index.php page and verify it works.


# Clone Git Repository
This copies the source code to your computer:

```git clone https://github.com/PixilatedEngineer/NetRelay```


# Configure Database.php
The database config file is NetRelay/application/config/database.php.  You do not need to change the database configuration except to change the root password here to match the MySQL root that you set.  When you first install MySQL it has no password.  Below we show how to set it.

```cat application/config/database.php``` 

## Connect to MySQL
``` mysql -u root -p ```

## Create RelayControl Database

mysql> connect relaycontrol
create database relaycontrol;

## Run script to populate tables

This is in the NetRelay/sql folder

```source relaycontrol.sql

## Restart MySQL

sudo /etc/init.d/mysqld restart

#Configure config.php
There is only one thing you need to change in NetRelay/application/config/config.php, the IP address of your server. Put the IP address that you can get to from a web browser, e.g., one that is routable from the internet.

```vi config.php```

Change this:

```$config['base_url'] = 'http://(IP address)/';```

"Copy the Application to Apache Document Root 

Copy NetRelay to /var/www/html.  That is the default folder where the Apache web server looks for documents.  So that if you type, for example: http://localhost it will look there.

"" restart Apache 

```/etc/init.d/httpd restart```



# Open App

http://localhost/NetRelay/

Screen should look [like this]https://github.com/werowe/NetRelay/commit/3f8a4c35e4a83e45e51c65850d27e69f0d4cba4f






