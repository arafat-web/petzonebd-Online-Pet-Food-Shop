# PetZoneBD - Online Pet Food Shop

A modern, full-featured e-commerce platform for pet food and supplies with comprehensive admin dashboard and customer portal.

---

## About PetZoneBD

PetZoneBD is a professional-grade e-commerce solution designed specifically for pet food retailers and suppliers. The platform provides a seamless shopping experience for customers while offering robust management tools for store administrators. Built with modern web technologies and best practices, PetZoneBD enables businesses to manage product catalogs, process orders, track inventory, and build customer relationships efficiently.

The platform is designed to scale with your business, supporting multiple product categories, promotional features like discounts, customer accounts with order history, and comprehensive analytics through the admin dashboard.

---

## Technology Stack

### Backend
- **Framework**: Laravel 9.x (PHP)
- **Authentication**: Laravel Jetstream & Fortify
- **Database**: MySQL
- **ORM**: Eloquent
- **API**: RESTful architecture with JSON endpoints
- **Caching**: Laravel Cache (24-hour category caching)

### Frontend
- **CSS Framework**: Bootstrap 5.3.0
- **UI Components**: Bootstrap Icons
- **JavaScript**: Vanilla JS with AJAX for real-time features
- **Templating**: Blade (Laravel's templating engine)
- **Build Tools**: Vite, Tailwind CSS, PostCSS

### Additional Technologies
- **Package Manager**: Composer, NPM
- **Server**: Apache/Nginx (PHP 8+)
- **Session Management**: Laravel Session Handler
- **Validation**: Laravel Validation Rules
- **Mail**: SMTP Integration Ready

---

## Core Features

### Customer Features
- Product Search: Real-time AJAX search functionality with instant results
- Product Browsing: Browse products by category with filtering options
- Product Details: Comprehensive product information with pricing and discounts
- Shopping Cart: Full-featured shopping cart with quantity adjustments
- Secure Checkout: Multi-step secure checkout process
- Order History: View past orders with detailed information
- User Profile: Manage personal information and account settings
- Responsive Design: Fully functional on desktop, tablet, and mobile devices

### Discount & Pricing
- Product Discounts: Apply percentage-based discounts to products
- Display Pricing: Automatic calculation and display of discounted prices
- Real-time Pricing: Dynamic price calculation in cart and checkout

### Admin Features
- Admin Dashboard: Comprehensive overview of business metrics
- Product Management: Create, read, update, and delete products
- Category Management: Organize products into categories
- Order Management: View, process, and track customer orders
- Discount Management: Set and manage product discounts
- Settings Management: Configure store settings and preferences
- User Management: View and manage user accounts
- Role-Based Controls: Separate admin and customer roles with permissions

### Technical Features
- Category Caching: Optimized performance with intelligent caching
- SEO-Friendly URLs: Slug-based routing for better search visibility
- Session Management: Secure user session handling
- Error Handling: Comprehensive error handling and validation
- AJAX Features: Real-time search and dynamic content loading
- Mobile Responsive: Mobile-first responsive design approach
- Form Validation: Client and server-side validation
- Security: CSRF protection, password hashing, input sanitization

---

## User Interface

### Dark Theme Design
- Modern dark color scheme for reduced eye strain
- Accent colors (orange) for call-to-action elements
- Consistent spacing and typography throughout
- Custom color variables for easy theme customization

### Navigation
- Sticky navbar for quick access to navigation
- Category megamenu for browsing all product categories
- Real-time search bar with dropdown results
- User account menu with quick links
- Mobile-responsive hamburger menu

---

## Screenshots

### Homepage
![PetZoneBD Homepage](screenshots/petzonebd-online-pet-food-shop-test.png)

The main landing page featuring featured products, category navigation, and shopping cart access.

### Product Category Browsing
![Product Category Page](screenshots/petzonebd-online-pet-food-shop-test-products-cat-food.png)

Browse products within specific categories with product cards showing images, prices, discounts, and quick add-to-cart buttons.

### Shopping Cart
![Shopping Cart](screenshots/petzonebd-online-pet-food-shop-test-cart.png)

View all items in the shopping cart with quantity adjustments, price calculation, and checkout options.

### Checkout Process
![Checkout Page](screenshots/petzonebd-online-pet-food-shop-test-checkout.png)

Secure checkout interface with delivery information, payment options, and order summary.

### Customer Dashboard
![Customer Dashboard](screenshots/petzonebd-online-pet-food-shop-test-my-dashboard.png)

Personal customer portal for viewing order history, managing profile, and tracking deliveries.

---

## Installation & Setup

### Requirements
- PHP 8.0 or higher
- Composer
- Node.js & NPM
- MySQL 5.7 or higher
- Web server (Apache/Nginx)

### Quick Start

1. Clone the repository
```bash
git clone https://github.com/yourusername/petzonebd.git
cd petzonebd
```

2. Install dependencies
```bash
composer install
npm install
```

3. Configure environment
```bash
cp .env.example .env
php artisan key:generate
```

4. Database setup
```bash
php artisan migrate
php artisan db:seed
```

5. Build assets
```bash
npm run build
```

6. Serve the application
```bash
php artisan serve
```

Access the application at `http://localhost:8000`

---

## Project Structure

The codebase is organized following Laravel's standard structure with clear separation of concerns:

- **app**: Application core including controllers, models, and business logic
- **resources**: Views, stylesheets, and JavaScript files
- **database**: Migrations and seeders
- **routes**: Application routes (web, API, console)
- **public**: Publicly accessible assets and uploads
- **config**: Configuration files for application services

---

## Usage

### For Customers
1. Browse products by category or use the search functionality
2. View product details and pricing
3. Add items to shopping cart
4. Proceed to checkout
5. Create an account or login
6. Complete payment and view order confirmation
7. Track order status in customer dashboard

### For Administrators
1. Login to admin dashboard
2. Manage product catalog (add, edit, delete products)
3. Organize products into categories
4. Set product discounts and pricing
5. Process customer orders
6. Configure store settings
7. View sales reports and analytics

---

## API Endpoints

### Search API
- **Endpoint**: `GET /api/search?q=query`
- **Response**: JSON array of matching products
- **Used by**: AJAX search functionality

---

## Performance Optimizations

- Category caching with 24-hour TTL
- Lazy loading for product images
- Efficient database queries with eager loading
- Minified CSS and JavaScript assets
- Image optimization for faster load times
- AJAX for non-blocking dynamic content

---

## Security Features

- CSRF token protection on all forms
- Secure password hashing with bcrypt
- Input validation and sanitization
- SQL injection prevention through Eloquent ORM
- Role-based access control
- Session timeout protection
- Secure cookie handling

---

## Future Enhancements

- Payment gateway integration (Stripe, bKash)
- Email notifications for orders
- Product reviews and ratings
- Wishlist functionality
- Advanced analytics and reporting
- Inventory management
- Multiple payment methods
- Customer email notifications
- SMS notifications

---

## Contributing

Contributions are welcome! Please feel free to submit pull requests or open issues for bugs and feature requests.

---

## License

This project is open source and available under the MIT License.

---

## Support

For questions or support, please contact support@petzonebd.com or create an issue on the project repository.

---

## Author

Built with passion for pet lovers and e-commerce excellence.

**Version**: 2.0 | **Last Updated**: February 2026

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/9.x)

