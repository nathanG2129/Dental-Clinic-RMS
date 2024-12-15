# Dental Clinic Record Management System - Technical Documentation

## System Architecture

### Technology Stack
- **Framework**: Laravel 11.35.1
- **PHP Version**: 8.2.0
- **Database**: MySQL
- **Frontend**: Blade Templates with Tailwind CSS
- **Authentication**: Laravel Breeze

### Directory Structure
```
├── app
│   ├── Http
│   │   ├── Controllers
│   │   │   ├── Admin
│   │   │   ├── Dentist
│   │   │   ├── Employee
│   │   │   └── Auth
│   │   ├── Middleware
│   │   └── Requests
│   └── Models
├── database
│   ├── migrations
│   └── seeders
├── resources
│   └── views
└── routes
```

## Database Schema

### Users Table
```sql
CREATE TABLE users (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    role ENUM('admin', 'dentist', 'employee'),
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### Patients Table
```sql
CREATE TABLE patients (
    patient_id BIGINT PRIMARY KEY AUTO_INCREMENT,
    patient_name VARCHAR(255),
    date_of_birth DATE,
    gender ENUM('male', 'female', 'other'),
    contact_information VARCHAR(255),
    address TEXT,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP NULL
);
```

### Dentists Table
```sql
CREATE TABLE dentists (
    dentist_id BIGINT PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT FOREIGN KEY,
    dentist_name VARCHAR(255),
    specialization VARCHAR(255),
    contact_information VARCHAR(255),
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP NULL
);
```

### Appointments Table
```sql
CREATE TABLE appointments (
    appointment_id BIGINT PRIMARY KEY AUTO_INCREMENT,
    patient_id BIGINT FOREIGN KEY,
    dentist_id BIGINT FOREIGN KEY,
    appointment_date DATETIME,
    purpose_of_appointment VARCHAR(255),
    status ENUM('scheduled', 'completed', 'cancelled'),
    notes TEXT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP NULL
);
```

### Treatment Records Table
```sql
CREATE TABLE treatment_records (
    record_id BIGINT PRIMARY KEY AUTO_INCREMENT,
    patient_id BIGINT FOREIGN KEY,
    dentist_id BIGINT FOREIGN KEY,
    treatment_type VARCHAR(255),
    treatment_details TEXT,
    treatment_date DATE,
    cost DECIMAL(10,2),
    payment_status ENUM('pending', 'paid', 'partially_paid'),
    notes TEXT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP NULL
);
```

## Authentication & Authorization

### Middleware
- `auth`: Basic authentication check
- `verified`: Email verification check
- `role`: Role-based access control
- `RedirectIfAuthenticated`: Handles role-based redirects

### Role-based Access
- Admin: Full access to all features
- Dentist: Limited to patient-related features
- Employee: Limited to basic patient and appointment management

## Controllers

### Structure
Each major feature has its own controller namespace:
- `Admin/*Controller`: Admin-specific features
- `Dentist/*Controller`: Dentist-specific features
- `Employee/*Controller`: Employee-specific features

### Key Controllers
1. **PatientController**
   - CRUD operations for patients
   - Search and filter functionality
   - Soft delete implementation

2. **AppointmentController**
   - Appointment scheduling
   - Status management
   - Conflict checking

3. **TreatmentRecordController**
   - Treatment record management
   - Payment status tracking
   - Cost calculation

## Models

### Relationships
```php
// Patient Model
public function appointments() {
    return $this->hasMany(Appointment::class);
}
public function treatmentRecords() {
    return $this->hasMany(TreatmentRecord::class);
}

// Dentist Model
public function user() {
    return $this->belongsTo(User::class);
}
public function appointments() {
    return $this->hasMany(Appointment::class);
}
public function treatmentRecords() {
    return $this->hasMany(TreatmentRecord::class);
}
```

## Search Implementation

### Patient Search
- Name search using LIKE queries
- Contact information search
- Age calculation using TIMESTAMPDIFF
- Gender filtering

### Appointment Search
- Date range filtering
- Status filtering
- Patient/Dentist name search
- Purpose filtering

### Treatment Record Search
- Date range filtering
- Cost range filtering
- Payment status filtering
- Treatment type search

## Views

### Layout Structure
- Master layout with role-specific sidebars
- Reusable components for tables and forms
- Responsive design using Tailwind CSS

### Components
- `x-layout.app`: Main layout component
- `x-table.*`: Table components
- `x-card`: Card component for content sections

## Security Measures

### Authentication
- Password hashing using bcrypt
- CSRF protection
- Session management
- Role-based middleware

### Data Protection
- Soft deletes for data preservation
- Input validation
- SQL injection prevention
- XSS protection

## Deployment Requirements

### Server Requirements
- PHP >= 8.2.0
- MySQL >= 5.7
- Composer
- Node.js & NPM (for asset compilation)

### Installation Steps
1. Clone repository
2. Install dependencies: `composer install`
3. Configure environment: `.env`
4. Generate key: `php artisan key:generate`
5. Run migrations: `php artisan migrate`
6. Seed database: `php artisan db:seed`

### Maintenance
- Regular backups
- Log monitoring
- Security updates
- Performance optimization

## Testing

### Test Types
- Feature tests for controllers
- Unit tests for models
- Browser tests for UI

### Running Tests
```bash
php artisan test
```

## Error Handling

### Logging
- Daily log rotation
- Error tracking
- User action logging

### Common Issues
1. Appointment conflicts
2. Data validation errors
3. Permission issues
4. Search performance

## Performance Optimization

### Database
- Indexed fields
- Eager loading relationships
- Query optimization

### Caching
- Route caching
- Config caching
- View caching

## Future Improvements
1. API implementation
2. Enhanced reporting
3. SMS notifications
4. Online payment integration
5. Patient portal 