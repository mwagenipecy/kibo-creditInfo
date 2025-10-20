#!/bin/bash
# Run on the remote Azure VM to perform basic verification checks.

echo "Web root: /var/www/kiboauto"
echo "Listing files (first 20 lines):"
ls -la /var/www/kiboauto | head -n 20

echo
echo "Ownership of web root:"
stat -c '%U:%G %n' /var/www/kiboauto || stat -f '%Su:%Sg %N' /var/www/kiboauto || true

echo
echo "Check storage and bootstrap cache perms:"
ls -la /var/www/kiboauto/storage | head -n 20 || true
ls -la /var/www/kiboauto/bootstrap/cache | head -n 20 || true

echo
echo "PHP-FPM status (if present):"
if systemctl list-units --type=service | grep -q php; then
  systemctl status php*-fpm --no-pager || true
else
  echo "php-fpm not managed by systemctl or not found"
fi

echo
if command -v mysql >/dev/null 2>&1; then
  echo "Testing MySQL connection to 40.127.10.196:"
  mysql -h 40.127.10.196 -u Kiboauto_2025_admin -p -e "SHOW DATABASES LIKE 'kibo_19';"
else
  echo "mysql client not installed. Install or run manual test."
fi

echo "Done."
