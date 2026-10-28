# Arab Gadgets Store Ltd

A responsive, multi-page PHP 8 website for a fictional gadget shop. The project is designed as a hands-on learning exercise in reusable PHP includes, data-driven pages, form handling, and safe output.

## Features

- Shared site configuration, header, navigation, and footer
- Home, About, Services, Contact, and service-detail pages
- Services and team members stored in PHP arrays
- Reusable helper functions for HTML escaping, price formatting, and service cards
- Server-validated contact form with sticky values and field-level errors
- CSRF protection and Post/Redirect/Get after a successful submission
- Contact submissions stored as JSON Lines in `storage/messages.jsonl`
- Password-gated messages page that lists submissions newest-first
- Responsive styling for desktop and mobile

## Tech stack

- PHP 8 with strict types
- HTML5
- CSS3
- Apache and PHP through XAMPP
- JSON Lines for local contact-message storage

## Run with XAMPP

1. Install and open XAMPP Control Panel.
2. Start **Apache**.
3. Place this project in:

   ```text
   C:\xampp\htdocs\swd\04-php-site
   ```

4. Open the site:

   [http://localhost/swd/04-php-site/](http://localhost/swd/04-php-site/)

5. To view submitted contact messages, open:

   [http://localhost/swd/04-php-site/messages.php](http://localhost/swd/04-php-site/messages.php)

   The local-learning password is set in `includes/config.php` as `$messagesPassword` (default: `change-me-local-only`). Change it before using the page, even on a shared local machine.

The contact form creates `storage/` when needed and appends submissions to `storage/messages.jsonl`. The included `storage/.htaccess` denies direct web access to files in that folder when Apache allows `.htaccess` overrides.

## Project structure

```text
04-php-site/
├── about.php
├── contact.php
├── index.php
├── messages.php
├── service.php
├── services.php
├── README.md
├── assets/
│   └── css/
│       └── style.css
├── includes/
│   ├── config.php
│   ├── data.php
│   ├── footer.php
│   ├── functions.php
│   └── header.php
└── storage/
    ├── .htaccess
    └── messages.jsonl  (created when the first contact form is submitted)
```

## Learning-only messages password

The messages page is protected by a hard-coded password in `includes/config.php` to demonstrate a basic session-gated page. This is **not production-grade authentication**: the password is stored as plain text in a source file, has no password hashing or account management, and the simple login has no rate limiting. Anyone who can read the project files can discover the password, and a weak/shared password can be guessed. Use a proper authentication system, securely stored password hashes, HTTPS, and rate limiting before exposing private submissions beyond a local learning environment. Do not use real sensitive customer data with this demo.

## What I learned

- **PHP includes and reusable layouts:** [Write what you learned here.]
- **Arrays, loops, and data-driven pages:** [Write what you learned here.]
- **Validation, CSRF, and sessions:** [Write what you learned here.]
- **Escaping output and storing JSON Lines:** [Write what you learned here.]
- **One thing I want to improve next:** [Write your idea here.]
