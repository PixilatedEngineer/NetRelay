# NetRelay

Please see Wiki for documentation


Prerequisites
For a home automation system you would probably use a Raspberry Pi or other computing card.  But you can install the software on any Linux OS.  Here we use Debian since that is what the Raspberry Pi has.  You can use, for example, Ubuntu.  Note that with Ubuntu the use apt-get to install software while on Debian you use yum.

You need to install the following before you start:

Debian—(n/a)  
Apache— yum install apache
MySQL— sudo yum install mysql-server
Python—(already installed in Debian)
PHP—sudo yum install php php-mysql php-devel php-gd php-pecl-memcache php-pspell php-snmp php-xmlrpc php-xml

Installation Overview
You can use root to install everything, as it keeps you from having to worry about of fix Apache folder permissions issues.  If you want to install RelayControl as another user then you will have to debug those permissions issues yourself as we do not explain those here.

Clone Git repository.
Copy that to Apache document root.
Install MySQL server, change root password.
Create RelayControl Database.
Create Replay Control Tables.
Open Application index.php page and verify it works.


Clone Git Repository
This copies the source code to your computer:

git clone https://github.com/PixilatedEngineer/NetRelay


Configure Database.php
You do not need to change the database configuration.  But you will need to copy the or change the root  password here to match the MySQL root that you set.  When you first install MySQL it has no password.  Below we show how to set it.

cat application/config/database.php 


Install MySQL and Create Database
mysql -u root -p

mysql> connect relaycontrol

source relaycontrol.sql
Install MYSQL

sudo /etc/init.d/mysqld restart



create database relaycontrol;
Query OK, 1 row affected (0.00 sec)























Configure config.php


Config.php

$config['base_url'] = 'http://77.235.46.77/';




Copy Application to DocumentRoot "/var/www/html"


/etc/init.d/httpd restart








mysqladmin -u root password IWxcHex9e7LCHjpp9URz

Create Database, Import Data







Open App

http://localhost/raspberry/NetRelay/

Screen should look like this:


