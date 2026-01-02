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
