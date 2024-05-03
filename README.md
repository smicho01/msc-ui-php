# AcademiChain PHP UI

## Ports

Should run on port 80

## Run as docker container in Local Dev env.

First run docker compose on project `msc-localdev` to get Postgres database running

Then run `docker compose up -d` in this project to get all database migrations, 
create redis container and Dockerize this application.

### Postgres DB config

File `app/functions/fns_db.php` contain Postgres DB config as welll as
some basic functions to interact with db.

To configure database, below environment variables are needed:

- $host = getenv("POSTGRESHOST");
- port = getenv("POSTGRESPORT");
- $dbname = getenv("POSTGRESDBNAME");
- $user = getenv("POSTGRESUSER");
- $password = getenv("POSTGRESPASSWORD");

File `docker-compose.yml` and service `phpui` introducing how they should be set.