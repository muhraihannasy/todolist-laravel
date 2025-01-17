# Dokumentasi Endpoint API Laravel

Ini adalah informasi tentang cara menguji API menggunakan Postman dengan header yang benar serta contoh endpoint.

---

## Teknologi yang Digunakan

-   **Framework Backend**: Laravel
-   **Database**: MySQL

---

## Persyaratan

Sebelum menguji atau menggunakan API, pastikan Anda telah menginstal:

-   PHP (>=8.2)
-   Composer
-   Database MySQL
-   Postman (atau alat pengujian API lainnya)

---

### Header

Pastikan untuk menyertakan header berikut di semua permintaan API Anda:

-   **Accept**: `application/json`
-   **Content-Type**: `application/json`

Contoh:

```
Accept: application/json
Content-Type: application/json
```

### Autentikasi

Jika API memerlukan autentikasi, sertakan header berikut:

```
Authorization: Bearer <your-access-token>
```

---

## Endpoint API yang Tersedia

### 1. Endpoint Autentikasi

#### a. Login

**Endpoint**: `POST /api/auth/login`

**Body Permintaan**:

```json
{
    "email": "user@example.com",
    "password": "password123"
}
```

**Contoh Respons**:

```json
{
    "success": true,
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2F1dGgvcmVnaXN0ZXIiLCJpYXQiOjE3MzcxMTAwMzYsImV4cCI6MTczNzExMzYzNiwibmJmIjoxNzM3MTEwMDM2LCJqdGkiOiJ6dUNNMHRPOWZuZXFiMEpxIiwic3ViIjoiMTAiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.y8T40xTpEwzMxX15jowtfePmEZZQj9JIM6lNaRYskGU",
    "token_type": "bearer",
    "expires_in": 3600
}
```

#### b. Register

**Endpoint**: `POST /api/auth/register`

**Body Permintaan**:

```json
{
    "name": "User Name",
    "email": "user@example.com",
    "password": "password123"
}
```

**Contoh Respons**:

```json
{
    "success": true,
    "message": "User created successfully",
    "data": {
        "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2F1dGgvcmVnaXN0ZXIiLCJpYXQiOjE3MzcxMTAwMzYsImV4cCI6MTczNzExMzYzNiwibmJmIjoxNzM3MTEwMDM2LCJqdGkiOiJ6dUNNMHRPOWZuZXFiMEpxIiwic3ViIjoiMTAiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.y8T40xTpEwzMxX15jowtfePmEZZQj9JIM6lNaRYskGU",
        "token_type": "bearer",
        "user": {
            "name": "User Name",
            "email": "user@example.com",
            "uuid": "7e094ed4-e9e6-4fae-9f22-e2b1204d44e3",
            "updated_at": "2025-01-17T10:33:55.000000Z",
            "created_at": "2025-01-17T10:33:55.000000Z",
            "id": 10
        }
    }
}
```

#### c. Logout

**Endpoint**: `POST /api/auth/logout`

**Contoh Respons**:

```json
{
    "success": true,
    "message": "Successfully logged out"
}
```

### 2. Endpoint Checklist

#### a. Mendapatkan Semua Checklist

**Endpoint**: `GET /api/checklists`

**Contoh Respons**:

```json
{
    "success": true,
    "message": "Success get data",
    "data": [
        {
            "id": 1,
            "uuid": "76fcc9d8-66ac-402a-877c-c248b4d70889",
            "user_id": 1,
            "name": "Belajar Python",
            "sequence": 3,
            "background-color": "#FFFFFF2",
            "description": "asd",
            "created_at": "2025-01-17T09:40:15.000000Z",
            "updated_at": "2025-01-17T09:54:00.000000Z",
            "deleted_at": null,
            "checklist_items": [
                {
                    "id": 1,
                    "checklist_id": 1,
                    "uuid": "c24b465c-9c8a-46f6-97f7-be38db151cfa",
                    "name": "Belajar Nest JS",
                    "sequence": 0,
                    "is_checked": 1,
                    "created_at": "2025-01-17T10:03:29.000000Z",
                    "updated_at": "2025-01-17T10:16:46.000000Z",
                    "deleted_at": null
                }
            ]
        }
    ]
}
```

#### b. Membuat Checklist Baru

**Endpoint**: `POST /api/checklists`

**Body Permintaan**:

```json
{
    "name": "Belajar Nest JS",
    "background-color": "#FFFFFF",
    "description": "Oke"
}
```

**Contoh Respons**:

```json
{
    "success": true,
    "message": "Success create data",
    "data": {
        "name": "Belajar Nest JS",
        "background-color": "#FFFFFF",
        "description": "Oke",
        "user_id": 1,
        "uuid": "81f555da-5b85-4b9a-bada-e32ba421a4d9",
        "updated_at": "2025-01-17T09:55:16.000000Z",
        "created_at": "2025-01-17T09:55:16.000000Z",
        "id": 2
    }
}
```

#### c. Mendapatkan Detail Checklist

**Endpoint**: `GET /api/checklists/{uuid}`

**Contoh Respons**:

