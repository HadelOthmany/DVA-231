# DVA231 – Web Development Assignments

This repository contains three assignments completed for the course **DVA231** at Mälardalen University.

The assignments build upon each other and gradually develop a news website from a static frontend into a dynamic web application with server-side programming, authentication, database storage, and AJAX-based search.

---

## Assignment 1 – HTML, CSS and JavaScript

The first assignment focuses on the fundamentals of frontend web development.

The goal was to recreate a provided webpage layout using only HTML and CSS, without external frontend libraries.

### Main Features

- Website layout created using HTML and CSS
- Navigation menu
- Search bar
- Logo
- News sections
- Event section
- Images and video
- Playable video
- External feed section
- Responsive positioning of page elements

JavaScript was then added to provide interactive functionality.

### JavaScript Functionality

- Automatically changing news headline every 5 seconds
- Multiple news items
- Hover effects that reveal additional information
- Dynamic page elements

### Technologies

- HTML
- CSS
- JavaScript
---

## Assignment 2 – Server-Side Programming

The second assignment extends the website from Assignment 1 by introducing server-side programming.

Instead of storing the website content directly inside the HTML page, news information is stored externally and loaded dynamically by the server.

### News Data

News items contain information such as:

- Title
- Image
- Content

The news data can be stored using formats such as:

- JSON
- XML
- Custom text format

The server reads the file and dynamically displays the content on the website.

### Admin Page

An administration page was added to allow new news content to be uploaded.

The administrator can:

- Open the Admin page
- Select a new news file
- Upload the file
- Apply the new content
- Return to the main page
- View the updated news

### Authentication

A simple login system was also introduced.

The user enters:

- Username
- Password

Sessions are used to remember whether the administrator is logged in.

If a user tries to access the Admin page without being authenticated, they are redirected to the login page.

### Technologies

- HTML
- CSS
- JavaScript
- Server-side programming
- Sessions
- JSON / XML / Text files

## Assignment 3 – Databases and AJAX

The third assignment continues the development of the website by introducing database storage and AJAX.

The website no longer depends on text files for displaying news.

Instead, users and news information are stored in a database.

### Database

A database was created containing tables for:

#### Users

Stores login information such as:

- Username
- Password

The login system now validates the entered credentials against the database.

#### News

Stores information such as:

- News title
- News content
- Image

Existing news files are imported into the database.

The main page retrieves its news directly from the database.

### Admin Functionality

The Admin page continues to support uploading news files.

Instead of displaying the uploaded file directly, its contents are stored in the database.

The website then retrieves the latest news records from the database.

### AJAX Search

The website search functionality was improved using AJAX.

When the user starts typing in the search field:

1. The browser sends the search text to the server using AJAX.
2. The server searches the news database.
3. Up to five matching news headlines are returned.
4. The results are displayed underneath the search box.
5. Each result can be clicked to open the corresponding news article.

This allows search results to appear without reloading the entire page.

### Technologies

- HTML
- CSS
- JavaScript
- Server-side programming
- SQL / Database
- AJAX
- JSON / XML
- Sessions
---

## Project Development

The three assignments demonstrate the gradual development of the application:

```text
Assignment 1
HTML + CSS + JavaScript
        ↓
Static News Website
        ↓
Assignment 2
Server-Side Programming
        ↓
File-Based Dynamic Content
        ↓
Login + Admin Page + Sessions
        ↓
Assignment 3
Database Integration
        ↓
Database Authentication
        ↓
Database-Based News
        ↓
AJAX Search
