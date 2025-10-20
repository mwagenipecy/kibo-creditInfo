echo "SHOW GRANTS FOR Kiboauto_2025_admin@localhost:"
sudo mysql -uroot -p"${MYSQL_ROOT_PWD}" -e "SHOW GRANTS FOR 'Kiboauto_2025_admin'@'localhost';"
echo "SHOW DATABASES LIKE 'kibo_19':"
sudo mysql -uroot -p"${MYSQL_ROOT_PWD}" -e "SHOW DATABASES LIKE 'kibo_19';"
#!/bin/bash
set -euo pipefail
MYSQL_ROOT_PWD="TempRootPass!ChangeMe"

DB="kibo_19"
USER="Kiboauto_2025_admin"
PASS="kiboAuto_2025"

echo "Creating database ${DB} (if not exists)..."
sudo mysql -uroot -p"${MYSQL_ROOT_PWD}" -e "CREATE DATABASE IF NOT EXISTS \`${DB}\`;"

echo "Ensure user ${USER} exists and set password..."
# Create user if not exists, then ensure password is set (ALTER USER works if user exists)
sudo mysql -uroot -p"${MYSQL_ROOT_PWD}" -e "CREATE USER IF NOT EXISTS '${USER}'@'localhost' IDENTIFIED BY '${PASS}'; ALTER USER '${USER}'@'localhost' IDENTIFIED BY '${PASS}';"

echo "Granting ALL privileges on ${DB} to ${USER}..."
sudo mysql -uroot -p"${MYSQL_ROOT_PWD}" -e "GRANT ALL PRIVILEGES ON \`${DB}\`.* TO '${USER}'@'localhost'; FLUSH PRIVILEGES;"

echo "SHOW GRANTS FOR ${USER}@localhost:"
sudo mysql -uroot -p"${MYSQL_ROOT_PWD}" -e "SHOW GRANTS FOR '${USER}'@'localhost';"

echo "SHOW DATABASES LIKE '${DB}':"
sudo mysql -uroot -p"${MYSQL_ROOT_PWD}" -e "SHOW DATABASES LIKE '${DB}';"
