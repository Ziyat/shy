docker-up:
	@docker-compose up -d
docker-down:
	@docker-compose down
docker-build:
	@docker-compose up --build -d
migrate/create:
	@docker-compose exec php php yii migrate/create create_${tableName}_table --interactive=0
migrate/up:
	@docker-compose exec php php yii migrate/up
migrate/down:
	@docker-compose exec php php yii migrate/down
migrate/fresh:
	@docker-compose exec php php yii migrate/fresh
perm:
	@sudo chown ${USER}:${USER} bootstrap/cache -R
	@sudo chown ${USER}:${USER} storage -R
	@if [ -d "node_modules" ]; then sudo chown ${USER}:${USER} node_modules -R; fi
	@if [ -d "public/build" ]; then sudo chown ${USER}:${USER} public/build -R; fi
