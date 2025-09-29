# api-infrastructure


This is the unified backend for APIs platform, merging all core APIs  into a scalable and modular PHP structure.

---

## 🧱 Architecture Overview

The platform follows **PSR-4 Autoloading** and clean **OOP** principles to support scalability, modularity, and security.

```
givinggap-platform-api/
│
├── public/                       # Public web root (entry point)
│   └── index.php                 # Bootstrap entry point
│
├── src/                          # PSR-4-compliant codebase
│   ├── Config/                   # App + DB configuration
│   │   └── app.php
│   │
│   ├── Controllers/              # Request handling
│   │   └── SearchController.php
│   │
│   ├── Middleware/               # Auth, rate-limiting, etc.
│   │   └── AuthMiddleware.php
│   │
│   ├── Models/                   # DB logic
│   │   └── Search.php
│   │
│   ├── Routes/                   # Route definitions
│   │   └── search.php
│   │
│   ├── Services/                 # Business logic
│   │   └── SearchService.php
│   │
│   └── Utils/                    # Response, logger, etc.
│       ├── ResponseHandler.php
│       └── Logger.php
│
│
├── .env
├── composer.json
└── README.md
```

## 🧱 Architecture Breakdown

| Layer      | File                                      | Purpose                                      |
|------------|-------------------------------------------|----------------------------------------------|
| **Route**      | `Routes/search.php`                   | Defines what URL maps to what controller     |
| **Controller** | `Controllers/SearchController.php`    | Handles the request, extracts input          |
| **Service**    | `Services/SearchService.php`          | Handles business logic (what to do)          |
| **Model**      | `Models/Search.php`                   | Connects to the database                     |
| **Utils**      | `Utils/ResponseHandler.php`           | Reusable logic to send JSON responses        |
---

## 🧩 Features

- Modular API organization
- PSR-4 compliant autoloading via Composer
- Separation of concerns (routes, controllers, services, models)
- Standardized success/error response handling
- Secure token-based middleware (JWT-ready)
- PostgreSQL parameterized queries
- Ready for APISEC best practices
- Expandable for admin tools, rate limiting, docs

---

## 🔐 Authentication (Planned)

We'll integrate a token-based authentication system using JWT. Tokens will be validated through middleware and protect selected routes.

---

## 🚀 Getting Started

1. Clone the repository
2. Run `composer install`
3. Copy `.env.example` → `.env` and set your environment variables
4. Start the PHP server

---

## 📐 Standards

- PHP 8.1+
- PSR-1 / PSR-4 Autoloading
- PSR-12 Coding Style
- Follows SOLID principles for scalability

---

## 📋 Response Format

### ✅ Success (200)

```json
{
  "message": "Record 123 updated successfully",
  "id": "123"
}
```

❌ Error (400 / 404 / 500)

```json
{
  "message": "Invalid source: xyz"
}
```

## 🤝 Connect with LCube Studios

🌎 [Website](https://thesingularitybox.com/)

🧰  [Portfolio Website](https://dennyscedeno.xyz/)

✉️ [Contact Us](mailto:Contact@thesingularitybox.com)

📅 [Let's Meet](https://calendly.com/dennys9415/30min)


## 🤘 Follow Us

[LinkedIn](https://www.linkedin.com/in/dcedenor)

[Github](https://github.com/dennys9415)

## 💡 We transform ideas into projects