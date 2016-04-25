#!/usr/bin/env bash
sudo yum -y install php70u php70u-pdo php70u-mysqlnd php70u-opcache php70u-xml php70u-mcrypt php70u-gd php70u-devel php70u-mysql php70u-intl php70u-mbstring php70u-json php70u-iconv
php -v
# set timezone
sudo sed -i "s|;date.timezone =.*|date.timezone = \"$1\"|" /etc/php.ini