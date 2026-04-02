#!/bin/bash
set -e

echo "Running migrations..."
php artisan migrate --force

echo "Clearing cache..."
php artisan optimize:clear

echo "Caching config..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Done!"
```

---

## Step 3: Go to Railway → Your Laravel App Service → Settings

Scroll to **Deploy** section → find **"Pre-Deploy Command"** → paste this:
```
chmod +x ./railway/init-app.sh && sh ./railway/init-app.sh
