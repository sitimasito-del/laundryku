# Vercel Environment Variables Setup

Untuk production di Vercel, set environment variables di **Project Settings → Environment Variables**:

## Required Variables

```
APP_NAME=Laundryku
APP_ENV=production
APP_KEY=base64:4EdSXXSOW0TqyoGf5G08GMvHY3Ub96mMYrEF9+XWAo0=
APP_DEBUG=false
APP_URL=https://laundryku-sage.vercel.app

DB_CONNECTION=pgsql
DB_HOST=ep-morning-wave-ao5l57qk.c-2.ap-southeast-1.aws.neon.tech
DB_PORT=5432
DB_DATABASE=neondb
DB_USERNAME=neondb_owner
DB_PASSWORD=npg_PgSGpRQ0Hd8r
DB_SSLMODE=prefer

SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync

LOG_CHANNEL=stack
LOG_LEVEL=error
```

## Important Notes

1. **APP_URL**: HARUS URL yang valid dengan protocol (https://). Jangan gunakan syntax placeholder.
   - ✅ Correct: `https://laundryku-sage.vercel.app`
   - ❌ Wrong: `${VERCEL_URL:http://localhost}`

2. **APP_DEBUG**: Set ke `false` untuk production. Jika debugging error, ubah ke `true` dan redeploy.

3. **Database**: Pastikan semua DB_* credentials benar dari Neon dashboard.

4. **File Drivers**: SESSION_DRIVER dan CACHE_STORE menggunakan file, bukan database untuk Vercel compatibility.

## Steps to Set Environment Variables

1. Buka Vercel Dashboard
2. Pilih project "laundryku"
3. Klik **Settings**
4. Pilih **Environment Variables** (di sidebar sebelah kiri)
5. Klik **Add New**
6. Masukkan setiap variable dari list di atas
7. Pilih production environment
8. Klik **Save**
9. Kembali ke **Deployments**
10. Klik tiga titik pada deployment terakhir → **Redeploy**

Tunggu deployment selesai (hijau status ✅)

## Testing

Setelah redeploy, buka: https://laundryku-sage.vercel.app/

Seharusnya menampilkan: **LARAVEL BERHASIL**

## If Still Getting Errors

1. Check **Runtime Logs** di deployment details
2. Verify semua env variables sudah di-set dengan benar (jangan typo)
3. Redeploy ulang setelah update env variables
