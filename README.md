### Setup

* `git clone https://github.com/sujanbm/login_codeigniter.git`in your working directory
* `cd login_codeigniter`
* Create a database named `contact` in your mysql server
* Change the credentials of your database in `database.php` in the config folder to connect to mysql
* Add a table `users`in your database with `first_name` `last_name` `email` `password` `phone_number` `file` 
* Add a table `photos` in your database with `id` `contact_id` as a foreign with with users and `file_name`
* Run the application in your server
