Deployment steps for Azure VM

Prerequisites

-   You have the private key file: KiboAutosever_key.pem (place in project root or provide full path).
-   SSH access: azureuser@40.127.10.196
-   Database: kibo_19 on host 40.127.10.196, user Kiboauto_2025_admin, password kiboAuto_2025
-   Domain: kiboauto.co.tz

Quick PowerShell (Windows) commands

# Copy key to your user profile (optional) and set permissions (on Windows the permission step is informational):

Copy-Item .\KiboAutosever_key.pem $env:USERPROFILE\.ssh\KiboAutosever_key.pem

# SSH into server (PowerShell):

ssh -i "C:\Users\<you>\.ssh\KiboAutosever_key.pem" azureuser@40.127.10.196

# From project root on your machine, run the deploy script (uses rsync):

bash ./scripts/deploy_to_azure.sh "C:\Users\<you>\.ssh\KiboAutosever_key.pem" azureuser@40.127.10.196

Windows (PowerShell) deploy (no rsync required)

From the repository root, run the PowerShell deploy helper which will create an archive and upload it via scp, then trigger the remote setup:

PowerShell example:

powershell -ExecutionPolicy Bypass -File .\scripts\deploy_windows.ps1 -KeyPath "C:\Users\<you>\.ssh\KiboAutosever_key.pem" -Remote "azureuser@40.127.10.196"

Notes:

-   The PowerShell script prefers 7-Zip if installed to produce a tar.gz. If not available it will create a zip and upload it; the remote extraction step supports both zip and tar.gz.
-   The remote setup script will look for either `/tmp/kiboauto-deploy` (rsync flow) or `/tmp/kiboauto-deploy.tar.gz` or `/tmp/kiboauto-deploy.zip` (PowerShell flow) and extract accordingly.

Notes and important corrections

-   Your `.env` file currently had DB_HOST set to the phpMyAdmin URL (https://40.127.10.196/phpmyadmin/). This is incorrect for DB_HOST. Use the IP/hostname (40.127.10.196) and port 3306. See `.env.production.example` for recommended values.
-   The web root on the server should be `/var/www/kiboauto`. The remote setup script sets ownership with `sudo chown -R www-data:www-data /var/www/kiboauto`.
-   phpMyAdmin is available at https://40.127.10.196/phpmyadmin/ (use the DB credentials above).

Verification checklist

1. SSH into server:
   ssh -i "~/.ssh/KiboAutosever_key.pem" azureuser@40.127.10.196
2. Check files in web root and ownership:
   ls -la /var/www/kiboauto
   sudo stat -c '%U:%G' /var/www/kiboauto
3. Ensure storage writable:
   sudo -u www-data php /var/www/kiboauto/artisan tinker --execute "Storage::put('kibo-deploy-test','ok')" || true
4. Test DB connectivity from server (replace with mysql client if installed):
   mysql -h 40.127.10.196 -P 3306 -u Kiboauto_2025_admin -p
5. Visit site: https://kiboauto.co.tz (ensure DNS A record points to 40.127.10.196)

If you want me to update the project's `.env` file or `config/app.php` APP_URL automatically, tell me and I'll create a patch (but don't commit secrets to repo — use env files on the server instead).
