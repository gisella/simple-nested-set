up:
	docker-compose up --build -d --force-recreate

down:
	docker-compose -f docker-compose.yml down

clean:
	docker rm $$(docker ps -qa) || true
	docker rmi $$(docker images -q) || true

test:
	vendor/bin/phpunit --bootstrap src/autoload.php ./test

install:
	php composer.phar install

.PHONY: up down clean test install