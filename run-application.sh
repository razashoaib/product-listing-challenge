#!/bin/bash

# Author : Syed Shoaib Abidi
# Script follows here:
echo " <<<<<<<<<<<<<<<<<<<< Building and running docker containers >>>>>>>>>>>>>>>>>>>>"
docker-compose up -d --build

echo " <<<<<<<<<<<<<<<<<<<< Installing composer and npm dependencies >>>>>>>>>>>>>>>>>>>>"
docker exec fpm-service bash -c "chmod +x ./install-dependencies.sh && ./install-dependencies.sh"