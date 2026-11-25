<div align="center">

# 🏥 Imunah - Online Vaccination Portal

**A Premium, Secure, and Modern Platform for Vaccination & COVID-19 Testing Bookings.**

[![Laravel Version](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql)](https://mysql.com)

</div>

---

## 📖 About The Project

**Imunah** is a comprehensive, enterprise-level portal designed to streamline the process of vaccination and COVID-19 testing. It bridges the gap between Patients, Hospitals, and Administrators by providing a seamless, highly responsive, and visually stunning interface. 

Built with a strong focus on **UI/UX**, the platform features smooth Anime.js animations, glassmorphism effects, and a fully responsive Dark/Light mode.

### 🚀 Key Features

*   **👨‍⚕️ Patient Portal:**
    *   Secure Registration & Login.
    *   Search nearby approved hospitals.
    *   Book appointments for COVID Tests and Vaccinations.
    *   Track appointment status (Pending, Approved, Completed).
    *   View test results and vaccination certificates.
*   **🏥 Hospital Portal:**
    *   Manage incoming patient appointment requests.
    *   Approve/Reject bookings and assign time slots.
    *   Update COVID-19 test results (Positive/Negative).
    *   Update vaccination status (Vaccine type, Dose, Date).
*   **🛡️ Admin Dashboard:**
    *   System-wide Analytics & Reports (Daily/Weekly/Monthly).
    *   Approve or Reject Hospital registration requests.
    *   Manage Vaccine inventory (Enable/Disable).
    *   Monitor all platform bookings and registered patients.

---

## 🛠️ Tech Stack

*   **Backend:** Laravel 12.x (PHP 8.2+)
*   **Database:** MySQL (`covid_booking`)
*   **Frontend:** Blade Templating, Custom CSS3 (Glassmorphism), JavaScript (Anime.js for advanced animations), FontAwesome Icons.
*   **Server Environment:** XAMPP / WAMP / Laragon

---

## ⚙️ Installation & Setup Guide

Follow these steps to run the project locally on your machine:

### 1. Clone the Repository
```bash
git clone <your-repository-url>
cd imunah
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Environment Configuration
Copy the `.env.example` file to `.env` and configure your database:
```bash
cp .env.example .env
```
Ensure your `.env` has the following settings:
```env
APP_NAME="Imunah Online Vaccination Portal"
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=imunah_booking
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Run Migrations & Seeders
Make sure your MySQL server is running (via WAMP/XAMPP), create a database named `imunah_booking`, and run:
```bash
php artisan migrate --seed
```

### 6. Start the Development Server
```bash
php artisan serve
```
The application will be accessible at `http://127.0.0.1:8000`.

---

## 🔐 Default Credentials

For testing and evaluation purposes, the following Admin account has been pre-seeded into the database:

**Admin Login:**
*   **Email:** `admin@covidsystem.com`
*   **Password:** `admin123`

*(Note: Hospital and Patient accounts can be created via their respective Registration pages on the landing website).*

---

## 🎨 UI/UX Highlights

*   **Floating Pill Navbar:** A modern, aesthetic navigation bar.
*   **Advanced Carousel:** Smooth, auto-playing image carousels on the landing page.
*   **Animations:** Powered by Anime.js for scroll reveals and stagger effects.
*   **Responsive Layouts:** Optimized for Mobile, Tablet, and Desktop displays.

---

## 📄 License

This project is developed for educational and portfolio purposes. All rights reserved.

<div align="center">
  <i>Designed for those who care. ❤️</i>
</div>
````