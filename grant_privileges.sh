#!/bin/bash
set -euo pipefail
MYSQL_ROOT_PWD="TempRootPass!ChangeMe"
DB_NAME="phpmyadmin_db"

USERS=("Kiboauto_2025_admin" "pmadbuser")
for u in "${USERS[@]}"; do
  echo "Granting ALL privileges on ${DB_NAME} to ${u}..."
  sudo mysql -uroot -p"${MYSQL_ROOT_PWD}" -e "GRANT ALL PRIVILEGES ON \`${DB_NAME}\`.* TO '${u}'@'localhost'; FLUSH PRIVILEGES;"
  echo "SHOW GRANTS for ${u}@localhost:"
  sudo mysql -uroot -p"${MYSQL_ROOT_PWD}" -e "SHOW GRANTS FOR '${u}'@'localhost';"
done
