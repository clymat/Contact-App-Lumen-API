#!/bin/bash

# Copy configs
cp docker/web/nginx.conf /etc/nginx/nginx.conf
cp docker/web/server/local /etc/nginx/sites-enabled/default

chmod 0777 /tmp
mkdir -p /var/log/php7
chmod -R 0777 /var/log/php7

# Make sure storage is writable
mkdir -p storage/logs
chmod -R 0777 storage
touch storage/logs/supervisord.log

# Start processes
supervisord -n -c docker/web/supervisord.conf