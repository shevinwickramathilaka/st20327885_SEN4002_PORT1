# st20327885_SEN4002_PORT1

Explore LK — Quick Setup

Requirements:

PHP 8.0 or higher
MySQL / MariaDB 10.4 or higher
XAMPP, WAMP, or Laragon (or PHP built-in server)

Setup Steps:

Unzip the project into your web root (for example: htdocs/explore_lk).
Create a database named explore_lk.
Import the file explore_lk.sql using phpMyAdmin (Import tab) or MySQL CLI.
Edit your database config file (config.php or db.php):

host = localhost
db = explore_lk
user = root
pass = (leave empty if using XAMPP default)

Make sure the folder uploads/destinations/ exists for images.

Run the project:

If using XAMPP/WAMP: open http://localhost/explore_lk/
If using PHP’s built-in server: run php -S localhost:8000 and open http://localhost:8000

Demo Accounts:

User: john@example.com
 / john123

User: jane@example.com
 / jane123

Admin: admin (reset password if needed)

Database Overview:

Tables: admins, users, destinations, bookings, reviews

Views: vw_bookings_monthly, vw_bookings_status_counts
