#!/bin/sh

cd /var/www/paulryantimecalculator.com
git pull origin master
docker-compose -f docker-compose.prod.yml build
docker-compose -f docker-compose.prod.yml up -d