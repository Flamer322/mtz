init: docker-down-clear \
	docker-build docker-up \
	composer-install make-env generate-key generate-jwt-secret migrations
up: docker-up
down: docker-down

docker-up:
	docker compose up -d

docker-down:
	docker compose down --remove-orphans

docker-down-clear:
	docker compose down -v --remove-orphans

docker-build:
	docker compose build

composer-update:
	docker compose run --rm php-cli composer update

composer-install:
	docker compose run --rm php-cli composer install

migrations:
	docker compose run --rm php-cli php artisan migrate --no-interaction

make-env:
	docker compose run --rm php-cli cp .env.example .env

generate-key:
	docker compose run --rm php-cli php artisan key:generate

generate-jwt-secret:
	docker compose run --rm php-cli php artisan jwt:secret

create-user:
	docker compose run --rm php-cli php artisan mtz:user:create

generate-api-doc:
	graphdoc -e http://localhost:8080/graphql -o ./public/docs --force
