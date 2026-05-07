# Editing Guide

This document explains where each part of the app lives today.

The main thing to understand is that this project is mixed:

- Some content is database-driven through the admin panel.
- Some content is hardcoded in Blade templates.
- Some content is stored in translation files.
- Some content comes from `.env`.
- Some visible values are controlled by JavaScript in `public/assets/js/main.js`.
- Some content is just manual files inside `public/assets`.

If you change only one of those places, the app can easily become inconsistent.

## Source Of Truth Rules

Use these rules before editing anything:

| Content type | Main source |
| --- | --- |
| Services | Database |
| Blog posts | Database |
| Portfolios | Database |
| Contact form submissions | Database |
| Home page marketing copy | Translation files |
| About page biography copy | Translation files |
| About page dates and timeline labels | Blade template |
| Sidebar identity block | Blade + `.env` + JS + public assets |
| Contact profile links and phone/email | Blade |
| Shared SEO/schema/analytics | Blade + config + controller |
| CSS | `resources/css/*` |
| Live frontend JS | `public/assets/js/main.js` |
| Images, PDFs, favicons | `public/assets/...` |

## Global Settings

### Full name

Edit:

- `.env` -> `APP_RESUME_FULL_NAME`
- `config/app.php` reads this value as `config('app.full_name')`

Used in many places:

- public header/sidebar
- page titles
- meta tags
- schema markup
- footer
- blog/portfolio author labels

### Sidebar social icons

Edit:

- `.env`
- `.env.example`

Keys:

- `APP_LINKEDIN`
- `APP_GITHUB`
- `APP_X`
- `APP_FACEBOOK`
- `APP_INSTAGRAM`

Used in:

- `resources/views/layouts/left-sidebar.blade.php`
- `resources/views/layouts/master.blade.php` JSON-LD schema

Important:

- The contact page uses its own hardcoded links in `resources/views/contact.blade.php`.
- If you change only `.env`, the contact page cards will still show the old manual URLs.

### Domain, schema, and analytics

Main files:

- `resources/views/layouts/master.blade.php`
- `resources/views/home.blade.php`
- `resources/views/about.blade.php`
- `resources/views/contact.blade.php`
- `resources/views/blog.blade.php`
- `resources/views/post-view.blade.php`
- `resources/views/portfolios.blade.php`
- `resources/views/portfolio-view.blade.php`
- `app/Http/Controllers/SitemapController.php`

Current state:

- Several schema IDs and URLs are hardcoded to `https://huseyinemeci.com`
- Google Analytics is hardcoded with measurement ID `G-EH3K01747B`
- Some pages use `huseyin-emeci.jpg` as the shared OG/Twitter image

If you rebrand or deploy to a new domain, review all of the files above together.

## Public Website

## Home Page

Route:

- `tr`: `/`
- `en`: `/en`
- `de`: `/de`

Code path:

- Route in `routes/web.php`
- Controller: `app/Http/Controllers/FrontendController.php` -> `index()`
- View: `resources/views/home.blade.php`

What comes from the database:

- Services shown under "My Services"

What is hardcoded or file-based:

- Hero copy in `lang/{locale}/main.php`
- Rotating hero text in `lang/{locale}/main.php`
- Background image in `public/assets/images/background.webp`
- Shared profile/share image in `public/assets/images/huseyin-emeci.jpg`
- Counter values in `resources/views/layouts/achievements.blade.php`

If you want to change:

- Hero headline/subheadline: `lang/tr/main.php`, `lang/en/main.php`, `lang/de/main.php`
- Counters: `resources/views/layouts/achievements.blade.php`
- CTA button target: `resources/views/home.blade.php`
- Background image: replace `public/assets/images/background.webp`

## Sidebar / Resume Card

Main file:

- `resources/views/layouts/left-sidebar.blade.php`

This is one of the most hardcoded areas in the app.

Edit here for:

- Profile image path
- Residence
- City
- Age
- Skill labels
- Knowledge list
- Resume download button logic

Related files:

- `public/assets/images/huseyin-emeci.jpg`
- `public/assets/documents/sample-cv-tr.pdf`
- `public/assets/documents/sample-cv-en.pdf`
- `public/assets/js/main.js`
- `lang/{locale}/main.php`

Important details:

- Age is hardcoded directly in Blade.
- Circle and line skill percentages are hardcoded in `public/assets/js/main.js`.
- The CV button serves Turkish PDF for `tr`, and English PDF for all other languages.
- There is no separate German CV file right now.

Current skill percentages in live JS:

- Turkish: `100%`
- English: `90%`
- German: `20%`
- Frontend: `90%`
- Laravel: `95%`
- PHP: `75%`
- SEO: `65%`
- Server management: `85%`

If you change the sidebar labels but not the JS percentages, the UI may become misleading.

## About Page

Route:

- `tr`: `/hakkimda`
- `en`: `/en/about-me`
- `de`: `/de/uber-mich`

