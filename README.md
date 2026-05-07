# Resume App

This repository is a multilingual Laravel resume and portfolio app with a public website and a small admin panel.

It is not a finished product yet. Some content is managed from the database, but a lot of personal/profile data is still hardcoded in Blade templates, translation files, JavaScript, and public assets. The goal of this README is to make that split obvious so the next person can maintain the project without guessing.

## Status

- Public pages exist for `tr`, `en`, and `de`.
- The admin panel can manage services, blog posts, portfolios, and contact messages.
- Reviews/comments are not implemented yet.
- The admin dashboard is mostly a placeholder.
- The project still contains Laravel/Breeze scaffold files that are no longer wired to real routes.
- The test suite is partially outdated for the current route structure.

For the detailed "where do I edit this?" map, see [docs/editing-guide.md](docs/editing-guide.md).

## What The App Does

Public website:

- Home page
- About page
- Portfolio listing and portfolio detail pages
- Blog listing and blog detail pages
- Contact page with a contact form
- Language switcher for Turkish, English, and German
- SEO tags and sitemap

Admin area:

- Login at `/admin/login`
- Service CRUD
- Blog CRUD
- Portfolio CRUD
- Message inbox
- Basic account settings

## Tech Stack

- PHP 8.2+
- Laravel 12
- MySQL by default
- Vite for CSS builds
- Laravel Breeze for auth scaffolding
- Spatie Permission
- Spatie Sitemap
- PHP Flasher / Notyf
- TinyMCE in admin forms
- Theme/vendor frontend assets loaded from `public/assets`

## Content Sources

This app uses more than one source of truth.

| Area | Source | Notes |
| --- | --- | --- |
| Services | Database via admin panel | Localized records |
| Blog posts | Database via admin panel | Localized records, shared image per language group |
| Portfolios | Database via admin panel | Localized records, shared gallery per language group |
| Contact messages | Database via public form | Read in admin panel |
| Home hero text | Translation files | `lang/{locale}/main.php` |
| About page text | Translation files and Blade | `lang/{locale}/about.php` plus `resources/views/about.blade.php` |
| Resume sidebar | Blade, env, JavaScript, public assets | Photo, age, skills, CV links are not database-driven |
| Contact card details | Blade | Phone, email, social profile links are hardcoded in the page |
| Shared SEO/schema | Blade, config, env, controller | Domain and analytics are partly hardcoded |
| Images, PDFs, theme assets | `public/assets` | Manual file replacement |

## Project Structure

| Path | Purpose |
| --- | --- |
| `app/Http/Controllers` | Frontend, contact, admin, auth, sitemap controllers |
| `app/Http/Middleware` | Public locale switching and admin locale switching |
| `app/Models` | Eloquent models |
| `database/migrations` | Table structure |
| `database/seeders` | Admin user and role seeders |
| `resources/views` | Blade templates for public and admin UIs |
| `lang/tr`, `lang/en`, `lang/de` | Localized UI and page copy |
| `resources/css` | CSS source imported by Vite |
| `public/assets` | Live frontend JS, images, PDFs, admin assets, plugins |
| `routes/web.php` | Public, admin, sitemap, and contact routes |
| `tests` | Mostly Laravel scaffold tests; some no longer match the app |
| `docs/editing-guide.md` | Detailed maintenance and edit map |

## Localization Model

The app uses three locales:

- Turkish: default locale, no prefix
- English: `/en/...`
- German: `/de/...`

For database content:

- Services, blog posts, and portfolios are created as language groups.
- Each group shares a `parent_id`.
- The Turkish record acts as the base record and is the one shown in admin index screens.
- Public pages load the current locale only.

Important consequence:

- If you create or maintain database content outside the admin panel, keep the `tr`, `en`, and `de` records aligned by `parent_id`.

## Setup

### 1. Requirements

- PHP 8.2 or newer
- Composer
- Node.js and npm
- MySQL or another Laravel-supported database

### 2. Install dependencies

```bash
composer install
npm install
```

### 3. Create your environment file

```bash
cp .env.example .env
php artisan key:generate
```

Update at least these values in `.env`:

- `APP_NAME`
- `APP_URL`
- `APP_RESUME_FULL_NAME`
- `APP_LINKEDIN`
- `APP_GITHUB`
- `APP_X`
- `APP_FACEBOOK`
- `APP_INSTAGRAM`
- `DB_*`

### 4. Prepare the database

Create your database, then run:

```bash
php artisan migrate --seed
php artisan storage:link
```

The seeders create an admin role and a default admin user.

### 5. Build assets