```json
{
    "success": true,
    "message": "Success get data",
    "data": {
        "id": 1,
        "uuid": "76fcc9d8-66ac-402a-877c-c248b4d70889",
        "user_id": 1,
        "name": "Belajar Python",
        "sequence": 3,
        "background-color": "#FFFFFF2",
        "description": "asd",
        "created_at": "2025-01-17T09:40:15.000000Z",
        "updated_at": "2025-01-17T09:54:00.000000Z",
        "deleted_at": null,
        "checklist_items": [
            {
                "id": 1,
                "checklist_id": 1,
                "uuid": "c24b465c-9c8a-46f6-97f7-be38db151cfa",
                "name": "Belajar Nest JS",
                "sequence": 0,
                "is_checked": 0,
                "created_at": "2025-01-17T10:03:29.000000Z",
                "updated_at": "2025-01-17T10:03:29.000000Z",
                "deleted_at": null
            },
            {
                "id": 2,
                "checklist_id": 1,
                "uuid": "66b22fc6-fdcc-4878-9eae-37557ed8287f",
                "name": "Belajar Python",
                "sequence": 2,
                "is_checked": 0,
                "created_at": "2025-01-17T10:05:52.000000Z",
                "updated_at": "2025-01-17T10:07:23.000000Z",
                "deleted_at": null
            }
        ]
    }
}
```

#### d. Memperbarui Checklist

**Endpoint**: `PATCH /api/checklists/{uuid}`

**Body Permintaan**:

```json
{
    "name": "Belajar Python",
    "background-color": "#FFFFFF2",
    "description": "asd",
    "sequence": 3
}
```

**Contoh Respons**:

```json
{
    "success": true,
    "message": "Success create data",
    "data": {
        "name": "Belajar Python",
        "background-color": "#FFFFFF2",
        "description": "asd",
        "sequence": 3
    }
}
```

#### e. Menghapus Checklist

**Endpoint**: `DELETE /api/checklists/{uuid}`

**Contoh Respons**:

```json
{
    "success": true,
    "message": "Checklist deleted successfully"
}
```

---

### 3. Endpoint Checklist Item

#### a. Mendapatkan Semua Item Checklist

**Endpoint**: `GET /api/checklist-items`

**Contoh Respons**:

```json
{
    "success": true,
    "message": "Success get data",
    "data": [
        {
            "id": 1,
            "checklist_id": 1,
            "uuid": "c24b465c-9c8a-46f6-97f7-be38db151cfa",
            "name": "Belajar Nest JS",
            "sequence": 0,
            "is_checked": 0,
            "created_at": "2025-01-17T10:03:29.000000Z",
            "updated_at": "2025-01-17T10:03:29.000000Z",
            "deleted_at": null
        }
    ]
}
```

#### b. Membuat Item Checklist Baru

**Endpoint**: `POST /api/checklist-items`

**Body Permintaan**:

```json
{
    "checklist_id": "1",
    "name": "Interview Coding"
}
```

**Contoh Respons**:

```json
{
    "success": true,
    "message": "Success create data",
    "data": {
        "checklist_id": "1",
        "name": "Interview Coding",
        "uuid": "66b22fc6-fdcc-4878-9eae-37557ed8287f",
        "updated_at": "2025-01-17T10:05:52.000000Z",
        "created_at": "2025-01-17T10:05:52.000000Z",
        "id": 2
    }
}
```

#### c. Memperbarui Checklist Item

**Endpoint**: `POST /api/checklist-items/{uuid}`

**Body Permintaan**:

```json
{
    "name": "Belajar Golang",
    "sequence": 2
}
```

**Contoh Respons**:

```json
{
    "success": true,
    "message": "Success create data",
    "data": {
        "name": "Belajar Golang",
        "sequence": 2
    }
}
```

#### c. Memperbarui Status Checklist Item

**Endpoint**: `PATCH /api/checklist-items/{uuid}/change-status`

**Body Permintaan**:

```json
{
    "is_checked": true
}
```

**Contoh Respons**:

```json
{
    "success": true,
    "message": "Success create data",
    "data": {
        "id": 1,
        "checklist_id": 1,
        "uuid": "c24b465c-9c8a-46f6-97f7-be38db151cfa",
        "name": "Belajar Nest JS",
        "sequence": 0,
        "is_checked": 1,
        "created_at": "2025-01-17T10:03:29.000000Z",
        "updated_at": "2025-01-17T10:16:46.000000Z",
        "deleted_at": null
    }
}
```

#### d. Mendapatkan Detail Cheklist

**Endpoint**: `GET /api/checklist-items/{uuid}`

**Contoh Respons**:

```json
{
    "success": true,
    "message": "Success get data",
    "data": {
        "id": 1,
        "checklist_id": 1,
        "uuid": "c24b465c-9c8a-46f6-97f7-be38db151cfa",
        "name": "Belajar Nest JS",
        "sequence": 0,
        "is_checked": 1,
        "created_at": "2025-01-17T10:03:29.000000Z",
        "updated_at": "2025-01-17T10:16:46.000000Z",
        "deleted_at": null
    }
}
```

#### e. Menghapus Cheklist

**Endpoint**: `DELETE /api/checklist-items/{uuid}`

**Contoh Respons**:

```json
{
    "success": true,
    "message": "Success delete data"
}
```
