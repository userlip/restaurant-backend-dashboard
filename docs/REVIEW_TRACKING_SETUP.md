# Lead Review Tracking System Setup Guide

## Overview
The review tracking system automatically fetches and updates Google reviews for leads using the Scrappa API. It tracks review counts by star rating, calculates average ratings, and provides both manual and automated update capabilities.

## Setup Instructions

### 1. Environment Configuration
Add your Scrappa API key to the `.env` file:
```
SCRAPPA_API_KEY=your_actual_api_key_here
```

### 2. Run Database Migration
Execute the migration to add review tracking fields to the leads table:
```bash
php artisan migrate
```

This adds the following fields:
- `one_star_count`, `two_star_count`, `three_star_count`, `four_star_count`, `five_star_count`
- `total_reviews` - Total number of reviews
- `average_rating` - Average rating (1.0 to 5.0)
- `google_business_id` - Extracted Google Business ID
- `reviews_last_updated_at` - Last update timestamp

### 3. Google Business ID Setup
The system can work with Google Business IDs in two ways:

#### Option A: Manual Entry
Enter the Business ID directly in the lead's `google_business_id` field via the admin panel.

#### Option B: Automatic Extraction
If a lead has a Google Maps URL in their `link` field, the system will automatically extract the Business ID. Supported URL formats:
- `https://www.google.com/maps/place/...0x479e7a4b857d313f:0x420cb24f794c84da`
- `https://maps.app.goo.gl/...`
- `https://goo.gl/maps/...`

Example Business ID: `0x479e7a4b857d313f:0x420cb24f794c84da`

## Usage

### Manual Updates

#### Update Single Lead
Via command line:
```bash
php artisan leads:update-reviews --lead=123
```

Via admin panel:
- Navigate to the Leads table
- Click the star icon (⭐) in the actions column for any lead

#### Update Multiple Leads
Via command line (respects 24-hour update interval):
```bash
php artisan leads:update-reviews
```

Force update all leads:
```bash
php artisan leads:update-reviews --force
```

Via admin panel:
- Select multiple leads using checkboxes
- Choose "Update Reviews" from the bulk actions dropdown

### Automated Updates
The system automatically updates reviews daily at 2:00 AM. This is configured in `app/Console/Kernel.php`.

To monitor automated updates:
```bash
tail -f storage/logs/lead-reviews.log
```

## Admin Interface Features

The Leads table now displays:
- **1★, 2★, 3★** - Individual star rating counts with color-coded badges
- **Total Reviews** - Sum of all reviews
- **Average Rating** - Color-coded average (green: >4, yellow: 3-4, red: <3)
- **Update Reviews Action** - Star icon to manually trigger updates

## Testing

### Test Business ID Extraction
```bash
php test-business-id-extraction.php
```

### Test API Connection
```bash
php test-scrappa-reviews.php
```

### Test Overall System
```bash
php test-review-system.php
```

## Troubleshooting

### API Authentication Error
If you see "401 Unauthorized" errors:
1. Verify `SCRAPPA_API_KEY` is set in `.env`
2. Check that the API key is valid
3. Ensure the key has proper permissions

### No Reviews Found
1. Verify the Google Business ID is correct
2. Check if the business actually has reviews on Google
3. Try the Business ID in Google Maps to confirm it's valid

### Rate Limiting
The system includes automatic delays between API requests. If you encounter rate limiting:
- Reduce the number of concurrent updates
- Increase the delay in `ReviewService::fetchReviewsPage()`

## API Response Format
The Scrappa API returns paginated results:
```json
{
  "data": [
    {
      "author_name": "John Doe",
      "rating": 5,
      "text": "Excellent service!",
      "time": 1699987200
    }
  ],
  "has_more": true,
  "page": 1
}
```

## Performance Considerations
- Reviews are only updated once every 24 hours per lead
- The system fetches all pages of reviews (up to 100 pages)
- Each API call has a 1-second delay to prevent rate limiting
- Bulk updates show a progress bar for better UX

## Security
- API keys are stored in environment variables
- All API requests use HTTPS
- Error logs don't expose sensitive information