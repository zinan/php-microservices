#!/usr/bin/env bash

docker-compose -f microservices/support/docker-compose.yml up -d --remove-orphans
docker-compose -f microservices/database/docker-compose.yml up -d --remove-orphans

docker-compose -f microservices/application/user_management/docker-compose.yml up -d --remove-orphans
docker-compose -f microservices/application/product_management/docker-compose.yml up -d --remove-orphans
docker-compose -f microservices/application/category_management/docker-compose.yml up -d --remove-orphans
docker-compose -f microservices/application/comment_management/docker-compose.yml up -d --remove-orphans
docker-compose -f microservices/application/order_management/docker-compose.yml up -d --remove-orphans

