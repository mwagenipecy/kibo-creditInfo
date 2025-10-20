#!/bin/bash
set -euo pipefail
export DEBIAN_FRONTEND=noninteractive

# Variables (change these after setup)
DB_NAME="phpmyadmin_db"
DB_USER="pmadbuser"
DB_PASS="PmAUserPass!ChangeMe"
MYSQL_ROOT_PWD="TempRootPass!ChangeMe"
PHPM_ADMIN_PASS="PhpMyAdminPass!ChangeMe"

echo "Updating apt and installing packages..."
sudo apt-get update -y
sudo apt-get install -y apache2 wget unzip curl software-properties-common
sudo apt-get install -y mysql-server
sudo systemctl enable --now mysql

# Set MySQL root password and switch to mysql_native_password if needed
# Use sudo mysql (socket) to run commands as root without password
echo "Configuring MySQL root user..."
sudo mysql -e "ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY '${MYSQL_ROOT_PWD}'; FLUSH PRIVILEGES;"

# Create database and user
echo "Creating database and user..."
sudo mysql -uroot -p"${MYSQL_ROOT_PWD}" -e "CREATE DATABASE IF NOT EXISTS \`${DB_NAME}\` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci; CREATE USER IF NOT EXISTS '${DB_USER}'@'localhost' IDENTIFIED BY '${DB_PASS}'; GRANT ALL PRIVILEGES ON \`${DB_NAME}\`.* TO '${DB_USER}'@'localhost'; FLUSH PRIVILEGES;"

# Install PHP and extensions
echo "Installing PHP and extensions..."
sudo apt-get install -y php libapache2-mod-php php-mbstring php-zip php-gd php-json php-curl php-mysql

# Preseed phpMyAdmin debconf answers to make installation non-interactive
echo "Preseeding phpMyAdmin answers..."
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/dbconfig-install boolean true"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/app-password-confirm password ${PHPM_ADMIN_PASS}"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/admin-pass password ${MYSQL_ROOT_PWD}"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/app-pass password ${PHPM_ADMIN_PASS}"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/reconfigure-webserver multiselect apache2"

# Install phpMyAdmin
echo "Installing phpMyAdmin..."
sudo apt-get install -y phpmyadmin

# Enable Apache modules and restart
echo "Enabling Apache modules and restarting service..."
sudo a2enmod rewrite
sudo systemctl restart apache2

# Print summary and credentials
echo "SETUP_COMPLETE"
echo "DB_NAME=${DB_NAME}"
echo "DB_USER=${DB_USER}"
echo "DB_PASS=${DB_PASS}"
echo "MYSQL_ROOT_PWD=${MYSQL_ROOT_PWD}"
echo "PHPMYADMIN_APP_PASS=${PHPM_ADMIN_PASS}"

echo "phpMyAdmin should be available at http://$(hostname -I | awk '{print $1}')/phpmyadmin or http://$(hostname -f)/phpmyadmin if DNS is configured."
