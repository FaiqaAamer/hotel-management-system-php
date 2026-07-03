# Grand Palace Hotel Management System

A full-stack hotel management system built with **PHP**, **MySQL**, and **Bootstrap**. It provides a customer-facing booking experience and an admin panel for managing rooms and reservations.

> Developed as a semester project.

---

## Features

### Customer
- Register and log in
- Browse available rooms with pricing and status
- Book a room (check-in/check-out dates, guests)
- View reservation history
- Cancel a confirmed reservation

### Admin
- Admin dashboard with quick stats (total rooms, available rooms, booked rooms, total reservations)
- View recent reservations
- Add, edit, and delete rooms
- View all confirmed reservations

## Tech Stack

- **Backend:** PHP (procedural, mysqli)
- **Database:** MySQL
- **Frontend:** HTML, CSS, Bootstrap 5
- **Icons:** Bootstrap Icons

---

## Project Structure

```
├── Admin Panel/
│   ├── Admin_Dashboard.php
│   └── Manage_room.php
├── Customer Panel/
│   ├── book.php
│   ├── cancel.php
│   ├── Customer_dashboard.php
│   ├── Reservations.php
│   └── Rooms.php
├── Assets/            # images (rooms, hotel, food, avatars)
├── CSS/
│   └── Customer.css
├── config.php         # database connection
├── db.php             # database connection
├── index.php          # landing page
├── login.php
├── logout.php
├── register.php
└── script.sql         # database schema + seed data
```

---

## Setup / Installation

1. **Clone the repo**
   ```bash
   git clone https://github.com/your-username/your-repo-name.git
   ```

2. **Move the project into your local server directory**
   (e.g. `htdocs` for XAMPP, `www` for WAMP)

3. **Create the database**
   - Open phpMyAdmin (or your MySQL client)
   - Create a database named `hotel_management-system`
   - Import `script.sql` to create tables and seed sample data

4. **Configure the database connection**
   Both `config.php` and `db.php` use these defaults, matching a typical local XAMPP/WAMP setup:
   ```php
   $host = "localhost";
   $user = "root";
   $password = "";
   $database = "hotel_management-system";
   ```
   Update these values if your local MySQL setup differs.

5. **Start your local server** (Apache + MySQL) and visit:
   ```
   http://localhost/your-project-folder/
   ```

---

## Sample Login Credentials

Seed data in `script.sql` includes sample admin and customer accounts. Check `script.sql` for the current dummy credentials, or register a new account via the sign-up page.

---

## Notes

- This is an academic/learning project — password handling and input sanitization are simplified and not production-hardened.
- Room images are placeholder stock photos used for demonstration purposes only.

---

## License

This project is for educational purposes.

---

## Author
**Faiqa Aamer** 

---

## Connect with me
- 🌐 GitHub: https://github.com/FaiqaAamer  
- 💼 LinkedIn: https://www.linkedin.com/in/faiqa-aamer-a84a083ab/