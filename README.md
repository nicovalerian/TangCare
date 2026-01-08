# 🧡 TangCare
> Connecting Tangerang's heart to those who need it most.

[![Build Status](https://img.shields.io/badge/build-passing-brightgreen?style=for-the-badge)](https://github.com/nicovalerian/tangcare)
[![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![Livewire](https://img.shields.io/badge/Livewire-3-FB70A9?style=for-the-badge&logo=livewire)](https://livewire.laravel.com)
[![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-3.4-38B2AC?style=for-the-badge&logo=tailwind-css)](https://tailwindcss.com)
[![License](https://img.shields.io/badge/license-MIT-blue?style=for-the-badge)](LICENSE)

**TangCare (Tangerang Care)** is a hyperlocal donation management platform designed to solve last-mile logistics for charities in Tangerang. Unlike standard aggregators, TangCare facilitates direct P2P connections between Donors and verified Foundations (Yayasan), featuring real-time event mapping and donation impact tracking.

<!-- Add Screenshots Here -->

### 🚀 The Mission
Donating shouldn't be a logistical nightmare. TangCare is a hyperlocal bridge built to solve the "last-mile" friction in charitable giving. We don't just list foundations; we connect the generous hearts of Tangerang directly to verified *Yayasans* through real-time mapping, transparent tracking, and impact-driven data. Because every kilogram of kindness counts.

### 🛠 The Engine Room (Tech Stack)
We've picked the modern TALL stack (and some friends) to keep things snappy and reliable.

| Category | Tech |
| :--- | :--- |
| **Backend** | ![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat-square&logo=php&logoColor=white) ![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=flat-square&logo=laravel) |
| **Frontend** | ![Livewire](https://img.shields.io/badge/Livewire-3-FB70A9?style=flat-square&logo=livewire) ![Alpine.js](https://img.shields.io/badge/Alpine.js-3-8BC0D0?style=flat-square&logo=alpine.js) |
| **Styling** | ![Tailwind](https://img.shields.io/badge/Tailwind_CSS-3.4-38B2AC?style=flat-square&logo=tailwind-css) |
| **Database** | ![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat-square&logo=mysql&logoColor=white) |
| **Geo** | ![Leaflet](https://img.shields.io/badge/Leaflet.js-1.9-199900?style=flat-square&logo=leaflet&logoColor=white) ![OpenStreetMap](https://img.shields.io/badge/OSM-Mapping-7EBC6F?style=flat-square&logo=openstreetmap&logoColor=white) |

### ✨ Why It's Cool
*   **Real-time Magic with Livewire:** Experience a SPA-like feel without leaving the comfort of Laravel. No page refreshes, just pure reactive goodness.
*   **Hyperlocal Map Exploration:** Find donation events in your neighborhood using our interactive **Leaflet.js** map. Visualizing impact has never been this intuitive.
*   **Smart Donation Lifecycle:** A robust state machine that tracks your gift from the moment you hit "Donate" to the final "Received" confirmation.
*   **RBAC (Role-Based Control):** Whether you're a curious Guest, a generous Donor, a hard-working Yayasan, or a Global Admin, the platform adapts to you.
*   **Impact Metrics:** Don't just give—know your worth! We track total weight (kg) donated to show the collective power of the Tangerang community.

---

### 📦 Getting Started

Ready to make a difference? Let's get your local environment up and running!

#### Prerequisites
*   **PHP** >= 8.2
*   **Composer** (The dependency wizard)
*   **Node.js & NPM** (For that sleek UI)
*   **MySQL** (To store the kindness)

#### Local Setup

1.  **Clone the Magic**
    ```bash
    git clone https://github.com/nicovalerian/tangcare.git
    cd tangcare
    ```

2.  **Gather the Ingredients**
    ```bash
    composer install
    npm install
    ```

3.  **Prepare the Vault (Database)**
    *   Open phpMyAdmin or your favorite DB tool.
    *   Create a database named `tangcare` (use `utf8mb4_unicode_ci`).
    *   Make sure MySQL is humming along in the background.

4.  **Set the Stage (Environment)**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    Pop into your `.env` and make sure the DB credentials match your setup (e.g., XAMPP users usually have `DB_USERNAME=root` and `DB_PASSWORD=`).

5.  **Ignite the Database**
    ```bash
    php artisan migrate --seed
    ```
    *This will populate the app with:*
    *   **Admin:** `admin@tangcare.com` / `password`
    *   **Verified Yayasans** with real Tangerang coordinates.
    *   **Demo Events & Donors** to play around with immediately.

6.  **Launch!**
    You'll need two terminal windows open:
    ```bash
    # Terminal 1: Watch the styles
    npm run dev

    # Terminal 2: Serve the app
    php artisan serve
    ```
    Visit [http://localhost:8000](http://localhost:8000) and say hello!

---

### 🛤 The Road Ahead (Roadmap)
We're on a journey to make Tangerang better, one commit at a time.

- [x] **Foundation:** User Auth via Breeze & Livewire.
- [x] **Identity:** Yayasan verification and management.
- [x] **Discovery:** Interactive Leaflet map markers for local events.
- [x] **Workflow:** Multi-step Livewire donation wizard (Uploads, delivery, and more).
- [x] **Feedback:** Real-time status updates and notifications.
- [x] **Analytics:** Sleek Admin dashboard for impact tracking (Total Kg).

---

### 🤝 Join the Movement
We love contributors! Whether you're fixing a bug, adding a feature, or just polishing the docs, your help is huge.

1.  **Fork** the project.
2.  **Create** your feature branch (`git checkout -b feature/AmazingFeature`).
3.  **Commit** your changes (`git commit -m 'Add some AmazingFeature'`).
4.  **Push** to the branch (`git push origin feature/AmazingFeature`).
5.  **Open** a Pull Request.

---

### 📄 License
Distributed under the MIT License. See `LICENSE` for more information.

---
*Made with ❤️ for Tangerang.*
