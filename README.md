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

Note: For Docker container, proceed to step 4 and follow Option B: Docker.

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

The application uses the following default credentials:

- Database: whitehat
- User: hatter
- Password: whitehat

These defaults are defined in `db.php`, and are used if no environmental variables are set.

The configuration also supports environment variables:

- DB_HOST
- DB_USER
- DB_PASSWORD
- DB_NAME

---

### 4. Run the application


#### Option A: PHP built-in server (in the app directory)

```
php -S localhost:8000
```

Then open:

```
http://localhost:8000
```

#### Option B: Docker

Run the application using docker:

```
docker compose up --build
```

Then open:
http://localhost:8080

This starts both the web application and the database.

Note: On Fedora/Podman systems, volume mounting may require SELinux relabeling (`:Z`), which is already configured in `docker-compose.yml`.

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
saaryachin.com
