#!/bin/sh
rm -rf ./docker/db/data/*
docker-compose down -v