Clone the repository

    git clone https://github.com/arafat-web/petzonebd.git

Switch to the repo folder

    cd petzonebd

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Seed the database with sample data

    php artisan db:seed

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

### Test Credentials

**Admin Panel:**
- Email: `admin@petzone.com`
- Password: `admin@123`

**Customer Account:**
- Email: `test@petzone.com`
- Password: `test@123`

# Screenshots

## Home Page

![Home Page](screenshots/petzonebd-online-pet-food-shop-test.png)

## Product Categories

![Products](screenshots/petzonebd-online-pet-food-shop-test-products-cat-food.png)

## Shopping Cart

![Cart](screenshots/petzonebd-online-pet-food-shop-test-cart.png)

## Checkout

![Checkout](screenshots/petzonebd-online-pet-food-shop-test-checkout.png)

## User Dashboard

![User Dashboard](screenshots/petzonebd-online-pet-food-shop-test-my-dashboard.png)

## Color Scheme

The application uses a carefully curated color palette:

- **Cream**: #FAF7F2 - Primary background
- **Ink**: #2E2E2C - Text and dark elements
- **Accent**: #E8521A - CTAs and highlights
- **Sage**: #4A6741 - Secondary accents
- **Sand**: #C4B5A0 - Neutral elements

## Project Structure

```
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   ├── AdminController.php
│   │   │   ├── ClientController.php
│   │   │   ├── CartController.php
│   │   │   ├── CheckoutController.php
│   │   │   └── UserController.php
│   │   └── Middleware/
│   │       └── IsAdmin.php
│   └── Models/
│       ├── User.php
│       ├── Product.php
│       ├── Category.php
│       ├── Order.php
│       └── OrderItem.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/
│       ├── admin/
│       ├── client/
│       └── layouts/
├── routes/
│   └── web.php
└── public/
    └── css/
        └── style.css
```

## Database Schema

The application includes the following main tables:

- **users** - Customer and admin accounts
- **products** - Product catalog
- **categories** - Product categories
- **orders** - Customer orders
- **order_items** - Order line items
- **payments** - Payment records

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is open-sourced software licensed under the [MIT License](LICENSE).

## Support

For support, please open an issue on GitHub.

 <hr>

 # Thanks
