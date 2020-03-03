sudo apt-get update
sudo apt install -y php-fpm
sudo apt install -y curl php-cli php-mbstring php-dom git unzip
cd ~
curl -sS https://getcomposer.org/installer -o composer-setup.php
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
sudo apt install -y nodejs
sudo apt install -y npm
sudo rm -rf /var/www/html/CDP
