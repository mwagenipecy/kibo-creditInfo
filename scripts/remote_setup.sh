#!/bin/bash
# Remote setup to be executed on the Azure VM (reads files from /tmp/kiboauto-deploy)
# This script expects to be run by a sudo-capable user (azureuser) and will use sudo where needed.

DEPLOY_DIR="/tmp/kiboauto-deploy"
TARBALL="/tmp/kiboauto-deploy.tar.gz"
TARGET_DIR="/var/www/kiboauto"

if [ -d "$DEPLOY_DIR" ]; then
  echo "Found deploy directory $DEPLOY_DIR"
elif [ -f "$TARBALL" ]; then
  echo "Found tarball $TARBALL — extracting to /tmp"
  mkdir -p /tmp/kiboauto-deploy
  tar -xzf "$TARBALL" -C /tmp/kiboauto-deploy
else
  echo "Neither $DEPLOY_DIR nor $TARBALL found. Exiting."
  exit 1
fi

echo "Creating target dir: $TARGET_DIR"
sudo mkdir -p "$TARGET_DIR"

echo "Copying files to $TARGET_DIR"
sudo rsync -a --delete "$DEPLOY_DIR/" "$TARGET_DIR/"

echo "Setting ownership to www-data:www-data"
sudo chown -R www-data:www-data "$TARGET_DIR"

echo "Ensure correct permissions on storage and bootstrap cache"
sudo chown -R www-data:www-data "$TARGET_DIR/storage" "$TARGET_DIR/bootstrap/cache" || true
sudo chmod -R 775 "$TARGET_DIR/storage" "$TARGET_DIR/bootstrap/cache" || true

echo "Switch to project directory"
cd "$TARGET_DIR"

# If a .env is missing, create one from example (do NOT overwrite existing .env)
if [ ! -f .env ]; then
  if [ -f .env.production.example ]; then
    echo "Creating .env from .env.production.example"
    sudo cp .env.production.example .env
    sudo chown www-data:www-data .env
    sudo chmod 640 .env
  else
    echo ".env not found and .env.production.example missing — you must create .env manually"
  fi
fi

if [ -f composer.json ]; then
  echo "Installing PHP dependencies (composer)"
  if command -v composer >/dev/null 2>&1; then
    sudo -u www-data composer install --no-interaction --prefer-dist --optimize-autoloader
  else
    echo "composer not found. Please install composer on the server or run this step manually."
  fi
fi

echo "Running artisan migrations and caches as www-data"
sudo -u www-data php artisan migrate --force || echo "Migrations failed or none to run"
sudo -u www-data php artisan config:cache || true
sudo -u www-data php artisan route:cache || true
sudo -u www-data php artisan view:cache || true

echo "Restarting PHP-FPM and web server"
# Try common php-fpm service patterns
PHP_FPM_RESTARTED=false
for svc in php-fpm php7.4-fpm php8.0-fpm php8.1-fpm php8.2-fpm; do
  if systemctl list-units --type=service | grep -q "$svc"; then
    sudo systemctl restart "$svc" || true
    PHP_FPM_RESTARTED=true
  fi
done
if [ "$PHP_FPM_RESTARTED" = false ]; then
  echo "No common php-fpm service found via systemctl. Attempting service restart by pattern."
  sudo systemctl --type=service | grep php | awk '{print $1}' | while read s; do sudo systemctl restart "$s" || true; done
fi

# Restart web server
if systemctl list-units --type=service | grep -q nginx; then
  sudo systemctl restart nginx || true
fi
if systemctl list-units --type=service | grep -q apache2; then
  sudo systemctl restart apache2 || true
fi

echo "Cleanup: remove deploy temp dir"
sudo rm -rf "$DEPLOY_DIR"

echo "Remote setup complete."
