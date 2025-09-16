# Bibliotech: PHP OOP Library Management System

A simple library management system built with **PHP 8+** using **Object-Oriented Programming (OOP)**.  
This project stores data in PHP `$_SESSION`.

## Features
- Manage books: add, edit, delete
- Search by title, author, or category
- Borrow and return books with user tracking
- Loan history table with start/end dates and status

## Project Structure
```
bibliotech-php-oop-session/
├── public/                 # Front controller and assets
├── src/
│   ├── Core/               # Router, SessionStore
│   ├── Domain/             # Entities + Repository interfaces
│   ├── Infrastructure/     # Session-based repositories
│   ├── Application/        # Services (business logic)
│   └── Presentation/       # Controllers + Views (Tailwind UI)
├── composer.json
└── README.md
```

## Getting Started
### Requirements
- PHP 8.1+
- Composer

### Installation
```bash
composer dump-autoload
php -S localhost:9050 -t public
```
Then open [http://localhost:9050](http://localhost:9050) in your browser.

---
