#!/usr/bin/env bash
# install and show version
sudo yum install httpd
httpd -v
# start service now
sudo systemctl start httpd.service
# start with system
sudo systemctl enable httpd.service

# some configs
awk '/<Directory \/var\/www\/html\/>/,/AllowOverride None/{sub("None", "All", $0)}{print}' /etc/httpd/conf/httpd.conf > /tmp/tmp.httpd.conf
sudo mv /tmp/tmp.httpd.conf /etc/httpd/conf/httpd.conf
sudo usermod -g apache vagrant