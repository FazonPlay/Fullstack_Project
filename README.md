Hi, welcome to my (mostly finished) project, Memory Game! 
This is a simple game where you have to match pairs of cards.
The game is built with PHP, HTML, and JavaScript.

Now this project whilst mostly finished, is not perfect. There are a few *issues* that I would like to address before I consider it complete.
1. During the user creation/modification, the data whilst being saved, you won't know it until you go back and check the user list.
2. The user list is not sorted in any way, so it can be hard to find a specific user.
For now that's all but ill address these issues in the future.
## Installation
To install this project you'll first need to clone the repository.
git clone https://github.com/FazonPlay/Fullstack_Project

Before proceeding make sure you have Composer installed on your machine.

Once you have Composer installed, navigate to the project directory and run the following command:
composer require fakerphp/faker

This will install the Faker library which is used to generate fake data for the user list.

You'll also need another library to safely connect to the database, to install this library run the following command:
composer require vlucas/phpdotenv

This will install the Dotenv library which is used to safely connect to the database.
You'll also need to create a .env file in the root directory of the project and replace the values with your own.
Example:

DB_HOST=localhost
DB_USER=root
DB_PASS=password
DB_NAME=memory_game

Just replace the values with your own and you should be good to go.
Now you'll also need to create a database with the name you specified in the .env file.
You can do this by using phpmyadmin
Once that's done you can use the fixtures.php script in the command line to generate all of the necessary tables and data for testing.



## Usage

Once you open up index.php you'll be greeted with a login screen.
You can either login with an existing user or create a new one.
Since you used the script there should be an admin user with the following credentials:
Username: admin
Password: admin
When logged in as an admin you get access to:
- The user list (with full CRUD functionality)
- The time list (with delete functionality)
- An admin panel for easy navigation
- Everything a regular user has access to

When logged in as a regular user you get access to:
- The game itself
- dashboard with your stats (and top 10)

There are some security measures in place to prevent regular users from accessing the admin panel
Or other components they shouldn't have access to, same goes to non-logged in users.

Now when you try to create a new user, you'll be greeted with a form.
Like i stated before, the actual sql query is being executed,
but you won't know it until you go back and check the user list,





## Contributing

## License
[]: # (END)
