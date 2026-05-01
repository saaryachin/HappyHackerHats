# Happy Hacker Hats Ltd.

This simple PHP + MariaDB web application for managing and searching products was developed as part of a technical assessment. It implements a minimal product management interface with an emphasis on secure input handling and clean server-side logic.

## Features

- Adding products (name + price)
- Searching products by name (partial match)
- Full product list when no search query is provided

---

## Technical Overview

- Backend: PHP
- Database: MariaDB / MySQL

---

## Setup Instructions

### 1. Clone the repository

git clone <repo-url>  
cd White_Hat_App

---

### 2. Initialize the database

Start MariaDB and import the schema:

```
sudo mysql < schema.sql
```

Alternatively:

```
sudo mysql  
SOURCE /full/path/to/schema.sql;
```

---

### 3. Database configuration

The application expects the following credentials (defined in `db.php`):

- Database: whitehat
- User: hatter
- Password: whitehat

If needed, create the user:

CREATE USER 'hatter'@'localhost' IDENTIFIED BY 'whitehat';  
GRANT ALL PRIVILEGES ON whitehat.* TO 'hatter'@'localhost';  
FLUSH PRIVILEGES;

---

### 4. Run the application

Using PHP built-in server (in the app directory):

```
php -S localhost:8000
```

Then open:

```
http://localhost:8000
```

NOTE: Docker Container coming soon.
---

## Usage

- Use the search field to filter products by name
- Leaving the search field empty returns the full product list
- Use “Add Product” to insert new entries into the database

---

## Security Considerations

The implementation includes the following protections:

- Prepared statements (`mysqli_prepare`, `bind_param`) for all database queries  
    → prevents SQL injection
- Server-side validation:
    - Product name: required, length-limited
    - Price: required, numeric, non-negative
- Output escaping using `htmlspecialchars`  
    → prevents reflected/stored XSS
- Proper request handling:
    - POST used for data modification
    - GET used for search operations
- Redirect after POST (PRG pattern)  
    → avoids duplicate submissions on refresh

---

## Notes / Scope

- The application does not include full CRUD functionality to match the task scope (no update/delete)
- No external libraries or frameworks were used
- Minimal styling and UX.

---

## Author

Saar Yachin
