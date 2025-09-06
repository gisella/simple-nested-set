up:
	docker-compose up --build -d --force-recreate

down:
	docker-compose -f docker-compose.yml down

clean:
	docker rm $$(docker ps -qa) || true
	docker rmi $$(docker images -q) || true

test:
	vendor/bin/phpunit

test-coverage:
	vendor/bin/phpunit --coverage-html coverage

test-specific:
	vendor/bin/phpunit --filter $(TEST)

install:
	php composer.phar install

.PHONY: up down clean test install test test-coverage test-specific