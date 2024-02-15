DOCKER_ENABLED ?= 1

-include .env
-include .env.local

include .boing/makes/symfony.mk

init:
	${docker-compose} up -d
	${composer} install
	${MAKE} database
