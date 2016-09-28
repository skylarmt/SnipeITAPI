Snipe-IT API
============

This is a simple API for accessing a Snipe-IT database.


Installing
----------

Installation is easy.  Assuming you have a web server with PHP and a suitable 
database driver, simply put all the files in this repo in a web-accessible 
folder.

Edit the file database.php and add the connection settings for your Snipe-IT 
database.

On the mobile app, enter the full address for the API server.  Include 
`http(s)://` and the trailing slash. 

The API can be put in a subfolder of the main Snipe-IT installation, but it can 
also be setup on any server that can reach the database.

Troubleshooting
---------------

If you have a problem:

* Check you have the full path (with trailing slash) entered into the app.
* Install PHP Composer and run `composer install`.
* Check you can access the API from a computer.  Go to the API folder/login.php.
  You should see JSON with an error message "Missing username.".  If you see 
  a different error, or there is no error, double-check the database settings, 
  and try installing Composer dependencies.
* If none of these solutions work, open an issue.