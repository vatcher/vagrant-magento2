#!/usr/bin/env bash
# install composer
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer

/usr/local/bin/composer -V
/usr/local/bin/composer clearcache

# add magento dependency and login
# $1 = magento username => private key
# $2 = magento password => public key
# $3 = github key
sudo rm -f /root/.composer/auth.json
echo '{"http-basic": {"repo.magento.com": {"username": "'$1'","password": "'$2'"}}, "github-oauth": {"github.com":"'$3'"}}' >> /root/.composer/auth.json
