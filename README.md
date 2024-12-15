# Dental Clinic Record Management System

A comprehensive web-based solution for managing dental clinic operations, including patient records, appointments, and treatment tracking.

![Laravel](https://img.shields.io/badge/Laravel-11.35.1-red)
![PHP](https://img.shields.io/badge/PHP-8.2-blue)
![MySQL](https://img.shields.io/badge/MySQL-5.7-orange)
![License](https://img.shields.io/badge/license-MIT-green)

## Features

### Role-Based Access Control
- **Admin Dashboard**: Complete system control and management
- **Dentist Portal**: Patient and appointment management
- **Employee Interface**: Basic patient and appointment handling

### Patient Management
- Comprehensive patient records
- Medical history tracking
- Contact information management
- Search and filter capabilities

### Appointment System
- Smart scheduling system
- Conflict prevention
- Status tracking (scheduled/completed/cancelled)
- Calendar view

### Treatment Records
- Detailed treatment documentation
- Cost tracking
- Payment status monitoring
- Treatment history

### Advanced Search & Filtering
- Multi-parameter search
- Date range filtering
- Status-based filtering
- Cost range filtering

## Tech Stack

- **Framework**: Laravel 11.35.1
- **Database**: MySQL 5.7
- **Frontend**: Blade Templates with Tailwind CSS
- **Authentication**: Laravel Breeze
- **CSS Framework**: Tailwind CSS

## Installation

1. Clone the repository
```bash
git clone https://github.com/yourusername/dental-clinic-system.git
cd dental-clinic-system
```

2. Install PHP dependencies
```bash
composer install
```

3. Copy environment file
```bash
cp .env.example .env
```

4. Configure your `.env` file with database credentials

5. Generate application key
```bash
php artisan key:generate
```

6. Run migrations and seed the database
```bash
php artisan migrate:fresh --seed
```

7. Start the development server
```bash
php artisan serve
```

## Default Users

After seeding, you can log in with these default accounts:

### Admin Account
- Email: admin@dental.com
- Password: password

### Dentist Account
- Email: john.smith@dental.com
- Password: password

### Employee Account
- Email: jane.cooper@dental.com
- Password: password

## Documentation

Detailed documentation is available in the `documentation` folder:
- [User Manual](documentation/user_manual.md)
- [Technical Documentation](documentation/technical_documentation.md)

## Security

- Role-based access control
- Password hashing
- CSRF protection
- XSS prevention
- Input validation
- Soft deletes for data preservation

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Acknowledgments

- Laravel Team for the framework
- Tailwind CSS for the styling utilities
