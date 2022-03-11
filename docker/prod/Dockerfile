FROM php:8-fpm-alpine

COPY ./ /var/project-dependencies
WORKDIR /var/project-dependencies

CMD ["sh", "-c", "php run-dependencies.php $PROJECTNAME $COMMAND $DEPENDENCIES"]