# 📝 Personal Blog App

Aplikasi web blog dinamis berbasis **PHP 8.x** dan **CodeIgniter 4** sebagai tugas UTS mata kuliah Pengembangan Aplikasi Web Framework.

---

## 🚀 Fitur

### Admin Panel
- 🔐 Login & Logout Admin
- 📊 Dashboard statistik (total post, published, draft, kategori)
- ✍️ CRUD Post dengan Rich Text Editor (Quill.js)
- 🏷️ Manajemen Kategori
- 🖼️ Upload Thumbnail artikel

### Halaman Publik
- 🏠 Homepage dengan grid artikel
- 📖 Halaman detail artikel
- 🗂️ Filter artikel per kategori
- 🔍 Search artikel
- 📄 Pagination

---

## 🛠️ Teknologi

| Teknologi | Versi |
|-----------|-------|
| PHP | 8.x |
| CodeIgniter | 4.x |
| MySQL | 8.x |
| Bootstrap | 5.3 |
| Quill.js | 1.3.6 |

---

## ⚙️ Cara Install

### 1. Clone Repository
```bash
git clone https://github.com/hananalfaruq/project3.git
cd project3
```

### 2. Install Dependency
```bash
composer install
```

### 3. Konfigurasi Environment
```bash
cp env .env
```

Edit file `.env`:
```env
CI_ENVIRONMENT = development
app.baseURL = 'http://localhost:8080/'

database.default.hostname = localhost
database.default.database = db_blog
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
database.default.port = 3306
```

### 4. Buat Database
Buka phpMyAdmin dan buat database:
```sql
CREATE DATABASE db_blog;
```

### 5. Jalankan Migration
```bash
php spark migrate
```

### 6. Jalankan Seeder
```bash
php spark db:seed UserSeeder
php spark db:seed CategorySeeder
```

### 7. Buat Folder Upload
```bash
mkdir -p public/uploads/thumbnails
```

### 8. Jalankan Server
```bash
php spark serve
```

Akses di browser: `http://localhost:8080`

---

## 👤 Akun Admin Default

| Field | Value |
|-------|-------|
| Email | admin@blog.com |
| Password | admin123 |

---

## 📁 Struktur Project

```
project3/
├── app/
│   ├── Controllers/
│   │   ├── Admin/
│   │   │   ├── DashboardController.php
│   │   │   ├── PostController.php
│   │   │   └── CategoryController.php
│   │   ├── AuthController.php
│   │   └── BlogController.php
│   ├── Models/
│   │   ├── UserModel.php
│   │   ├── PostModel.php
│   │   └── CategoryModel.php
│   ├── Views/
│   │   ├── admin/
│   │   │   ├── layout.php
│   │   │   ├── dashboard.php
│   │   │   ├── posts/
│   │   │   └── categories/
│   │   ├── auth/
│   │   │   └── login.php
│   │   └── blog/
│   │       ├── layout.php
│   │       ├── index.php
│   │       └── detail.php
│   ├── Database/
│   │   ├── Migrations/
│   │   └── Seeds/
│   └── Filters/
│       └── AuthFilter.php
└── public/
    └── uploads/
        └── thumbnails/
```

---

## 🎥 Demo Video

[Link Google Drive](https://drive.google.com/your-link-here)

---

## 👨‍💻 Identitas Mahasiswa

| Field | Keterangan |
|-------|-----------|
| **Nama** | Hanan Ahmad Alfaruqi |
| **NIM** | 20260015 |
| **Mata Kuliah** | Pengembangan Aplikasi Web Framework |
| **Framework** | CodeIgniter 4 |
| **GitHub** | [hananalfaruq](https://github.com/hananalfaruq) |
