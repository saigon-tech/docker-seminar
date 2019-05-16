#!/bin/sh
rm -rf ./docker/db/data/*
docker-compose down
docker-compose build --no-cache
docker-compose up -d
docker-compose ps
