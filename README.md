# Cricket Betting Website

A simple cricket betting platform built with PHP, MySQL, and HTML/CSS.

## Features
- User registration and login
- Bet on match winner, highest wicket-taker, and over runs at 6, 10, 15, 20 over marks
- Use real money or virtual credits
- View results and your bet outcomes

## Setup Instructions

1. **Clone or copy the project files to your web server directory.**

2. **Create the MySQL database:**
   - Create a database named `cricket_betting`.
   - Import the schema from `sql/schema.sql`.

3. **Configure database connection:**
   - Edit `includes/db.php` if your MySQL username or password is different from `root`/blank.

4. **Run the website:**
   - Use XAMPP, MAMP, or any LAMP stack.
   - Access `index.php` from your browser.

## File Structure
- `index.php` - Landing page
- `register.php` - User registration
- `login.php` - User login
- `dashboard.php` - User dashboard
- `bet.php` - Place bets
- `results.php` - View results and your bets
- `logout.php` - Logout script
- `includes/` - Database and authentication logic
- `style.css` - Basic styling
- `sql/schema.sql` - MySQL schema

## Notes
- This is a demo project. For real money betting, ensure you comply with all legal and regulatory requirements in your jurisdiction. 