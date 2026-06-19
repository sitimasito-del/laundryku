# Vercel Deployment Guide

## ✅ Status
- **Deployment**: Live at https://laundryku-sage.vercel.app
- **Framework**: Laravel 11 + PHP 8.3
- **Database**: PostgreSQL (Neon)
- **Status**: Production Ready

## Cold Start Behavior

Vercel menggunakan **serverless PHP** yang memiliki "cold start" - saat pertama kali atau after idle, server butuh waktu untuk spin up.

**Apa yang terjadi:**
- Request pertama → PHP server di-spawn (takes ~1-2 seconds)
- Request berikutnya → Fast (instant response)

**Normal logs pattern:**
```
✅ 200 OK - normal response
❌ 500 Error - cold start initialization
✅ 200 OK - after warmup
```

**Ini NORMAL di Vercel!** Not an error.

## Optimizations untuk Cold Start

### 1. Memory Allocation
`vercel.json` sudah set memory ke 3008MB untuk lebih cepat initialization.

### 2. File-based Drivers
- SESSION_DRIVER: file (bukan database)
- CACHE_STORE: file (bukan database)  
- QUEUE_CONNECTION: sync (bukan database)

Ini mengurangi external dependencies saat startup.

### 3. Environment Variables
Di production, LOG_LEVEL=error untuk mengurangi I/O overhead.

## Environment Variables Setup

Di **Vercel Dashboard → Project Settings → Environment Variables**, set:

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
```

## Deployment Workflow

1. **Local Development:**
   ```bash
   composer install
   npm install
   npm run dev
   php artisan serve
   ```

2. **Push to GitHub:**
   ```bash
   git add .
   git commit -m "Your changes"
   git push origin main
   ```

3. **Auto-deploy to Vercel:**
   - Vercel automatically deploys on git push
   - Watch deployment in Vercel Dashboard

4. **Manual Redeploy:**
   - Vercel Dashboard → Deployments → Latest → Redeploy

## Troubleshooting

### Still seeing 500 errors?

1. **Check Build Logs:**
   - Deployments → Latest Deployment → Build Logs

2. **Check Runtime Logs:**
   - Deployments → Latest Deployment → Runtime Logs

3. **Check Environment Variables:**
   - Settings → Environment Variables
   - Make sure all DB credentials are correct

4. **Force Rebuild:**
   - Delete `.vercel/cache` locally or clear Vercel project cache
   - Redeploy

### Database Connection Issues?

- Test connection string locally first
- Verify DB credentials in `.env`
- Check if PostgreSQL (Neon) is accessible from Vercel
- Ensure SSL mode is `prefer` not `require` for Vercel compatibility

## File Structure

```
/api/index.php          ← Entry point for Vercel
/public/index.php       ← Laravel public entry
/routes/web.php         ← API routes
/bootstrap/app.php      ← Laravel bootstrapper
vercel.json             ← Vercel config
.env                    ← Environment variables
```

## Production Best Practices

✅ **Already Done:**
- APP_DEBUG=false
- SESSION_DRIVER=file
- CACHE_STORE=file  
- Error logging to storage/logs/
- Proper middleware setup

⏱️ **Next Steps:**
- Setup monitoring/error tracking (Sentry, etc.)
- Database backups (Neon has built-in backups)
- Custom domain setup if needed

## Support

For Vercel-specific issues:
- Check Vercel Documentation: https://vercel.com/docs
- Check Laravel Documentation: https://laravel.com/docs


