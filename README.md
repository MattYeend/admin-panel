# Admin Panel
An Admin Panel built with modern web technologies.

---

## Tech Stack
| Tech | Version |
|---|---|
| PHP | 8.4.6 |
| Laravel | 12.19.3 |
| Composer | 2.8.8 | 
| NPM | 10.9.2 | 
| Node | v23.11.0 |
| VueJS | 3.5.16 |
| MySQL | 8.0.42 |

--- 

## General Information
An admin panel built in Laravel 12, combbining different tools such as data management, ticket tracking, blog posts, and many more.

---

## How To Contribute
We welcome contributions! To contribute:

1. Fork the repository.
2. Create a new branch: `git checkout -b feature/your-feature-name`.
3. Make your changes and commit: `git commit -m 'Add your message here'`.
4. Run `php artisan insights` and make any relevant changes that it might suggest
5. Ensure there's relevant tests and that they work and pass.
6. If anything requires vue.js changes, run: `npm i && npm run build`
7. Push to your fork: `git push origin feature/your-feature-name`.
8. Create a Pull Request.

Please follow the code style and commit message conventions.

---

## How To Setup
Follow these steps to set up the project locally:

1. **Clone the repository**
   ```bash
   git clone https://github.com/MattYeend/admin-panel.git
   cd admin-panel
   ```
2. **Install PHP dependencies**
    ```bash
    composer install
    ```
3. **Install Node dependencies**
    ```bash
    npm install && npm run build
    ```
4. **Set up environment**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
5. **Configure your database in .env and run migrations:**
    ```bash
    php artisan migrate
    ```
6. **Seed all tables:**
    ```bash
    php artisan seed
    ```
7. **Set up storage**
    ```bash
    php artisan storage:link
    ```
8. **Run the development servers**
    ```bash
    php artisan serve
    npm run dev
    ```

---

## Sponser This Project
If you find this project useful, consider sponsoring it to support future development and maintenance.

[☕ Buy Me a Coffee](https://www.buymeacoffee.com/mattyeend)
[💸 GitHub Sponsors](https://github.com/sponsors/MattYeend)

---