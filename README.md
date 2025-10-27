# 📱 Capgo Mobile App OTA Manager

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/Filament-3.x-F59E0B?style=for-the-badge&logo=data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTEyIDJMMiA3TDEyIDEyTDIyIDdMMTIgMloiIGZpbGw9IndoaXRlIi8+CjxwYXRoIGQ9Ik0yIDEyTDEyIDE3TDIyIDEyIiBzdHJva2U9IndoaXRlIiBzdHJva2Utd2lkdGg9IjIiLz4KPC9zdmc+" alt="Filament">
  <img src="https://img.shields.io/badge/Capacitor-Compatible-53B9FF?style=for-the-badge&logo=capacitor&logoColor=white" alt="Capacitor">
  <img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="License">
</p>

<p align="center">
  <strong>Over-The-Air (OTA) Update Manager for Capacitor Mobile Applications</strong>
</p>

<p align="center">
  A complete and secure solution to manage and distribute updates for your mobile applications without going through app stores.
</p>

---

## 📖 Table of Contents

- [Features](#-features)
- [Screenshots](#-screenshots)
- [Prerequisites](#-prerequisites)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Usage](#-usage)
- [API Documentation](#-api-documentation)
- [Capacitor Integration](#-capacitor-integration)
- [Security](#-security)
- [Contributing](#-contributing)
- [License](#-license)

---

## ✨ Features

### 🎯 Application Management
- ✅ Modern admin interface with **Filament 3**
- ✅ Multi-application management with unique identifiers
- ✅ Support for application icons and images

### 🚀 Version Management
- ✅ Upload bundles (.zip files)
- ✅ Semantic versioning support
- ✅ Detailed changelog for each version
- ✅ Enable/disable versions
- ✅ Direct bundle downloads

### 🔒 Security & Authentication
- ✅ **API Token Authentication**
- ✅ Automatic secure token generation (SHA-256)
- ✅ Token revocation and regeneration
- ✅ Token usage tracking
- ✅ Complete API route protection

### 📡 RESTful API
- ✅ Endpoints to check for updates
- ✅ Bundle downloads
- ✅ Compatible with **Capacitor Updater** (@capgo/capacitor-updater)
- ✅ Integrated interactive documentation
- ✅ Standardized JSON responses

### 🛠️ Development Tools
- ✅ Artisan commands for token management
- ✅ Docker support (development and production)
- ✅ Complete API documentation
- ✅ Capacitor integration examples

---

## 📸 Screenshots

### App Manager OTA

#### Onboarding
![Create Account Manager](/public/img/Onboarding.png)
*Go to /onboarding and create your manager account*

#### Applications List
![Applications List](/public/img/AppList.png)
*Centralized management of all your mobile applications*

![Applications Creation](/public/img/AppCreate.png)
*Create your app to manage OTA Update of app*

#### Version Management
![Version Management](/public/img/VersionCreate.png)
*Creation version for OTA Update with build zip file of capacitor app*

![Version Management](/public/img/VersionList.png)
*List all version of OTA Update*

#### Integrated API Documentation
![API Documentation](/public/img/APIDocs.png)
*Interactive documentation with code examples and API token*

---

## 📋 Prerequisites

Before starting, make sure you have:

- **PHP** >= 8.2
- **Composer** >= 2.0
- **Node.js** >= 18.x and **NPM** >= 9.x
- **MySQL** >= 8.0 or **MariaDB** >= 10.3
- **Git**

### Optional (recommended)
- **Docker** and **Docker Compose** (for isolated development environment)

---

## 🚀 Installation

### Option 1: Local Installation

#### 1. Clone the project

```bash
git clone https://github.com/your-username/Laravel-Mobile-App-OTA-Manager.git
cd Laravel-Mobile-App-OTA-Manager
```

#### 2. Install dependencies

```bash
# PHP dependencies
composer install

# JavaScript dependencies
npm install
```

#### 3. Environment configuration

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

#### 4. Configure the database

Edit the `.env` file and configure your database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=appmanagerotacapacitor
DB_USERNAME=root
DB_PASSWORD=your_password
```

#### 5. Run migrations

```bash
# Create tables
php artisan migrate

# Generate symbolic link for storage
php artisan storage:link
```

#### 6. Generate initial API token

```bash
php artisan db:seed --class=ApiTokenSeeder
```

> ⚠️ **Important**: Save the displayed token, it will not be shown again!

#### 7. First Time Setup (Onboarding)

When you first access the application, you'll be automatically redirected to the onboarding page at `/onboarding`. This page is only accessible during the initial installation and will allow you to:

- Create the administrator account
- Set up your admin credentials
- Access the admin panel

Simply visit `http://localhost:8000` and you'll be guided through the setup process.

> 📌 **Note**: The onboarding page is automatically disabled after creating the first admin user and will redirect to the login page on subsequent visits.

#### 8. Compile assets

```bash
npm run build
```

#### 9. Start the server

```bash
php artisan serve
```

The application will be accessible at `http://localhost:8000`

---

### Option 2: Docker Installation (Production)

#### 1. Clone the project

```bash
git clone https://github.com/your-username/Laravel-Mobile-App-OTA-Manager.git
cd Laravel-Mobile-App-OTA-Manager
```

#### 2. Configure environment

```bash
cp .env.example .env
# Edit .env with your production settings
```

Important environment variables for Docker:
```env
DB_HOST=mobile_app_manager_mysql
DB_DATABASE=appmanagerotacapacitor
DB_USERNAME=appmanagerotacapacitor
DB_PASSWORD=your_secure_password

API_PORT_EXTERNAL=8080
DB_PORT_EXTERNAL=3307
PHPMYADMIN_PORT_EXTERNAL=8081
```

#### 3. Start containers

```bash
docker-compose -f docker-compose.prod.yaml up -d --build
```

The Docker setup will automatically:
- Wait for MySQL to be ready
- Run database migrations
- Create storage links
- Optimize the application
- Set proper permissions

#### 4. First Time Setup (Onboarding)

Once the containers are running:

1. Visit `http://localhost:8080` (or your configured port)
2. You'll be automatically redirected to the onboarding page
3. Create your administrator account by filling in:
   - Full name
   - Email address
   - Password (minimum 8 characters)
4. Click "Create administrator account"
5. You'll be automatically logged in and redirected to the admin panel

> 📌 **Note**: The onboarding page is only accessible once. After creating the admin account, it will redirect to the login page.

#### 5. Generate API token

```bash
docker-compose exec api php artisan db:seed --class=ApiTokenSeeder
```

> ⚠️ **Important**: Save the displayed token, it will not be shown again!

#### Access Points

- **Application**: `http://localhost:8080`
- **Admin Panel**: `http://localhost:8080/admin`
- **PhpMyAdmin**: `http://localhost:8081`
- **API**: `http://localhost:8080/api/ota`

---

## ⚙️ Configuration

### Important environment variables

```env
# Application
APP_NAME="Laravel OTA Manager"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

# Database
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=appmanagerotacapacitor
DB_USERNAME=root
DB_PASSWORD=your_secure_password

# Session & Cache
SESSION_DRIVER=database
CACHE_STORE=database
```

### API Token Management

API tokens are stored in the database and can be managed via Artisan commands:

```bash
# Show active token
php artisan api-token:manage show

# Generate a new token
php artisan api-token:manage generate --name="Production Token"

# List all tokens
php artisan api-token:manage list

# Revoke active token
php artisan api-token:manage revoke

# Activate a revoked token
php artisan api-token:manage activate
```

---

## 💻 Usage

### Access the admin interface

1. Go to `http://your-domain.com/admin`
2. Log in with your admin credentials

### Create a new application

1. In the menu, click on **"Applications"**
2. Click on **"New Application"**
3. Fill in the information:
   - Application name
   - Identifier (e.g., `com.example.app`)
   - Description
   - Icon (optional)
4. Click on **"Create"**

### Upload a new version

1. In the menu, click on **"Versions"**
2. Click on **"New Version"**
3. Select the application
4. Fill in the information:
   - Version code (e.g., `1.2.0`)
   - Changelog (list of changes)
   - Bundle (.zip)
5. Click on **"Create"**

### View API documentation

1. In the menu, click on **"OTA API Documentation"**
2. You'll find:
   - API base URL
   - Your active API token
   - Request examples for each endpoint
   - Capacitor integration guide

---

## 📚 API Documentation

### Authentication

All API routes require an authentication token provided via the `api_token` parameter:

```bash
curl "http://your-domain.com/api/ota/lastversion?identifier=com.example.app&api_token=YOUR_TOKEN"
```

### Available Endpoints

#### 1. Get the latest version

```http
GET /api/ota/lastversion
```

**Parameters:**
- `identifier` (required) - Application identifier
- `current_version` (optional) - Current version
- `api_token` (required) - Authentication token

**Example response:**
```json
{
  "version": "1.2.0",
  "url": "https://your-domain.com/storage/bundles/com.example.app_1.2.0.zip",
  "changelog": [
    "Bug fixes",
    "Performance improvements"
  ],
  "created_at": "2025-10-25T14:30:00.000000Z"
}
```

#### 2. Check for update availability

```http
GET /api/ota/check-update
```

**Parameters:**
- `identifier` (required) - Application identifier
- `current_version` (required) - Currently installed version
- `api_token` (required) - Authentication token

**Example response:**
```json
{
  "update_available": true,
  "latest_version": "1.2.0",
  "current_version": "1.0.0",
  "url": "https://your-domain.com/storage/bundles/com.example.app_1.2.0.zip",
  "changelog": [
    "Bug fixes",
    "Performance improvements"
  ]
}
```

#### 3. Download a specific version

```http
GET /api/ota/download/{identifier}/{version}
```

**Parameters:**
- `identifier` (path) - Application identifier
- `version` (path) - Version code
- `api_token` (required) - Authentication token

**Response:** ZIP file download

---

## 📱 Capacitor Integration

### Plugin installation

```bash
npm install @capgo/capacitor-updater
npx cap sync
```

### Basic configuration

```typescript
// src/services/updateService.ts
import { CapacitorUpdater } from '@capgo/capacitor-updater'

const API_URL = 'https://your-domain.com/api/ota'
const API_TOKEN = 'YOUR_API_TOKEN'
const APP_IDENTIFIER = 'com.example.app'

export async function checkForUpdates() {
  try {
    const current = await CapacitorUpdater.current()

    const response = await fetch(
      `${API_URL}/check-update?identifier=${APP_IDENTIFIER}&current_version=${current.version}&api_token=${API_TOKEN}`
    )

    const data = await response.json()

    if (data.update_available) {
      console.log('Update available:', data.latest_version)

      // Download and install the update
      const version = await CapacitorUpdater.download({
        url: data.url,
        version: data.latest_version
      })

      await CapacitorUpdater.set(version)
      await CapacitorUpdater.reload()
    }
  } catch (error) {
    console.error('Error checking for updates:', error)
  }
}
```

### Usage in your application

```typescript
// App.tsx or main.ts
import { useEffect } from 'react'
import { CapacitorUpdater } from '@capgo/capacitor-updater'
import { checkForUpdates } from './services/updateService'

function App() {
  useEffect(() => {
    // Notify that the app is ready
    CapacitorUpdater.notifyAppReady()

    // Check for updates on startup
    checkForUpdates()

    // Check periodically (every hour)
    const interval = setInterval(checkForUpdates, 3600000)

    return () => clearInterval(interval)
  }, [])

  return (
    <div className="App">
      {/* Your application */}
    </div>
  )
}

export default App
```
---

## 🔒 Security

### Best Practices

1. **API Token Protection**
   - Never commit the token to Git
   - Use environment variables
   - Store the token securely in your mobile application

2. **HTTPS required in production**
   - The token is transmitted in clear text in the URL
   - HTTPS is essential to secure communications

3. **Regular token rotation**
   ```bash
   # Generate a new token every 3-6 months
   php artisan api-token:manage generate
   ```

4. **Monitoring**
   ```bash
   # Check token usage
   php artisan api-token:manage show
   ```

5. **Revocation in case of compromise**
   ```bash
   php artisan api-token:manage revoke
   php artisan api-token:manage generate
   ```

### File Security

The `.gitignore` file is configured to exclude:
- `.env` files
- `node_modules` and `vendor` folders
- Docker database data
- Storage files

---

## 🏗️ Architecture

```
Laravel-Mobile-App-OTA-Manager/
├── app/
│   ├── Console/Commands/
│   │   └── ManageApiToken.php          # Token management commands
│   ├── Filament/
│   │   ├── Pages/
│   │   │   └── OtaDocumentation.php    # Documentation page
│   │   └── Resources/
│   │       ├── Apps/                    # Application management
│   │       └── Versions/                # Version management
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── OtaController.php        # OTA API
│   │   └── Middleware/
│   │       └── ValidateApiToken.php     # Authentication middleware
│   └── Models/
│       ├── ApiToken.php                 # Token model
│       ├── App.php                      # Application model
│       └── Version.php                  # Version model
├── database/
│   ├── migrations/                      # Database migrations
│   └── seeders/
│       └── ApiTokenSeeder.php           # Initial token generation
├── routes/
│   └── api.php                          # API routes
├── storage/
│   └── app/public/bundles/              # Bundle storage
├── docker-compose.yaml                  # Docker configuration
└── README.md                            # This file
```

---

## 🧪 Testing

```bash
# Unit tests
php artisan test

# Tests with coverage
php artisan test --coverage

# Specific tests
php artisan test --filter=ApiTokenTest
```

---

## 🛠️ Troubleshooting

### Error 401 - Unauthorized

**Cause:** Missing or invalid token

**Solution:**
```bash
# Check active token
php artisan api-token:manage show

# Generate a new token if needed
php artisan api-token:manage generate
```

### Error 404 - Application not found

**Cause:** Application identifier doesn't exist

**Solution:**
1. Check the identifier in the Filament interface
2. Create the application via `/admin`

### Updates not downloading

**Cause:** Missing symbolic link

**Solution:**
```bash
php artisan storage:link
```

### Application not updating

**Cause:** `notifyAppReady()` not called

**Solution:**
```typescript
// In your App.tsx
import { CapacitorUpdater } from '@capgo/capacitor-updater'

useEffect(() => {
  CapacitorUpdater.notifyAppReady()
}, [])
```

---

## 📖 Complete Documentation

- [Installation Guide](INSTALLATION_GUIDE.md)
- [API Documentation](API_DOCUMENTATION.md)
- [Capacitor Integration](CAPACITOR_INTEGRATION_EXAMPLE.md)
- [Laravel Documentation](https://laravel.com/docs)
- [Filament Documentation](https://filamentphp.com/docs)
- [Capacitor Updater Documentation](https://github.com/Cap-go/capacitor-updater)

---

## 🤝 Contributing

Contributions are welcome! Here's how to contribute:

1. Fork the project
2. Create a branch for your feature (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### Guidelines

- Follow Laravel coding conventions and PSR-12
- Add tests for new features
- Update documentation as needed
- Ensure all tests pass before submitting

---

## 📝 Changelog

### Version 1.0.0 (2025-10-25)

#### Added
- Filament admin interface
- Application and version management
- RESTful API for OTA
- API token authentication
- Integrated interactive documentation
- Docker support
- Artisan commands for token management
- Capacitor integration guide

---

## 👥 Authors

- **AvivoB** - *Lead Developer* - [@AvivoB](https://agence-devivo.fr)

---

## 📄 License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

---

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) - PHP Framework
- [Filament](https://filamentphp.com) - Admin Interface
- [Capacitor](https://capacitorjs.com) - Mobile Framework
- [Capacitor Updater](https://github.com/Cap-go/capacitor-updater) - Update Plugin

---

## 📞 Support

For any questions or issues:

- 📧 Email: contact.devivo@gmail.com
- 🐛 Issues: [GitHub Issues](https://github.com/your-username/Laravel-Mobile-App-OTA-Manager/issues)
- 💬 Discussions: [GitHub Discussions](https://github.com/your-username/Laravel-Mobile-App-OTA-Manager/discussions)

---

<p align="center">
  Made with ❤️ by your team
</p>
