# LocalStore - E-Commerce Platform

**Course:** Web Programming (CoSc3091)  
**Assignment:** Individual Assignment I - Full Website Development Project  
**Author:** Biruk Mola  
**Student ID:** 020/16/ID  
**Department:** Computer Science  

---

## 📝 Project Overview & Purpose
**LocalStore** is a dynamic web-based e-commerce platform designed to promote and sell authentic Ethiopian artisanal products, coffee, fashion, and handcrafted accessories. Inspired by modern digital retail strategies and the passion for e-commerce (such as the Lee Dropshipping model), this project bridges local artisans with broader markets while satisfying all requirements for the CoSc3091 Web Programming course.

---

## ✨ Key Features
1. **User Authentication System:**
   - Secure Registration with client-side (JS) and server-side (PHP) validation.
   - Password hashing using PHP's native `password_hash()`.
   - Login, Session handling, and Logout capabilities.

2. **Dynamic Product Catalog & Filtering:**
   - Full product listing fetched directly from the MySQL database.
   - Dynamic Category Filtering (All, Clothing, Food & Beverage, Accessories, Household) using query parameters.
   - Modern, responsive Capsule Button UI with visual state feedback.

3. **Product Details & Interaction:**
   - Dedicated product detail pages dynamically fetching item descriptions, prices, and categories via GET request IDs.

4. **Contact & Message Center:**
   - Functional contact form validating client input and persisting customer feedback/inquiries.

5. **Responsive & Modern Design:**
   - Custom CSS layout using Flexbox and Grid, fully styled across desktop and mobile screens.

---

## 🛠️ Technology Stack
* **Front-End:** HTML5 (Semantic Structure), CSS3 (Flexbox/Grid, Custom Components), JavaScript (Client-side validation & DOM manipulation)
* **Back-End:** PHP 8.x (Session management, PDO/MySQLi prepared statements, routing)
* **Database:** MySQL / MariaDB (Relational Database)
* **Environment:** XAMPP / WAMP / LAMP Stack

---

## ⚙️ Local Setup Instructions (XAMPP)

Follow these steps to set up and run the project locally on your machine:

1. **Clone or Download the Project:**
   - Place the project folder into your XAMPP `htdocs` directory:
     ```text
     C:\xampp\htdocs\localstore\
     ```

2. **Start XAMPP Control Panel:**
   - Launch XAMPP and start both **Apache** and **MySQL** modules.

3. **Import Database:**
   - Open your browser and go to `http://localhost/phpmyadmin/`
   - Create a new database named: `localstore_db` (or as configured in `db.php`).
   - Click on the newly created database, go to the **Import** tab.
   - Select the `database.sql` file provided inside the root directory and click **Go**.

4. **Launch the Application:**
   - Open your browser and visit:
     ```text
     http://localhost/localstore/index.php
     ```

---

## 🔑 Test Credentials for Evaluation

The instructor or evaluator can test the application using the following default account or by registering a new user:

* **Role:** General User
* **Username / Email:** `testuser` / `testuser@gmail.com`
* **Password:** `123456`

*(Note: Passwords are encrypted using `PASSWORD_DEFAULT` in the database).*

---

## 📂 Project Structure
```text
localstore/
│
├── css/
│   └── style.css          # Core CSS stylesheet
├── js/
│   └── script.js         # Client-side form validation script
├── images/               # Product showcase images
├── db.php                # PDO database connection setup
├── header.php            # Shared navbar & header layout
├── footer.php            # Shared footer layout with developer credit
├── index.php             # Landing home page
├── products.php           # Product listing with dynamic filter
├── product_details.php   # Detailed product view
├── about.php              # Developer background & system purpose
├── contact.php            # Contact form page
├── login.php              # User login authentication
├── register.php           # User account registration
├── logout.php             # Session destruction & redirect
├── database.sql           # Exported MySQL database schema & sample data
└── README.md              # Project documentation