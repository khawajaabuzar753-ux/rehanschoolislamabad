# Rehan School Landing Page - Setup Guide

## Database Setup

1. **Create the database tables** by running the SQL file:
   ```sql
   mysql -u abuz_farhan1 -p abuz_abuzar < database_setup.sql
   ```
   
   Or manually execute the SQL commands in `database_setup.sql`

2. **Database Credentials** (already configured in `src/database.php`):
   - Database: `abuz_abuzar`
   - User: `abuz_farhan1`
   - Password: `1234`

## Files Created/Modified

### New Files:
- `public/index.php` - Complete landing page with all sections
- `public/referral_handler.php` - Handles referral code generation
- `public/feedback_handler.php` - Handles feedback form submissions
- `assets/js/landing.js` - JavaScript for animations and interactivity
- `database_setup.sql` - Database schema for referral codes and feedback

### Modified Files:
- `assets/css/style.css` - Added comprehensive landing page styles with animations
- `src/database.php` - Updated with new database credentials

## Features Implemented

✅ **Hero Section** with animated background and floating shapes
✅ **About Our System** with 3 feature cards and animated statistics
✅ **Testimonials** section (without user DPs as requested)
✅ **What You'll Learn in Level 1** with 3 learning cards
✅ **Why Choose Our Level 1 Program** with 3 benefit cards
✅ **Simple, Transparent Pricing** with 3 pricing tiers (enhanced design)
✅ **Referral Rewards Program** with working referral code generation
✅ **Share Your Feedback** form with professional styling
✅ **Footer** with CTA section

## Animations & Effects

- ✅ Smooth scrolling navigation
- ✅ Animated background patterns
- ✅ Floating shapes in hero section
- ✅ Counter animations on scroll (for statistics)
- ✅ Fade-in animations for cards
- ✅ Hover effects on all buttons and cards
- ✅ Parallax effects
- ✅ Professional color scheme with gradients

## Navigation

- Login/Signup buttons in navbar (non-functional as requested - separate files will be created)
- Smooth scroll to all sections
- Responsive mobile navigation

## Important Notes

1. The image URL for the hero section is already included: `https://i.postimg.cc/zBCXp3Bm/Whats-App-Image-2020-10-02-at-8-28-08-AM-768x1024-removebg-preview.png`

2. All buttons are styled with hover animations and professional effects

3. The referral code system is fully functional - users can generate codes by entering their email

4. The feedback form submits to the database and shows success/error messages

5. All text has been expanded and made more detailed as requested

6. Professional fonts (Inter & Poppins) are loaded from Google Fonts

7. The website is fully responsive and works on all devices

## Testing

1. Visit `http://localhost/public/index.php` (or your server URL)
2. Test the referral code generation by entering an email
3. Test the feedback form submission
4. Scroll through all sections to see animations
5. Test hover effects on buttons and cards
6. Check responsive design on mobile devices

## Next Steps

- Create separate login.php and signup.php files (as mentioned, these will be separate)
- Add any additional features as needed
- Customize colors or content if required


