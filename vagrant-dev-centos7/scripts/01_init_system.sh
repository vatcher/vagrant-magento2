#!/usr/bin/env bash

# update
sudo yum -y update

# disbale selinux
sudo sed -i 's/enforcing/disabled/g' /etc/selinux/config /etc/selinux/config

# set system timezone
sudo timedatectl set-timezone $1

# Install tools [Command Line Web Browser, wget]
sudo yum -y install links wget