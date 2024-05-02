#!/bin/sh
docker-compose exec laravel php "$@"
return $?