# Simple WordPress FAQ (Test Task)

This repository contains a WordPress test project with a fully prepared local environment.
The project includes WordPress core files, database initialization, Docker configuration,
a custom theme, and a custom FAQ shortcode plugin.

---

## Requirements

- Git
- Docker
- Docker Compose
- Node.js + npm
- Composer

---

## Local URLs

- **Website:** http://localhost:8000/
- **phpMyAdmin:** http://localhost:8081/

---

## Quick Start

Clone the repository and start the Docker environment:

```bash
git clone <repository-url>
docker compose up -d
```

After startup, WordPress will be available at:
http://localhost:8000/

---

## Wordpress ADMIN credentials
- **URL: http://localhost:8000/**
- **Login: admin**
- **Password: admin**

---

## Install Dependencies

### Plugin: FAQ List Shortcode
```bash
cd wp-content/plugins/faq-list-shortcode
composer install
npm install
```

### Theme: wptest
```bash
cd wp-content/themes/wptest
composer install
npm install
```

---

## Assets Compilation (Theme and Plugin)
### Production build
```bash
npm run build
```
### Development mode (watcher)
```bash
npm run dev
```
Run these commands inside both directories:
* wp-content/plugins/faq-list-shortcode
* wp-content/themes/wptest

 --- 

## Seed FAQ Custom Post Type and Pages
### Create demo FAQ posts using WP-CLI:
```bash
docker compose run --rm wpcli wptest seed-faq
```
#### This command creates several FAQ posts, including:

* Published posts
* Draft posts 

It works only for empty FAQ post type list

### Create Pages with Required Templates
```
docker compose run --rm wpcli wptest seed-pages
```

#### This command creates WordPress pages and assigns the required page templates automatically.

---

## FAQ Shortcode
### The plugin provides a shortcode for rendering FAQ items by ID:
```bash 
[faq_list ids="faqID_1, faqID_2, faqID_3"]
```
#### Shortcode behavior

* Accepts a comma-separated list of FAQ post IDs
* Displays only published FAQ posts
* Preserves the order of IDs as provided in the shortcode
* Draft or non-existing posts are ignored

---

## Project Structure
```bash
├── wp-content
│   ├── plugins
│   │   └── faq-list-shortcode
│   └── themes
│       └── wptest
├── docker-compose.yml
├── README.md
```
