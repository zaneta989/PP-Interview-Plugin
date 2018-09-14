#!/bin/bash

set -e

git clone https://github.com/matomo-org/matomo matomo
cd matomo
rm README.md
git submodule update --init
mv ./plugins/* ../plugins/
rmdir plugins
mv * ..
mv .gitmodules ..
cd ..
rm -rf matomo

docker-compose down
docker-compose up -d --build

docker exec -u www-data:www-data php composer install

