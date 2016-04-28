#!/usr/bin/env bash
#sudo yum -y install php70u php70u-pdo php70u-mysqlnd php70u-opcache php70u-xml php70u-mcrypt php70u-gd php70u-devel php70u-mysql php70u-intl php70u-mbstring php70u-json php70u-iconv
#php -v
## set timezone
#sudo sed -i "s|;date.timezone =.*|date.timezone = \"$1\"|" /etc/php.ini

sudo yum -y install gcc libxml2-devel pkgconfig openssl-devel bzip2-devel libpng-devel libpng-devel libjpeg-devel libXpm-devel freetype-devel gmp-devel libmcrypt-devel aspell-devel recode-devel httpd-devel libcurl

wget http://de1.php.net/get/php-7.0.4.tar.gz/from/this/mirror
sudo tar xzf php-7.0.4RC1.tar.gz -C /opt
cd /opt/php-7.0.4RC1
sudo ./buildconf --force

cd /opt/php-7.0.4RC1
sudo ./configure \
--prefix=$HOME/php7/usr \
--with-config-file-path=$HOME/php7/usr/etc \
--enable-mbstring \
--enable-zip \
--enable-bcmath \
--enable-pcntl \
--enable-ftp \
--enable-exif \
--enable-calendar \
--enable-sysvmsg \
--enable-sysvsem \
--enable-sysvshm \
--enable-wddx \
--with-curl \
--with-mcrypt \
--with-iconv \
--with-gmp \
--with-pspell \
--with-gd \
--with-jpeg-dir=/usr \
--with-png-dir=/usr \
--with-zlib-dir=/usr \
--with-xpm-dir=/usr \
--with-freetype-dir=/usr \
--enable-gd-native-ttf \
--enable-gd-jis-conv \
--with-openssl \
--with-pdo-mysql=/usr \
--with-gettext=/usr \
--with-zlib=/usr \
--with-bz2=/usr \
--with-recode=/usr \
--with-mysqli=/usr/bin/mysql_config \
--with-apxs2

cd /opt/php-7.0.4RC1
sudo make
cd /opt/php-7.0.4RC1
sudo make install