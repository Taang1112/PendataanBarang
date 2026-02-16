#!/bin/sh

# Tunggu DB siap dulu (5 detik)
echo "Menunggu database..."
sleep 5

# Run migration & seeder aman
echo "Menjalankan migration..."
php artisan migrate --force

# Jalankan Apache
echo "Menjalankan Apache..."
apache2-foreground
