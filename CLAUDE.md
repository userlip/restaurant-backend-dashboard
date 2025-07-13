# Claude Assistant Context

## Project Overview
This is a Laravel-based restaurant backend dashboard with Filament admin panel. The application manages leads, domains, and various restaurant-related data.

## Recent Implementations

### Review Tracking System
A comprehensive Google Reviews tracking system has been implemented for leads:
- Fetches reviews from Scrappa API
- Tracks reviews by star rating (1-5 stars)
- Calculates average ratings
- Automated daily updates via scheduled task
- Manual update capabilities in admin panel

Key files:
- `app/Service/ReviewService.php` - Core service for API integration
- `app/Console/Commands/UpdateLeadReviews.php` - CLI command
- `database/migrations/2025_07_13_143005_add_review_counts_to_leads_table.php` - Schema changes
- `app/Filament/Resources/LeadResource.php` - Admin UI updates

### Language and Navigation
- Default language set to German (de)
- Smooth scroll navigation with auto-closing menu
- Social media icons removed from hero section

## Important Commands
When making code changes, always run:
```bash
npm run lint
npm run typecheck
```

## Environment Variables
Key variables that need configuration:
- `SCRAPPA_API_KEY` - Required for review tracking functionality
- `DB_*` - Database connection settings
- `POSTMARK_TOKEN` - Email service configuration

## Testing
The project includes test scripts for:
- Review system functionality: `php test-review-system.php`
- Business ID extraction: `php test-business-id-extraction.php`
- Scrappa API connection: `php test-scrappa-reviews.php`

## Common Tasks
1. **Update Reviews**: `php artisan leads:update-reviews`
2. **Run Migrations**: `php artisan migrate`
3. **Clear Cache**: `php artisan cache:clear`
4. **Build Assets**: `npm run build`

## Architecture Notes
- Uses Filament v3 for admin panel
- Livewire for reactive components
- Tailwind CSS for styling
- MySQL database
- Scheduled tasks via Laravel's task scheduler