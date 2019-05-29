include .env
COMPOSE = dockerfiles/docker-compose.yml
CONTAINER = php-fpm
PREFIX = amanohashidate

setup:
	@ echo "🤖  < Resolving code dependencies..."
	@ cd $(CURDIR)/app && \
		composer install --no-dev
	@ echo
	@ echo "🤖  < Setting up encryption key..."
	@ cd $(CURDIR)/app && \
		php artisan key:generate

setup-dev:
	@ echo "🤖  < Resolving code dependencies..."
	@ cd $(CURDIR)/app && \
		composer install
	@ echo
	@ echo "🤖  < Setting up encryption key..."
	@ cd $(CURDIR)/app && \
		php artisan key:generate

up:
	@ docker-compose -f $(COMPOSE) -p $(PREFIX) up -d --build --remove-orphans

up-production:
	@ docker-compose -f $(COMPOSE) -p $(PREFIX) up -d --build --remove-orphans --scale worker=2

restart:
	@ docker-compose -f $(COMPOSE) -p $(PREFIX) restart

clean:
	@ docker-compose -f $(COMPOSE) -p $(PREFIX) stop && \
		yes | docker-compose -f $(COMPOSE) -p $(PREFIX) rm

ps:
	@ docker-compose -f $(COMPOSE) -p $(PREFIX) ps

sh:
	@ docker-compose -f $(COMPOSE) -p $(PREFIX) exec $(CONTAINER) \
		sh

mysql:
	@ docker-compose -f $(COMPOSE) -p $(PREFIX) exec mysql \
		mysql -u $(DB_USERNAME) -p$(DB_PASSWORD) -h localhost app

migrate:
	@ docker-compose -f $(COMPOSE) -p $(PREFIX) exec php-fpm \
		php artisan migrate

init:
	@ docker-compose -f $(COMPOSE) -p $(PREFIX) exec php-fpm \
		php artisan migrate:refresh --seed
	@ docker-compose -f $(COMPOSE) -p $(PREFIX) exec -w /home/worker/app/worker worker \
		npm install

rebuild-node-sass:
	@ docker-compose -f $(COMPOSE) -p $(PREFIX) exec next \
		npm rebuild node-sass

test-server:
	@ docker-compose -f $(COMPOSE) -p $(PREFIX) exec php-fpm \
		vendor/bin/phpunit

validate-ci-config:
	@ cd ../; circleci config validate .circleci/config.yml

local-ci:
	@ cd ../; circleci build .circleci/config.yml
