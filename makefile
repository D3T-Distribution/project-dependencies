DOCKER_DIR = docker/dev

PROJECT_NAME=project_dependencies
D = docker
DC = docker-compose -f ${DOCKER_DIR}/docker-compose.yml --project-directory ${DOCKER_DIR} -p ${PROJECT_NAME}

start:
	$(DC) up -d --build

stop:
	$(DC) stop

down:
	$(DC) down

exec:
	$(D) exec -ti $(PROJECT_NAME) sh

