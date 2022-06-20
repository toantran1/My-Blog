#!/bin/bash
usermod -d /var/lib/mysql/ mysql
chown -R mysql /var/lib/mysql/
service apache2 start
service mysql start
exec $@