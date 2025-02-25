# Demo SQL Injection

<p align="center">
  <a href="#"><img src="./docs/images/shop_screenshot.jpg" /></a>
</p>

The prupose of this mockup of a simple webshop is to demonstrate the sql injection vulnerability. In this project all database queries used are intentionally vulnerable to sql injection.

### Filter
The listed products can be filtered by the `Blend Name`. The userinput is not sanitized what makes it vulnerable for sql injections.
* sort or filter by custom attribute
* edit entries
* drop table
* drop database
* list users from other table
* ...

### Login
The login is also not protected against sql injection.
A logged in user can add items to his cart; a user with admin privileges can additionally delete items.
* login without any credentials
* login as admin
* give a user admin privileges
* ...

### Recreate initial state

At the bottom of the page, there is a button
  <span><img height="15em" src="./docs/images/recreate.png" /></span>, which restores a pristine db state.

## Setup

Create in mysql a new user `sql_injection` and grant him all privileges only for the database `inject_demodb`. It's important to ensure no other databases are affected by the sql injection vulnerability.

```SQL
CREATE USER 'sql_injection'@'%' IDENTIFIED BY 'VeHUutCp7Z9SQYTHP4I55oCzz6ohaT5R';
GRANT ALL PRIVILEGES ON `inject_demodb` . * TO 'sql_injection'@'%';
FLUSH PRIVILEGES;
```

Create the Database `inject_demodb`:

```SQL
CREATE DATABASE inject_demodb;
```

Edit the `$host` in the file [connectdb.php](lib/connectdb.php).

Then serve `index.php` and click the a button `Recreate Table` which will create the table `coffee` in your database and seed some data. The data was created with the [faker-gem](https://github.com/stympy/faker) by @stympy.
