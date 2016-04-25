#!/usr/bin/env bash
#arguments
# $1  = db.user
# $2  = db.pass
# $3  = db.host
# $4  = magento.db_name
# $5  = magento.base_url
# $6  = magento.admin_firstname
# $7  = magento.admin_lastname
# $8  = magento.admin_email
# $9  = magento.admin_user
# $10 = magento.admin_password
# $11 = magento.backend_frontname
# $12 = magento.language
# $13 = magento.currency
# $14 = magento.timezone
# $15 = magento.fixture

# create a database in which Magento will be installed later on
sudo mysql --user=$1 --password=$2 -e "CREATE DATABASE "$4";"

# run the Magento installation from the command line
php /var/www/html/bin/magento setup:install --db-user="$1" --db-password="$2" --db-name="$4" --db-host="$3" --base-url="$5" --admin-firstname="$6" --admin-lastname="$7" --admin-email="$8" --admin-user="$9" --admin-password="${10}" --backend-frontname="${11}" --language="${12}" --currency="${13}" --timezone="${14}"

php /var/www/html/bin/magento deploy:mode:set developer
php /var/www/html/bin/magento cache:disable
php /var/www/html/bin/magento cache:flush
php /var/www/html/bin/magento setup:performance:generate-fixtures /var/www/html/setup/performance-toolkit/profiles/ce/${15}.xml
#php /var/www/html/bin/magento setup:static-content:deploy