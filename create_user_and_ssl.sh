#!/bin/bash
set -euo pipefail
DB_USER="Kiboauto_2025_admin"
DB_PASS="kiboAuto_2025"
DB_NAME="phpmyadmin_db"
MYSQL_ROOT_PWD="TempRootPass!ChangeMe"

echo "Creating MySQL user ${DB_USER}..."
sudo mysql -uroot -p"${MYSQL_ROOT_PWD}" -e "CREATE USER IF NOT EXISTS '${DB_USER}'@'localhost' IDENTIFIED BY '${DB_PASS}'; GRANT ALL PRIVILEGES ON \`${DB_NAME}\`.* TO '${DB_USER}'@'localhost'; FLUSH PRIVILEGES;"

# Create SSL cert
SSL_DIR="/etc/ssl/kibo"
sudo mkdir -p ${SSL_DIR}
sudo openssl req -x509 -nodes -days 365 -newkey rsa:2048 -subj '/CN=40.127.10.196' -keyout ${SSL_DIR}/kibo.key -out ${SSL_DIR}/kibo.crt
sudo chmod 600 ${SSL_DIR}/kibo.key

APACHE_SSL_CONF="/etc/apache2/sites-available/phpmyadmin-ssl.conf"
sudo tee ${APACHE_SSL_CONF} > /dev/null <<'APACHE'
<IfModule mod_ssl.c>
    <VirtualHost *:443>
        ServerName 40.127.10.196
        DocumentRoot /usr/share/phpmyadmin

        SSLEngine on
        SSLCertificateFile /etc/ssl/kibo/kibo.crt
        SSLCertificateKeyFile /etc/ssl/kibo/kibo.key

        <Directory /usr/share/phpmyadmin>
            Options Indexes FollowSymLinks
            DirectoryIndex index.php
            AllowOverride All
            Require all granted
        </Directory>

        ErrorLog ${APACHE_LOG_DIR}/phpmyadmin_error.log
        CustomLog ${APACHE_LOG_DIR}/phpmyadmin_access.log combined
    </VirtualHost>
</IfModule>
APACHE

sudo a2enmod ssl
sudo a2ensite phpmyadmin-ssl

# Append redirect for /phpmyadmin in default site
sudo bash -c 'cat >> /etc/apache2/sites-available/000-default.conf' <<'REDIRECT'
    <Location /phpmyadmin>
        RewriteEngine On
        RewriteCond %{HTTPS} !=on
        RewriteRule ^ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
    </Location>
REDIRECT

sudo a2enmod rewrite
sudo systemctl restart apache2

echo "USER_CREATED=${DB_USER}"
echo "USER_PASS=${DB_PASS}"
