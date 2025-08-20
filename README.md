# ims

# Internship Management System - README.md

```markdown
# Internship Management System

A comprehensive web-based platform built with PHP to manage the entire internship process.

## 🌟 Features

### For Students
- **User Registration & Profiles**: Create and manage student profiles
- **Internship Applications**: Browse and apply for available internships
- **Application Tracking**: Monitor application status in real-time
- **Document Management**: Upload resumes, cover letters, and other required documents
- **Referral System**: Share referral codes and earn rewards when friends enroll




### For Administrators
- **User Management**: Oversee students, companies, and administrators
- **Content Moderation**: Review and approve internships and profiles
- **System Analytics**: Comprehensive reporting and statistics
- **Referral Program Management**: Configure and monitor referral rewards
- **Application Management**: Review, filter, and manage student applications
- **Candidate Communication**: Direct messaging system with applicants
- **Analytics Dashboard**: Track application metrics and engagement
- **System Configuration**: Customize platform settings and policies

## 🛠️ Technology Stack

- **Backend**: PHP 7.4+ 
- **Frontend**: HTML5, CSS3, JavaScript (with Bootstrap recommended)
- **Database**: MySQL 5.7+ or PostgreSQL
- **Server**: Apache/Nginx
- **Additional Tools**: Composer, Git, npm

## 📋 Prerequisites

Before installation, ensure your server meets the following requirements:

- PHP 7.4 
- MySQL 5.7+ 
- Web server (Apache) 
- Composer (for dependency management)


## 🚀 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/iprojects2021/ims.git
   cd ims
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install frontend dependencies** (if using a frontend build system)
   ```bash
   npm install
   npm run dev
   ```

4. **Configure environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Update environment variables**
   Edit the `.env` file with your database credentials and application settings:
   ```
   DB_HOST=localhost
   DB_PORT=3306
   DB_DATABASE=internship_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. **Run database migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed the database** (optional)
   ```bash
   php artisan db:seed
   ```

8. **Set up storage link**
   ```bash
   php artisan storage:link
   ```

9. **Configure web server**
   Point your web server to the `public` directory and set up appropriate permissions.

## 🔧 Configuration

### Email Setup
Configure your email settings in the `.env` file for notifications:
```
MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_email@indsac.com
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=no-reply@indsac.com
MAIL_FROM_NAME="IMS"
```

### File Uploads
Configure file upload settings in `config/filesystems.php`:
- Maximum file size for resumes and documents
- Allowed file types
- Storage locations 

### Referral System
Set up referral rewards and rules in the admin panel or in `config/referral.php`:
- Reward amount per successful referral
- Minimum requirements for payout
- Referral code format and expiration

## 👥 User Roles

### Student
- Register and create profile
- Browse and apply for internships
- Track application status
- Manage documents and portfolio
- Use referral system

### Company Representative
- Register company profile
- Post and manage internship opportunities
- Review applications
- Communicate with candidates
- Manage interview scheduling

### Administrator
- Manage all users and content
- Configure system settings
- Monitor system analytics
- Handle reporting and issues

## 🔐 Security Features

- Password hashing with bcrypt
- CSRF protection
- XSS prevention
- SQL injection prevention through prepared statements
- File upload validation
- Role-based access control
- HTTPS enforcement (in production)

## 📊 Database Schema

The system uses a relational database with the following main tables:

- `users` (students, companies, admins)
- `profiles` (user profile information)
- `internships` (internship opportunities)
- `applications` (student applications)
- `documents` (resumes, cover letters, etc.)
- `referrals` (referral tracking)
- `payments` (reward payments)

## 🔄 Workflow

### Student Application Process
1. Student registers and completes profile
2. Student browses available internships
3. Student applies to selected internships
4. Company reviews application
5. Company contacts student for interview
6. Application status updated (accepted/rejected)
7. Student accepts/declines offer

### Referral Process
1. Student generates referral code
2. Student shares code with friends
3. Friend registers using referral code
4. Friend applies and gets accepted to internship
5. Referring student receives reward after successful completion

## 📈 Reporting & Analytics

The system includes comprehensive reporting features:
- Application statistics
- Placement rates
- Company engagement metrics
- Referral program performance
- User activity reports

## 🧪 Testing

Run the test suite with:
```bash
php artisan test
```

The system includes:
- Unit tests for core functionality
- Feature tests for user workflows
- Browser tests for critical user journeys

## 🚀 Deployment

### Production Checklist
- [ ] Environment set to production
- [ ] Debug mode disabled
- [ ] SSL certificate installed
- [ ] Database backups configured
- [ ] Monitoring setup
- [ ] Performance optimization
- [ ] Security audit completed

### Deployment Methods
- Traditional FTP/SFTP (not recommended)
- Git-based deployment
- Docker containerization
- Platform-as-a-Service (Heroku, Forge, etc.)

## 🤝 Documentation

 Please see our [Documentation](DOCUMENTATION.md) for details.


## 🤝 Contributing

We welcome contributions! Please see our [Contributing Guidelines](CONTRIBUTING.md) for details.

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request


## 🛟 Support

If you encounter any issues or have questions:

1. Check the [documentation](https://github.com/your-organization/internship-management-system/wiki)
2. Search [existing issues](https://github.com/your-organization/internship-management-system/issues)
3. Create a [new issue](https://github.com/your-organization/internship-management-system/issues/new)

## 🙏 Acknowledgments

- Icons by [Font Awesome](https://fontawesome.com)
- UI components inspired by [Bootstrap](https://getbootstrap.com)
- PHP framework by [Laravel](https://laravel.com)

---

<div align="center">
Made with ❤️ by the Internship Management System Team
</div>
```
