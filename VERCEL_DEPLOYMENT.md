# Vercel Deployment Checklist

## Error 500 Troubleshooting

HTTP Error 500 biasanya disebabkan oleh salah satu dari hal berikut:

### 1. **Environment Variables Tidak Di-Set di Vercel**
Di Vercel Dashboard, pastikan semua env variables sudah di-set di project settings:

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
DB_SSLMODE=require

LOG_CHANNEL=stack
LOG_LEVEL=error

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
```

### 2. **Database Connection**
- Pastikan database host bisa diakses dari Vercel (database harus accessible dari internet)
- Test connection string secara manual
- Pastikan firewall/security group mengizinkan koneksi dari Vercel

### 3. **Check Build Logs**
- Buka Vercel Dashboard → Project → Deployments
- Clik pada deployment yang gagal
- Lihat "Build Logs" untuk error details
- Lihat "Runtime Logs" untuk runtime errors

### 4. **Manual Testing**
Jalankan command ini di local untuk test:
```bash
APP_ENV=production php artisan config:cache
APP_ENV=production php artisan route:cache
php artisan serve
```

### 5. **Force Redeploy**
Jika sudah update env variables:
1. Buka Vercel Dashboard
2. Pilih project
3. Klik "Deployments" → pilih latest
4. Klik tiga titik (...) → "Redeploy"
5. Tunggu deployment selesai

## Setup Pertama Kali

1. Push code ke GitHub
2. Import project ke Vercel
3. Set semua environment variables (lihat di atas)
4. Deploy
5. Cek logs jika ada error

## Environment Variables Explanation

- `APP_KEY`: Dari `.env` file (jangan ubah)
- `DB_*`: Database credentials dari Neon
- `SESSION_DRIVER=database`: Perlu database untuk session
- `CACHE_STORE=database`: Perlu database untuk cache
