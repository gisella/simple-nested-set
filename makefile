up:
		docker rm $(sudo docker ps -qa)
		docker-compose build
		docker-compose up
down:
		docker-compose -f docker-compose.yml down
test:
		./phpunit --bootstrap src/Autoloader.php ./test