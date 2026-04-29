# HavenHub – Management & Guest Experience Platform

HavenHub is a beginner-friendly hotel management system built with **Core PHP**, **MySQL**, **Bootstrap**, **HTML**, **CSS**, and **JavaScript**. It follows an MVC-like structure and demonstrates secure coding practices such as prepared statements, session-based authentication, role checks, and password hashing.

## 1) Folder Structure

```text
HavenHub/
├── app/
│   ├── controllers/
│   ├── helpers/
│   ├── models/
│   └── views/
│       ├── auth/
│       ├── bookings/
│       ├── dashboard/
│       ├── errors/
│       ├── home/
│       ├── layouts/
│       └── rooms/
├── config/
├── database/
├── public/
│   ├── assets/
│   │   ├── css/
│   │   └── js/
│   ├── .htaccess
│   └── index.php
└── README.md
```

## 2) Modules Overview

### Authentication
- Registration and login system
- `password_hash()` used during registration
- `password_verify()` used during login
- Roles: **Guest**, **Staff**, **Admin**
- Session-based access control and logout

### Room Management
- Admin can add rooms, update rooms (by ID), and delete rooms
- Room fields: room number, type, category, price, status, image
- Status options: Available, Occupied, Maintenance

### Booking System
- Guests can search rooms by date
- Double-booking prevention using availability query
- Booking captures room, stay dates, guest count, and booking status

### Billing System
- Staff can add extra services like food, laundry, airport pickup
- Invoice automatically updates by combining room cost + services
- Printable invoice page included

### Dashboards
- **Guest Dashboard**: booking history and invoice access
- **Staff Dashboard**: booking list and service adding form
- **Admin Dashboard**: revenue summary, room status, recent bookings

### Error Handling
- 404 page
- 403 page
- Flash messages for success/error feedback

## 3) Database Tables

- `users`
- `rooms`
- `bookings`
- `services`
- `payments`

Relationships:
- One user can have many bookings
- One room can have many bookings
- One booking can have many services
- One booking has one payment record

## 4) Sample Login Accounts

All sample passwords are:

```text
password123
```

Accounts:
- Admin: `admin@havenhub.test`
- Staff: `staff@havenhub.test`
- Guest: `guest@havenhub.test`

## 5) How to Run in XAMPP

### Step 1: Copy project
- Extract the project folder
- Put the `HavenHub` folder inside:

```text
C:\xampp\htdocs\
```

So the final path becomes:

```text
C:\xampp\htdocs\HavenHub
```

### Step 2: Start Apache and MySQL
- Open **XAMPP Control Panel**
- Start **Apache**
- Start **MySQL**

### Step 3: Create the database
- Open **phpMyAdmin**
- Create a database named `havenhub` if it does not already exist
- Import the SQL file:

```text
HavenHub/database/havenhub.sql
```

### Step 4: Check DB config
Open:

```php
config/config.php
```

Default values are:

```php
DB_HOST = localhost
DB_NAME = havenhub
DB_USER = root
DB_PASS = ''
```

If your MySQL password is different, update `DB_PASS`.

### Step 5: Enable Apache rewrite module
Make sure Apache `mod_rewrite` is enabled in XAMPP. Usually it is already enabled.

### Step 6: Open in browser
Go to:

```text
http://localhost/HavenHub/public/
```

## 6) Security Practices Used

- Prepared statements via PDO
- Password hashing and verification
- Output escaping with `htmlspecialchars`
- Session-based authentication
- Basic role-based authorization checks
- Server-side validation + simple client-side validation

## 7) Beginner Notes

- This project is intentionally simple enough to study and extend
- In a real production app, guest registration should not allow self-creating admin/staff accounts
- File uploads can be added later instead of image URLs
- CSRF protection can be added as a next improvement
- More advanced reporting and payment gateway integration can also be added

## 8) Suggested Improvements

- Add profile management
- Add real image upload for rooms
- Add check-in/check-out workflow pages
- Add pagination and search filters
- Add CSRF tokens
- Add email notifications
- Add payment status tracking
