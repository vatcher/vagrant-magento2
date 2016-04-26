#!/usr/bin/env bash

# update
sudo yum -y update

# disbale selinux
#sudo sed -i 's/enforcing/disabled/g' /etc/selinux/config /etc/selinux/config
sudo setenforce 0

# set system timezone
sudo timedatectl set-timezone $1

# Install tools [Command Line Web Browser, wget]
sudo yum -y install links wget

# add Extra Packages for Enterprise Linux
sudo yum -y install epel-release
sudo yum -y install http://dl.iuscommunity.org/pub/ius/stable/CentOS/7/x86_64/ius-release-1.0-14.ius.centos7.noarch.rpm
sudo yum -y update