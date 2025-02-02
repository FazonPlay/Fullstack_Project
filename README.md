# 🎮 Memory Game

Welcome to my (mostly finished) project, **Memory Game!** 🃏
This is a simple yet fun game where you match pairs of cards.
The game is built using **PHP, HTML, and JavaScript**.

---

## 🚧 Current Issues
Although the project is mostly complete, a few issues remain:

1. **User Creation/Modification** - Data is saved, but changes aren't immediately visible. You'll need to refresh or check the user list manually.
2. **Unsorted User List** - Finding a specific user can be difficult since the list isn't sorted.
3. **You can delete yourself whilst an admin**
4. **After account creation, you have to manually go back to the login page**

---

## 🛠 Installation
To install the project, follow these steps:

### 1️⃣ Clone the Repository:
```sh
git clone https://github.com/FazonPlay/Fullstack_Project

cd Fullstack_Project
```


### 2️⃣ Install Dependencies:
Ensure **Composer** is installed, then navigate to the project directory and run:
```sh
composer require fakerphp/faker
```
This installs Faker, which generates fake user data.

You'll also need **Dotenv** for secure database connections:
```sh
composer require vlucas/phpdotenv
```

### 3️⃣ Setup Database Configuration:
There's a `env.dist.` file in the root directory. Copy it and rename it to `.env`. 
This file contains the database configuration settings:
```
DB_HOST=""
DB_USER=""
DB_PASSWORD=""
DB_NAME=""
```
Replace the values with your actual database credentials.

### 4️⃣ Create the Database:
Use **phpMyAdmin** or any database management tool to create a database with the name specified in your `.env` file.


### 5️⃣ Import the Database:
Import the `memory_game.sql` file from the `database` folder into your database.

### 6️⃣ Generate Database Tables & Test Data:
Run the `genUsers.php` script first, followed by `genTimes.php` in the command line to generate the necessary tables and sample data.

```sh
cd scripts
php genUsers.php
php genTimes.php
```
### ONLY RUN THIS AFTER IMPORTING THE DATABASE

---

## 🎮 Usage
Once installed, open `index.php` to access the **dashboard**, where you’ll find:

✅ **Top 10 Players**
✅ **Best Times**
✅ **Login Button**

### 🔑 Logging In
- Click **Login** to access the login page.
- Register or log in as an **Admin** for full access.

### 👤 Admin Features
- **Admin Panel**
- **Full CRUD User List** (Note, you cannot create a new admin)
- **Time List Management** (Delete only)
- Plus everything a normal user can do!

### 🎲 Normal User Features
- **Play the Game**
- **View Dashboard (Top 10 Players & Best Times)**
- **Logout**

---

## 🤝 Contributors
- **FazonPlay**
- **David**
- **RoshiBlack**

---

## 📜 License
📝 Open-source license (TBD)

---
✨ *Thank you for checking out my project!* ✨

