#!/usr/bin/env bash
sudo wget http://repo.mysql.com/mysql-community-release-el6-5.noarch.rpm && sudo rpm -ivh mysql-community-release-el6-5.noarch.rpm
sudo yum -y install mysql-server

# for development to connect from outside
sudo sed -i 's/symbolic-links=0/symbolic-links=0\nbind-address=0.0.0.0/g' /etc/my.cnf

sudo systemctl start mysqld.service
sudo systemctl enable mysqld.service

mysqladmin -u root password "$1"
mysql -u root -p"$1" -e "UPDATE mysql.user SET Password=PASSWORD('$1') WHERE User='root'"
mysql -u root -p"$1" -e "DELETE FROM mysql.user WHERE User='root' AND Host NOT IN ('localhost', '127.0.0.1', '::1')"
mysql -u root -p"$1" -e "DELETE FROM mysql.user WHERE User=''"
mysql -u root -p"$1" -e "DELETE FROM mysql.db WHERE Db='test' OR Db='test\_%'"
mysql -u root -p"$1" -e "FLUSH PRIVILEGES"

