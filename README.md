# Student Enrollment System

A web-based user management and student enrollment system, built for **CMSC 4003: Database and Applications** at the University of Central Oklahoma (Fall 2019).

Students log in to view and update their own information. Administrators log in to create, update, and delete users. Users with both roles get a combined view. Sessions are tracked in the database.

> Built by hand in 2019, before AI coding tools. Left as originally written, apart from removing the school database credentials.

## Team

- **Terry Phillips** ([@Blackkingsman](https://github.com/Blackkingsman))
- **Robby Walters** ([@UtsavWalters](https://github.com/UtsavWalters))
- [@TheJob21](https://github.com/TheJob21)

The original repo, with full commit history, is [UtsavWalters/database-project](https://github.com/UtsavWalters/database-project) (private). This is a clean public copy.

## Tech

- PHP with the OCI8 extension
- Oracle Database (SQL schema in [`project1_schema.sql`](project1_schema.sql))
- Bootstrap 4

## Structure

```
static_pages/login.html     login form
php_pages/login_action.php  authenticates and starts a session
php_pages/adminpage.php     admin: list, create, update, delete users
php_pages/studentpage.php   student: view and update own info and password
php_pages/bothpage.php      users who are both student and admin
php_pages/utility_functions.php  Oracle connection and query helpers
```

## Running it

1. Create the tables and sample users with `project1_schema.sql` on an Oracle database.
2. Set `DB_USER`, `DB_PASS`, and `DB_CONN` in the web server's environment.
3. Serve the folder with PHP (OCI8 enabled) and open `static_pages/login.html`.

Sample logins from the schema: `john` / `doe` (student), `mary` / `jane` (admin), `peter` / `parker` (both).

## If I wrote it today

This was a 2019 class project, and some of it shows. Passwords are stored in plain text, and SQL is built by string concatenation instead of bind variables. Today I'd hash passwords and use parameterized queries.
