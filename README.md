# ExamConnect

ExamConnect is a Laravel 12 candidate-experience and exam-preparation community. Candidate submissions are clearly labelled as candidate-reported; they are not automatically official or independently verified.

## Included feature set

### Candidate experience and exam discovery
1. Registration and login with request throttling
2. Public candidate profiles and profile editing
3. Exam directory and category filtering
4. Exam search
5. Exam detail pages with published experience feed
6. Candidate experience create/edit/delete workflow
7. Draft/pending/published/rejected/correction statuses
8. Shift, stage, date, difficulty and subject-level metadata
9. Anonymous author display option
10. Memory-based question records attached to experiences
11. Experience revision history support
12. Candidate-reported transparency labels
13. Likes
14. Bookmarks and saved experiences
15. Threaded comments and replies
16. Public SEO metadata for exams
17. Official authority links in seeded exam directory

### Social and community
18. Follow/unfollow candidates
19. Followers and following lists
20. Direct-message inbox
21. Direct-message conversations
22. Community directory
23. Join/leave communities
24. Community message feed
25. Community chat polling endpoints
26. Report candidate experiences
27. Duplicate report submission guard
28. Moderator report queue
29. Moderator report resolution/dismissal with notes
30. User roles for admin/moderator/user

### Preparation tools
31. Personal study goals
32. Progress updates and completion state for goals
33. Due dates for study goals
34. Study session logging
35. Subject and topic tracking
36. Study duration totals for the current week
37. Recent study history
38. Exam watchlist (follow/unfollow exams)
39. Community polls
40. Polls with 2–5 answer options
41. One vote per user per poll
42. Poll results with percentages
43. Related-exam selection for polls
44. Responsive preparation workspace

### Platform administration and quality
45. Admin dashboard counts and moderation queue
46. Experience moderation decisions
47. User role/status management
48. User activation/deactivation
49. Content search/filter in admin posts
50. Site settings
51. Admin audit log writes for key moderation actions
52. Rate-limited experience/report/message actions
53. Foreign-key cleanup rules and unique constraints
54. Seeded exam categories and 25 exam directory entries
55. Seeded exam communities, tags and baseline settings
56. CSS selectors and design tokens scoped to `body.examconnect-site`
57. Responsive navigation, forms, grids, tables/cards and mobile breakpoints

Cutoff estimation, official schedule tracking, user blocking, WebSocket delivery and notification-preference screens are not included in this build; they should be treated as future work rather than working features.

## Requirements

- PHP 8.2+
- Composer
- MySQL/MariaDB (or a Laravel-supported database driver)
- PHP extensions required by Laravel 12 and PDO driver for your database

## Local setup

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Create an empty database, configure `DB_*` in `.env`, then run:

```bash
php artisan migrate --seed
php artisan serve
```

Open the URL printed by `php artisan serve`.

### Optional admin account

Set `SEED_ADMIN_EMAIL` and `SEED_ADMIN_PASSWORD` in `.env` **before** running `php artisan db:seed`. The seeder creates the admin account only when both values are explicitly supplied. Use a strong password and do not commit `.env`.

### Seed behavior

Seeders are idempotent: they use `firstOrCreate` / `updateOrInsert` and can be rerun without creating duplicate exam categories, exams, tags, communities or baseline settings. The sample exam directory links to conducting-authority websites. It intentionally does not seed fake candidate reviews, fake cutoff figures or invented exam schedules.

## CSS isolation

The shared stylesheet is scoped to `body.examconnect-site` and uses `--ec-*` custom properties. This reduces collisions with third-party styles and prevents generic selectors such as `button`, `input`, `h1`, `main`, and `.container` from leaking into unrelated pages. Keep the `examconnect-site` body class in `resources/views/layouts/app.blade.php` when adding new views.

## Notes

- `php artisan migrate:fresh --seed` **deletes all database tables and data**. Use it only on a disposable development database.
- Real-time chat currently uses request polling, not WebSockets.
- Official exam dates, answer keys, cutoffs and eligibility must be confirmed from the conducting authority. Community content should not be presented as official information.
"# PaperAnubhav" 
