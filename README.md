# TangCare (Tangerang Care)

![Build Status](https://img.shields.io/badge/build-passing-brightgreen)
![Laravel](https://img.shields.io/badge/Laravel-11-red)
![Livewire](https://img.shields.io/badge/Livewire-3-pink)
![License](https://img.shields.io/badge/license-MIT-blue)

**TangCare** is a hyperlocal donation management platform designed to solve last-mile logistics for charities in Tangerang. Unlike standard aggregators, TangCare facilitates direct P2P connections between Donors and verified Foundations (Yayasan), featuring real-time event mapping and donation impact tracking.

## 🏗 Architecture & Stack

* **Backend:** Laravel 11 (PHP 8.2+)
* **Frontend:** Livewire 3 (Server-side dynamic components)
* **Interactivity:** Alpine.js (Lightweight JS for dropdowns/modals)
* **Styling:** Tailwind CSS
* **Database:** MySQL 8.0
* **Maps:** Leaflet.js + OpenStreetMap (OSM)

## ⚡ Key Features

* **Role-Based Access Control (RBAC):**
    * `Guest`: Public map view, search events.
    * `Donor`: Donation submission, history tracking, impact stats (kg).
    * `Yayasan`: Event creation, donation approval workflow (Accept/Reject/Received).
    * `Admin`: User management, global dashboard.
* **Donation Workflow:** State machine implementation for donation lifecycle (`Pending` -> `Accepted` -> `Received`).
* **Geo-Location:** Interactive map clustering events and drop-off points using Leaflet (integrated via Livewire events).
* **Reporting:** Aggregated statistics for total weight donated across the region.

## 🛠 Installation

### Prerequisites
* PHP >= 8.2
* Composer
* Node.js & NPM
* MySQL (e.g., XAMPP’s MySQL) running

### Local Setup

1. **Clone the repo**
    ```bash
    git clone https://github.com/nicovalerian/tangcare.git
    cd tangcare

2. **Install Dependencies**

    ```bash
    composer install
    npm install
    ```

3. **Create the database (XAMPP/phpMyAdmin)**

    * In phpMyAdmin, create a database named `tangcare` (utf8mb4).
    * Ensure MySQL is running. Default XAMPP creds are typically `root` with an empty password.

4. **Environment Configuration**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

    Update `.env` database section (example for XAMPP):
    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=tangcare
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5. **Database & Migrations**

    ```bash
    php artisan migrate --seed
    ```

    *Seeds populate demo data including:*
    - 1 Admin account (admin@tangcare.com / password)
    - 3 Yayasans with verified Tangerang locations
    - 6 Events (mix of ongoing and time-limited)
    - 5 Donor accounts (donor1@example.com - donor5@example.com / password)
    - 10 Donations in various states (pending, accepted, rejected, received)

6. **Run Local Server**

    ```bash
    # Terminal 1 (Vite for Tailwind/Alpine)
    npm run dev

    # Terminal 2
    php artisan serve
    ```

Access the app at `http://localhost:8000`.

## 🗺 Roadmap / Todo

  - [ ] **Core:** User Auth (Breeze/Jetstream with Livewire)
  - [ ] **Core:** Yayasan CRUD & Verification logic
  - [ ] **Map:** Implement Leaflet markers for Events
  - [ ] **Donation:** Multi-step Livewire form (Details -\> Photo Upload -\> Delivery Method)
  - [ ] **Donation:** Status update notifications (Database driven + Livewire polling)
  - [ ] **Admin:** Dashboard charts for Total Kg Donated

## 🤝 Contributing

1.  Fork the Project
2.  Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3.  Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4.  Push to the Branch (`git push origin feature/AmazingFeature`)
5.  Open a Pull Request

## 📄 License

Distributed under the MIT License. See `LICENSE` for more information.