```bash
npm run build
```

For local development you can also run:

```bash
npm run dev
```

### 6. Start the app

```bash
php artisan serve
```

Or run the combined dev command from Composer:

```bash
composer run dev
```

## Default Admin Login

After `php artisan migrate --seed`:

- URL: `/admin/login`
- Email: `yonetici@huseyinemeci.com`
- Password: `password`

Change the password immediately in a real environment.

## Common Edit Tasks

Use this as a quick map:

| If you want to change... | Start here |
| --- | --- |
| Full name used across the site | `.env` -> `APP_RESUME_FULL_NAME` |
| Sidebar social icons | `.env` social links |
| Home hero text | `lang/tr/main.php`, `lang/en/main.php`, `lang/de/main.php` |
| About page biography text | `lang/*/about.php` |
| About page dates, school names, company names | `resources/views/about.blade.php` |
| Sidebar photo | `public/assets/images/huseyin-emeci.jpg` |
| Sidebar age / skills list / CV button logic | `resources/views/layouts/left-sidebar.blade.php` |
| Skill percentages and language button behavior | `public/assets/js/main.js` |
| Home counters | `resources/views/layouts/achievements.blade.php` |
| Contact phone/email/manual social links | `resources/views/contact.blade.php` |
| Footer logos and copyright year | `resources/views/layouts/footer.blade.php` |
| Resume PDF files | `public/assets/documents/` |
| Blog content | Admin panel -> Blog |
| Portfolio content | Admin panel -> Portfolio |
| Services | Admin panel -> Services |
| Shared SEO domain / analytics / schema | `resources/views/layouts/master.blade.php` |
| Sitemap behavior | `app/Http/Controllers/SitemapController.php` |

Again, the full breakdown lives in [docs/editing-guide.md](docs/editing-guide.md).

## Asset Pipeline Notes

This project has an important quirk:

- Vite is used for CSS.
- The public website JavaScript is loaded directly from `public/assets/js`.
- `resources/js/main.js` exists, but the public site currently loads `public/assets/js/main.js`.

That means:

- CSS edits should usually happen in `resources/css/...` and then be rebuilt.
- Frontend JavaScript edits that must affect the live site should be made in `public/assets/js/main.js`.

## Known Gaps And Risks

- Reviews/comments are not implemented, even though there is a route, migration, model, and admin menu entry.
- The admin dashboard is mostly empty.
- Admin notification/search UI still contains template placeholder content.
- Contact information is split between `.env`, sidebar Blade, and `contact.blade.php`, so values can drift.
- Portfolio image editing is not finished. The edit form itself says add/remove/reorder is not implemented yet.
- Spatie Permission is installed, but the current admin gate is effectively just `role:admin`.
- Structured data and some SEO/domain values are hardcoded to `https://huseyinemeci.com`.
- Google Analytics is hardcoded in `resources/views/layouts/master.blade.php`.
- `sort` columns exist in multiple tables but are not actively used in the current queries/UI.
- `position` exists on `users`, but there is no working admin UI to manage it.
- The project includes a no-captcha package and recaptcha env keys, but the contact form currently uses a honeypot, a minimum fill-time check, and rate limiting instead.
- Some create forms expose a status toggle, but new records currently default to active because `status` is not mass-assignable on the related models.

## Test Status

As of 2026-05-07, `php artisan test` reports:

- 7 passing tests
- 18 failing tests

The failures are expected from the current codebase state because many tests still target old Laravel/Breeze routes and views such as:

- `/login`
- `/register`
- `/profile`
- email verification routes
- password reset routes
- `layouts.guest`
- `dashboard` route redirects

So right now, the test suite should be treated as scaffold residue, not as reliable project coverage.

## Related Files Worth Knowing

- `routes/web.php`
- `app/Http/Controllers/FrontendController.php`
- `app/Http/Controllers/ContactController.php`
- `app/Http/Controllers/SitemapController.php`
- `resources/views/layouts/master.blade.php`
- `resources/views/layouts/left-sidebar.blade.php`
- `resources/views/contact.blade.php`
- `public/assets/js/main.js`
- `docs/editing-guide.md`

## Next Recommended Cleanup Steps

If this project is going to keep evolving, these are the most useful next steps:

1. Move hardcoded personal data into a single settings source.
2. Finish or remove the reviews/comments module.
3. Decide whether frontend JS should live in Vite or remain in `public/assets/js`, then remove the duplicate source.
4. Replace hardcoded domain/analytics values with config or env values.
5. Rewrite or remove the outdated Breeze tests so the suite reflects the real app.
