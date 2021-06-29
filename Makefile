.DEFAULT_GOAL := help

help:
	@echo "Makefile available commands: install, watch, build, update_container, clear_container_cache"

install:
	@composer install
	@npm install

watch:
	@node_modules/webpack/bin/webpack.js --mode='production' --watch

sass-watch:
	@node_modules/sass/sass.js --watch --style compressed src/Style/main.scss public/main.min.css

build:
	@node_modules/webpack/bin/webpack.js --mode 'production'

update_container:
	@composer update

clear_container_cache:
	@composer clearcache