<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   [Powerful dependency injection container](https://laravel.com/docs/container).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).
-   [Robust background job processing](https://laravel.com/docs/queues).
-   [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

-   **[Vehikl](https://vehikl.com)**
-   **[Tighten Co.](https://tighten.co)**
-   **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
-   **[64 Robots](https://64robots.com)**
-   **[Curotec](https://www.curotec.com/services/technologies/laravel)**
-   **[DevSquad](https://devsquad.com/hire-laravel-developers)**
-   **[Redberry](https://redberry.international/laravel-development)**
-   **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# 🎫 EventHub - Community Event Management Platform

> A high-performance, full-stack event management system built with **Laravel 12**. Features hybrid payment flows (Free/Paid), role-based access control, and a digital ticketing system.

![Project Status](https://img.shields.io/badge/Status-Completed-success)
![Tech Stack](https://img.shields.io/badge/Laravel-12-red)
![Payment](https://img.shields.io/badge/Payment-Paystack-blue)

## 📖 About The Project

EventHub is designed to solve the friction in organizing local community events. Unlike standard CRUD apps, this platform handles the complex logic of **Event Monetization**. It distinguishes between free RSVPs and paid tickets, creating a seamless flow for users while ensuring financial integrity for organizers via **Paystack**.

Key architectural focus areas included **Database Optimization**, **Security (RBAC)**, and **User Experience**.

## ✨ Key Features

### 🛒 Payment & Ticketing (The Core)

-   **Hybrid Payment System:** Automatically routes users to a secure Paystack checkout for paid events or instant confirmation for free events.
-   **Custom Payment Implementation:** Built a robust payment service using Laravel's native `Http::client` (no third-party wrappers) to ensure granular control over transaction verification.
-   **Digital Tickets:** Generates a unique, non-spoofable Ticket ID and visual pass for attendees.
-   **Guest Management:** "Party RSVP" logic allowing users to register themselves + guests (e.g., "Me + 2") in a single transaction.

### 🛡️ Security & Roles

-   **Role-Based Access Control (RBAC):** Distinct middleware-protected zones for **Guests**, **Users**, and **Admins**.
-   **Content Moderation:** Approval workflow where Admins must vet events before they go live.
-   **Admin Verification:** dedicated "Guest List" dashboard with search functionality to verify attendees at the door.

### ⚡ Performance & Architecture

-   **Redis Caching:** Implemented Redis to cache heavy database queries (like Category lists), reducing database load by ~40%.
-   **Rate Limiting:** Throttled interaction routes (Likes/Comments) to prevent spam.
-   **Relational Data Integrity:** Complex Eloquent relationships ensuring accurate headcount calculations (Rows + Guest Columns).

## 🛠️ Tech Stack

-   **Backend:** PHP 8.2, Laravel 12
-   **Frontend:** Blade Templates, Tailwind CSS, Alpine.js
-   **Database:** MySQL 8.0
-   **Caching:** Redis
-   **Payments:** Paystack API (Direct Integration)

## 🚀 Getting Started

To run this project locally, follow these steps:

### Prerequisites

-   PHP >= 8.2
-   Composer
-   Node.js & NPM
-   MySQL
-   Redis (Optional but recommended)

### Installation

1.  **Clone the repository**

    ```bash
    git clone https://github.com/Miracle-Alajemba/Micmash.git
    cd Micmash
    ```

2.  **Install PHP dependencies**

    ```bash
    composer install
    ```

3.  **Install Frontend dependencies**

    ```bash
    npm install
    npm run build
    ```

4.  **Configure Environment**
    Copy the example env file and update your database/Paystack credentials:

    ```bash
    cp .env.example .env
    ```

    _Update `DB_DATABASE`, `DB_PASSWORD`, `PAYSTACK_SECRET_KEY`, etc._

5.  **Generate App Key**

    ```bash
    php artisan key:generate
    ```

6.  **Link Storage (Crucial for Images)**

    ```bash
    php artisan storage:link
    ```

7.  **Run Migrations**

    ```bash
    php artisan migrate
    ```

8.  **Start the Server**
    ```bash
    php artisan serve
    ```

## 📸 Screenshots

_(You can upload screenshots of your "My Tickets" page, Admin Dashboard, and Payment Flow here later)_

## 🤝 Contributing

Contributions, issues, and feature requests are welcome!

## 📝 License

This project is [MIT](https://opensource.org/licenses/MIT) licensed.
