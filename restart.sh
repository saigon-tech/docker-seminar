#!/bin/sh
docker-compose down
rm -rf ./docker/db/data/*
docker-compose up -d
docker-compose ps
