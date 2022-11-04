# https://tech.davis-hansson.com/p/make/

SHELL := bash
.SHELLFLAGS := -eu -o pipefail -c

ifeq ($(origin .RECIPEPREFIX), undefined)
  $(error This Make does not support .RECIPEPREFIX. Please use GNU Make 4.0 or later)
endif
.RECIPEPREFIX = >

.DEFAULT_GOAL := help

DC = docker-compose -f docker-compose.yaml

include .env

help:
> @grep -E '^[a-zA-Z0-9_-]+:.*?## .*$$' $(MAKEFILE_LIST) \
> | sed -n 's/^\(.*\): \(.*\)##\(.*\)/\1\3/p' \
> | column -t  -s ' '
.PHONY: help

build: ## Build containers.
> @$(DC) build
.PHONY: build

install: ## Install things.
> @docker network create dev &>/dev/null
> @$(DC) run --rm php composer install
.PHONY: install

start: ## Start containers.
> @$(DC) up -d
.PHONY: start

php: ## Enter php cli.
> @$(DC) exec php sh
.PHONY: php

aws: ## Enter AWS cli.
> @$(DC) exec aws bash
.PHONY: aws

postgres: ## Enter PSQL.
> @$(DC) exec -e POSTGRES_PASSWORD=$POSTGRES_PASSWORD postgres psql -U $(POSTGRES_USER) -d $(POSTGRES_DB)
.PHONY: aws

stop: ## Stop containers.
> @$(DC) rm -sfv
.PHONY: stop

ps: ## Display containers statuses.
> @$(DC) ps
.PHONY: ps
