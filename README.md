# Dokumentasi API Laravel + MySQL

Dokumen ini memberikan panduan dan instruksi untuk bekerja dengan API Laravel + MySQL. Termasuk informasi tentang cara menguji API menggunakan Postman dengan header yang benar serta contoh endpoint.

---

## Teknologi yang Digunakan

-   **Framework Backend**: Laravel
-   **Database**: MySQL

---

## Persyaratan

Sebelum menguji atau menggunakan API, pastikan Anda telah menginstal:

-   PHP (>=8.0)
-   Composer
-   Database MySQL
-   Postman (atau alat pengujian API lainnya)

---

## Menyiapkan Proyek

1. Clone repositori:

    ```bash
    git clone <repository-url>
    ```

2. Masuk ke direktori proyek:

    ```bash
    cd <project-folder>
    ```

3. Instal dependensi:

    ```bash
    composer install
    ```

4. Salin file `.env`:

    ```bash
    cp .env.example .env
    ```

5. Konfigurasikan database di file `.env`:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=<nama-database-anda>
    DB_USERNAME=<username-anda>
    DB_PASSWORD=<password-anda>
    ```

6. Jalankan migrasi untuk membuat tabel database:

    ```bash
    php artisan migrate
    ```

7. Hasilkan application key:

    ```bash
    php artisan key:generate
    ```

8. Jalankan server pengembangan:

    ```bash
    php artisan serve
    ```

    Aplikasi akan tersedia di `http://127.0.0.1:8000` secara default.

---

## Menguji API dengan Postman

### Header

Pastikan untuk menyertakan header berikut di semua permintaan API Anda:

-   **Accept**: `application/json`
-   **Content-Type**: `application/json`

Contoh:

```
Accept: application/json
Content-Type: application/json
```

### Autentikasi (Opsional)

Jika API memerlukan autentikasi, sertakan header berikut:

```
Authorization: Bearer <your-access-token>
```

---

## Endpoint API yang Tersedia

### 1. Endpoint Checklist

#### a. Mendapatkan Semua Checklist

**Endpoint**: `GET /api/checklists`

**Contoh Respons**:

```json
{
    "success": true,
    "data": [
        {
            "uuid": "123e4567-e89b-12d3-a456-426614174000",
            "name": "My Checklist",
            "created_at": "2025-01-17T10:00:00.000000Z",
            "updated_at": "2025-01-17T10:00:00.000000Z"
        }
    ]
}
```

#### b. Membuat Checklist Baru

**Endpoint**: `POST /api/checklists`

**Body Permintaan**:

```json
{
    "name": "My New Checklist"
}
```

**Contoh Respons**:

```json
{
    "success": true,
    "message": "Checklist created successfully",
    "data": {
        "uuid": "123e4567-e89b-12d3-a456-426614174001",
        "name": "My New Checklist",
        "created_at": "2025-01-17T11:00:00.000000Z",
        "updated_at": "2025-01-17T11:00:00.000000Z"
    }
}
```

#### c. Mendapatkan Detail Checklist

**Endpoint**: `GET /api/checklists/{uuid}`

**Contoh Respons**:

```json
{
    "success": true,
    "data": {
        "uuid": "123e4567-e89b-12d3-a456-426614174000",
        "name": "My Checklist",
        "created_at": "2025-01-17T10:00:00.000000Z",
        "updated_at": "2025-01-17T10:00:00.000000Z"
    }
}
```

---

## Penanganan Error

### Error Validasi (422)

Jika data yang dikirimkan tidak valid, API akan merespons dengan status kode **422 Unprocessable Entity**:

**Contoh Respons**:

```json
{
    "success": false,
    "message": "Validation error",
    "errors": {
        "email": ["The email has already been taken."]
    }
}
```

### Error Umum (500)

Untuk kesalahan yang tidak terduga, API akan merespons dengan status kode **500 Internal Server Error**:

**Contoh Respons**:

```json
{
    "success": false,
    "message": "An unexpected error occurred. Please try again later.",
    "data": null
}
```

---

## Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).
