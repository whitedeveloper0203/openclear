# sudo chown -R ubuntu /var/www/html/CDP
# chmod -R 755 /var/www/html/CDP
cd /var/www/html/CDP
sudo composer install
sudo npm install
sudo chown -R www-data:www-data /var/www/html/CDP
sudo chmod -R 775 /var/www/html/CDP
sudo mv .env.production .env
sudo php artisan config:cache
sudo php artisan route:cache
sudo php artisan migrate --force
sudo php artisan db:seed