Code path:

- Controller: `FrontendController::about()`
- View: `resources/views/about.blade.php`
- Copy: `lang/tr/about.php`, `lang/en/about.php`, `lang/de/about.php`

Important split:

- Paragraph copy is mostly in translation files.
- Timeline structure, date ranges, and some institution names are hardcoded in Blade.

Edit translation files for:

- Intro paragraphs
- Education descriptions
- Work descriptions
- Page description text

Edit `resources/views/about.blade.php` for:

- Timeline order
- Date ranges
- School/company names that are not localized via translation keys
- Section layout

If you update work history or education, check both the translation files and the Blade template.

## Contact Page

Route:

- `tr`: `/iletisim`
- `en`: `/en/contact`
- `de`: `/de/kontakt`

Code path:

- Controller: `FrontendController::contact()`
- View: `resources/views/contact.blade.php`
- Form handler: `app/Http/Controllers/ContactController.php`

Hardcoded values in the page:

- Country
- City map link
- Email address
- Phone number
- WhatsApp number
- LinkedIn URL
- GitHub URL
- X URL
- Facebook URL
- Instagram URL

These do not come from the database.

Form behavior:

- Stores messages in the `messages` table
- Uses a honeypot field: `company_website`
- Uses a minimum fill time check: `started_at`
- Uses rate limiting from `AppServiceProvider`

Rate limits:

- 3 submissions per minute per IP
- 20 submissions per hour per IP

Important:

- The repo contains recaptcha env keys and the `anhskohbo/no-captcha` package.
- The current contact form does not actually use recaptcha.

## Blog

Route:

- Listing: `/blog`, `/en/blog`, `/de/blog`
- Detail: `/blog/{slug}`, `/en/blog/{slug}`, `/de/blog/{slug}`

Code path:

- Frontend controller methods: `blog()` and `viewpost()`
- Admin controller: `app/Http/Controllers/Admin/BlogController.php`
- Frontend views: `resources/views/blog.blade.php`, `resources/views/post-view.blade.php`
- Admin views: `resources/views/admin/modules/blog/*`

How it works:

- Admin create/edit forms require Turkish, English, and German content together.
- Three `posts` rows are created, linked by `parent_id`.
- The Turkish row acts as the base row and is what admin index pages list.
- Public listing filters by current locale and `status = 1`.

Fields per post:

- title
- description
- content
- keywords
- category
- image
- slug
- locale
- parent_id
- status

Current caveats:

- Slugs are regenerated from titles on update.
- The same cover image is shared across all three language rows.
- The model does not include `status` in `$fillable`, so the create form's status toggle does not behave as expected for new posts.
- `post-view.blade.php` contains a leftover debug script at the bottom that fetches and logs HTML from the live domain.

If you want to edit blog content:

- Preferred: use admin panel
- Code-level changes: use the files above

## Portfolio

Route:

- Listing: `/portfolyo`, `/en/portfolio`, `/de/portfolio`
- Detail: `/portfolyo/{slug}`, `/en/portfolio/{slug}`, `/de/portfolio/{slug}`

Code path:

- Frontend controller methods: `portfolio()` and `viewportfolio()`
- Admin controller: `app/Http/Controllers/Admin/PortfolioController.php`
- Frontend views: `resources/views/portfolios.blade.php`, `resources/views/portfolio-view.blade.php`
- Admin views: `resources/views/admin/modules/portfolio/*`

How it works:

- Admin create/edit forms require all three locales.
- Three `portfolios` rows are created, linked by `parent_id`.
- Gallery images are stored as a JSON array.
- Features are stored as localized JSON arrays.
- Category is shared across all locales.
- Stage is shared across all locales.

Fields per portfolio:

- title
- description
- content
- features
- images
- category
- stage
- github_link
- demo_link
- slug
- locale
- parent_id
- status

Current caveats:

- The edit screen explicitly says image add/remove/reorder is not implemented yet.
- The create screen has drag/drop preview UI, but the edit flow is incomplete.
- The model does not include `status` in `$fillable`, so the create form's status toggle does not behave as expected for new portfolios.
- Category filter labels on the listing page are partly hardcoded in Blade.

If you need to replace portfolio screenshots manually, the uploads live under:

- `storage/app/public/portfolio`

## Services

Route:

- Managed only in admin, displayed on the home page

Code path:

- Frontend: `FrontendController::index()`
- Admin controller: `app/Http/Controllers/Admin/ServiceController.php`
- Admin views: `resources/views/admin/modules/services/*`

How it works:

- Each service is created in Turkish, English, and German.
- Rows are linked by `parent_id`.
- The home page loads only active services for the current locale.

Current caveats:

- The model does not include `status` in `$fillable`, so the create form's status toggle does not behave as expected for new services.
- The `sort` field exists in the database but is not used in current queries or UI.

## Footer

Main file:

- `resources/views/layouts/footer.blade.php`

