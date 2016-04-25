#!/usr/bin/env bash
sudo yum -y install php56u php56u-pdo php56u-mysqlnd php56u-opcache php56u-xml php56u-mcrypt php56u-gd php56u-devel php56u-mysql php56u-intl php56u-mbstring php56u-json php56u-iconv
php -v
# set timezone
sudo sed -i "s|;date.timezone =.*|date.timezone = \"$1\"|" /etc/php.ini