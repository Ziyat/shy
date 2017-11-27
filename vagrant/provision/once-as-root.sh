#!/usr/bin/env bash

#== Import script args ==

timezone=$(echo "$1")

#== Bash helpers ==

function info {
  echo " "
  echo "--> $1"
  echo " "
}

#== Provision script ==

info "Provision-script user: `whoami`"

export DEBIAN_FRONTEND=noninteractive

info "Configure timezone"
timedatectl set-timezone ${timezone} --no-ask-password

info "Prepare root password for MySQL"
debconf-set-selections <<< "mysql-community-server mysql-community-server/root-pass password \"''\""
debconf-set-selections <<< "mysql-community-server mysql-community-server/re-root-pass password \"''\""
echo "Done!"

add-apt-repository ppa:ondrej/php

info "Update OS software"
apt-get update
apt-get upgrade -y

info "Install additional software"
sudo apt install -y php5.6 libapache2-mod-php5.6 php5.6-curl php5.6-gd php5.6-mbstring php5.6-mcrypt php5.6-mysql php5.6-xml php5.6-xmlrpc mysql-server-5.7 apache2 unzip php5.6-zip php5.6-fpm php5.6-intl php5.6-cli  #php7.0-mysqlnd

# After running this command, select (Y), option 2, then (Y) for the rest of the prompts.
info "mysql_secure_installation"
mysql_secure_installation
# This will, and should, return a "does not exist!" message.
info "a2dismod php7.0"
a2dismod php7.0
# This will, and should, return a "already enabled" message.
info "a2enmod php5.6"
a2enmod php5.6

info "restart apache2"
systemctl restart apache2

info "Enable mod_rewrite for Apache2"
a2enmod rewrite

info "Configure MySQL"
sed -i "s/.*bind-address.*/bind-address = 0.0.0.0/" /etc/mysql/mysql.conf.d/mysqld.cnf
mysql -uroot <<< "CREATE USER 'root'@'%' IDENTIFIED BY ''"
mysql -uroot <<< "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%'"
mysql -uroot <<< "DROP USER 'root'@'localhost'"
mysql -uroot <<< "FLUSH PRIVILEGES"
echo "Done!"

info "Configure PHP-FPM"
sed -i 's/user = www-data/user = vagrant/g' /etc/php/5.6/fpm/pool.d/www.conf
sed -i 's/group = www-data/group = vagrant/g' /etc/php/5.6/fpm/pool.d/www.conf
sed -i 's/owner = www-data/owner = vagrant/g' /etc/php/5.6/fpm/pool.d/www.conf
echo "Done!"

info "Configure Apache"
sed -i 's/export APACHE_RUN_USER=www-data/export APACHE_RUN_USER=vagrant/g' /etc/apache2/envvars
sed -i 's/export APACHE_RUN_GROUP=www-data/export APACHE_RUN_GROUP=vagrant/g' /etc/apache2/envvars
echo "Done!"

info "Enabling site configuration"
ln -s /app/yii/vagrant/apache2/shy.conf /etc/apache2/sites-enabled/shy.conf
echo "Done!"

info "Initailize databases for MySQL"
mysql -uroot <<< "CREATE DATABASE shy CHARACTER SET utf8 COLLATE utf8_general_ci"
echo "Done!"

# info "Importing database from file"
# mysql -uroot -D guvd < /app/yii/guvduz.sql
# echo "Done!"


info "Install composer"
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
