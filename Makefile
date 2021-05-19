.DEFAULT_GOAL := help

help:
	@echo "Makefile available commands: install, watch, build, update_container, clear_container_cache"

install:
	@composer install
	@npm install

watch:
	@node_modules/webpack/bin/webpack.js --mode='production' --watch

build:
	@node_modules/webpack/bin/webpack.js --mode 'production'

update_container:
	@composer update

clear_container_cache:
	@composer clearcache