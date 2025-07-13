# Deployment Steps for Review Tracking System

Follow these steps on your production server (ploi@restaurant-business):

## 1. Pull Latest Code
```bash
git pull origin master
```

## 2. Install Dependencies (if needed)
```bash
composer install --no-dev --optimize-autoloader
```

## 3. Clear Caches
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

## 4. Run Database Migration
```bash
php artisan migrate
```

This will add the following fields to the leads table:
- one_star_count, two_star_count, three_star_count, four_star_count, five_star_count
- total_reviews, average_rating
- google_business_id, reviews_last_updated_at

## 5. Add Scrappa API Key
Edit your `.env` file and add:
```
SCRAPPA_API_KEY=your_actual_api_key_here
```

## 6. Clear Config Cache Again
```bash
php artisan config:cache
```

## 7. Test the Command
```bash
# Test with a single lead first
php artisan leads:update-reviews --lead=1

# Then update all leads
php artisan leads:update-reviews
```

## 8. Verify Scheduled Task
The command is already scheduled to run daily at 2 AM. Verify it's in the schedule:
```bash
php artisan schedule:list
```

## 9. Check the Admin Panel
Visit https://simpleeats.net/admin/leads and you should now see:
- 1★, 2★, 3★ columns with review counts
- Total Reviews column
- Average Rating column
- Update Reviews action button (star icon)

## Troubleshooting

If columns don't appear:
1. Hard refresh the browser (Ctrl+F5 or Cmd+Shift+R)
2. Clear browser cache
3. Log out and log back in to the admin panel

If command not found:
```bash
php artisan optimize:clear
composer dump-autoload
```