#!/usr/bin/env bash
mysqladmin -u root password "$1"
mysql -u root -p"$1" -e "UPDATE mysql.user SET Password=PASSWORD('$1') WHERE User='root'"
mysql -u root -p"$1" -e "DELETE FROM mysql.user WHERE User='root' AND Host NOT IN ('localhost', '127.0.0.1', '::1')"
mysql -u root -p"$1" -e "DELETE FROM mysql.user WHERE User=''"
mysql -u root -p"$1" -e "DELETE FROM mysql.db WHERE Db='test' OR Db='test\_%'"
mysql -u root -p"$1" -e "FLUSH PRIVILEGES"
