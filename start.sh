#!/bin/bash

set -e

git clone https://github.com/matomo-org/matomo matomo
cd matomo
git submodule update --init
mv * ..
cd ..
docker-compose down
docker-compose up -d --build
