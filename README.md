# NetRelay 

(To do:  write overview of what Netrelay does.  Point user to Wiki.)

# NetRelay Installation Instructions

Here are NetRelay installation instructions.   

# Installation Overview
For a home automation system you would probably use a Raspberry Pi or other computing card to install NetRelay, meaning something small and inexpensive.  But you can install the software on any Linux OS.  Here we use Debian since that is what the Raspberry Pi has.  

# Prerequisites
You need to install the following before you start:

**Apache**— yum install apache
**MySQL**— sudo yum install mysql-server
**Python**—(installed in Debian by default)
**PHP**—sudo yum install php php-mysql php-devel php-gd php-pecl-memcache php-pspell php-snmp php-xmlrpc php-xml

# Installation Overview
You can use root to install NetRelay, as it keeps you from having to worry about or fix Apache folder permissions issues. If you want to install RelayControl as another user then you will have to set folder and user permissions issues for that yourself as we do not explain those here.

1. Clone Git repository.
2. Copy that to Apache document root.
3. Install MySQL server. Change MySQL root password.
4. Create RelayControl database.
5. Populate ReplayControl tables.
6. Open Application index.php page and verify that it works.


# Clone Git Repository
This copies the source code to your computer:

```git clone https://github.com/PixilatedEngineer/NetRelay```


# Configure Database.php
The database config file is NetRelay/application/config/database.php.  You do not need to change the database configuration except to change the root password to match the MySQL root that you set

```cat application/config/database.php``` 

## Connect to MySQL
``` mysql -u root -p ```

## Create RelayControl Database

```mysql> connect relaycontrol;```
```mysql> create database relaycontrol;```

## Run script to populate tables

This is in the NetRelay/sql folder

```mysql>  source relaycontrol.sql```

## Restart MySQL

sudo /etc/init.d/mysqld restart

#Configure config.php
There is only one thing you need to change in NetRelay/application/config/config.php: the IP address of your server.  

```vi config.php```

Change this:

```$config['base_url'] = 'http://(IP address)/';```

##Copy the Application to Apache Document Root 

Copy NetRelay to /var/www/html.  That is the default folder where the Apache web server looks for documents.  So that if you type, for example: http://localhost it will look there.

##

## Restart Apache 

```/etc/init.d/httpd restart```

## Configure Apache Access

Set AllowOverride All in http.conf in two places as shown below.  The second is required because we are using .htaccess, which lets a program override directory and file access give in the httpd.conf file.   

First place:
<Directory "/">
  AllowOverride All
</Directory>

Second place:
#
# AllowOverride controls what directives may be placed in .htaccess files.
# It can be "All", "None", or any combination of the keywords:
#   Options FileInfo AuthConfig Limit
#
    AllowOverride All


## Open App

http://localhost/NetRelay/

 





