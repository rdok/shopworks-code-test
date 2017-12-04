#!/bin/sh

# If you would like to do some extra provisioning you may
# add any commands you wish to this file and they will
# be run after the Homestead machine is provisioned.


mysql -uroot -psecret -e "drop database if exists shopworks_code_test"
mysql -uroot -psecret -e "create database shopworks_code_test"
mysql -uroot -psecret shopworks_code_test < /home/vagrant/code/tests/_data/staff_rota_shif_data.sql