Hardcoded here:

- Logo/image strip
- Copyright year

Asset files:

- `public/assets/images/laravel-logo.png`
- `public/assets/images/javascript-logo.png`
- `public/assets/images/mysql-logo.png`
- `public/assets/images/git-logo.png`

If the tech stack or year changes, update this file manually.

## Admin Panel

## Login

Route:

- `/admin/login`

Files:

- `routes/auth.php`
- `app/Http/Controllers/Auth/AuthenticatedSessionController.php`
- `resources/views/auth/login.blade.php`

Current auth state:

- Public registration is disabled in routes
- Password reset routes are disabled
- Email verification routes are disabled
- Breeze auth files still exist in the codebase
- Spatie Permission is installed, but current route protection is effectively based on `role:admin`

That is why some default tests now fail.

## Dashboard

Files:

- `app/Http/Controllers/Admin/DashboardController.php`
- `resources/views/admin/dashboard.blade.php`

Current state:

- Placeholder only

## Settings

Files:

- `DashboardController`
- `resources/views/admin/settings.blade.php`

What works:

- Change avatar
- Delete avatar
- Change display name
- Change password
- Change admin locale

What does not have full support yet:

- Editing contact info
- Editing position/job title

Important note:

- `users.position` exists in the database and is shown in the admin header if set.
- There is no working UI in settings to edit `position`.

## Messages

Files:

- `app/Http/Controllers/Admin/MessageController.php`
- `resources/views/admin/modules/messages/index.blade.php`
- `resources/views/admin/modules/messages/view.blade.php`

Behavior:

- Messages come from the public contact form
- Opening a message marks it as seen
- Messages can be deleted

## Reviews / Comments

Files:

- Route resource: `comments`
- Controller: `app/Http/Controllers/Admin/CommentController.php`
- Migration: `database/migrations/2025_09_27_124844_create_reviews_table.php`
- Model: `app/Models/Review.php`
- Admin menu labels call this "Reviews"

Current state:

- Not implemented
- Controller methods are empty
- No working review CRUD exists

Treat this as scaffold/incomplete work.

## Admin Theme Leftovers

Files:

- `resources/views/admin/layouts/sidebar.blade.php`
- `resources/views/admin/layouts/header.blade.php`

Current state:

- Notification dropdown contains example content
- Search form is template placeholder
- Some links like "Profile" do not go to a working custom profile page

These are theme leftovers, not real app features.

## Database Notes

Main content tables:

| Table | Purpose |
| --- | --- |
| `users` | Admin users |
| `services` | Home page service cards |
| `posts` | Blog entries |
| `portfolios` | Portfolio entries |
| `messages` | Contact form inbox |
| `reviews` | Planned but not implemented |

Localization pattern:

- `services`, `posts`, and `portfolios` all use:
  - `locale`
  - `parent_id`
  - `status`
  - `sort`

Meaning:

- `parent_id` links the three language versions together
- `status` is meant to control visibility
- `sort` exists for manual ordering but is not wired up yet

## Assets And Build Pipeline

## CSS

Files:

- `resources/css/app.css`
- `resources/css/admin.css`

These import other CSS source files and are compiled by Vite.

If you change CSS in `resources/css/*`, rebuild with:

```bash
npm run build
```

## Frontend JavaScript

Live file:

- `public/assets/js/main.js`

Important:

- The public layout loads JavaScript from `public/assets/js/*` directly.
- `resources/js/main.js` exists but is not the current live source used by the site.
- `resources/js/app.js` is effectively unused in the current frontend.

`public/assets/js/main.js` currently controls:

- Swup navigation behavior
- Language switch button URLs
- Sidebar progress circles and bars
- Preloader/counter animations
- Portfolio filter behavior
- Fancybox/Swiper setup
- Rotating home page text effect

If you edit the wrong JS file, your changes may never appear on the site.

## Uploaded Files

Uploads are stored under:

- `storage/app/public/blog`
- `storage/app/public/portfolio`
- `storage/app/public/profile`

Make sure this exists in your environment:

```bash
php artisan storage:link
```

## Tests

Current state from `php artisan test` on 2026-05-07:

- 7 passed
- 18 failed

Why:

- Tests still assume old Breeze routes like `/login`, `/register`, `/profile`
- Some disabled auth flows are still covered by scaffold tests
- Some views expect `layouts.guest`, which is missing
- Some tests still expect a `dashboard` route redirect

Do not treat the current test suite as accurate application coverage.

## Suggested Refactor Targets

These are the best candidates for future cleanup:

1. Create a single database-backed settings model for resume/profile data.
2. Move hardcoded contact details out of `contact.blade.php`.
3. Move hardcoded schema/domain/analytics values into config/env.
4. Decide on one frontend asset source of truth and delete the duplicate one.
5. Implement or remove reviews/comments.
6. Replace scaffold tests with tests that match `/admin/login`, localized routes, and the current admin modules.
