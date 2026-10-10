# ExamConnect — Tailwind UI refresh

## What changed
- Reworked the shared Blade layout with a full-width responsive header, accessible mobile navigation, skip-to-content link, status announcements, and expanded footer.
- Added Tailwind CSS CDN configuration and shared Tailwind design tokens for typography, brand colors, and soft shadows.
- Added `public/css/tailwind-system.css` for responsive/accessibility utilities and a small compatibility layer for existing Blade components.
- Kept `public/css/modern.css` intact so existing screens and page-specific styles continue to work while individual legacy templates are migrated.
- Preserved the Laravel routes, controllers, models, migrations, seeders, and business logic.

## Run locally
1. Extract the project.
2. Configure `.env` and your database.
3. Run `composer install` if dependencies are not present.
4. Run `php artisan key:generate` only if you need a new local application key.
5. Run migrations/seeding as appropriate for your existing data.
6. Start with `php artisan serve`.

Tailwind CDN requires an internet connection in the browser. For production, migrate to a compiled Tailwind/Vite build before deployment.

## Important scope note
This refresh modernizes the shared shell and establishes Tailwind as the utility layer without deleting legacy selectors that current Blade views depend on. The legacy stylesheet is intentionally retained for compatibility; removing it safely requires migrating each page's custom selectors and inline CSS in a separate template-by-template pass.
