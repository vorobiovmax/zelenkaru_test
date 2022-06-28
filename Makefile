install-project-dependencies:
	composer install

up-db:
	(cd $(CURDIR)/docker/mysql/ && docker-compose up -d)

bootstrap: install-project-dependencies up-db

stop:
	(cd $(CURDIR)/docker/mysql/ && docker-compose stop)

down:
	(cd $(CURDIR)/docker/mysql/ && docker-compose down)

clean-db:
	rm -rf $(CURDIR)/docker/db/data/*