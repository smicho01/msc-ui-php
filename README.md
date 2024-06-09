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

### Local Development
#### MAMP config

In case of missing PDO extension for Postgres, add those to php.ini file

- extension=pgsql.so
- extension=pdo_pgsql

#### PHP version

Used version 7.4.X as this one contain Redis extension for local development.

### Environment variables

Here is example for MampPro local dev env Additional parameters for <VirtualHost>.
(In prod values will change of course): Read more in file `mamp-vars.txt`

SetEnv ACADEMICHAIN_ENV dev

SetEnv POSTGRESHOST localhost

SetEnv POSTGRESPORT 5432

SetEnv POSTGRESDBNAME mscstudents

SetEnv POSTGRESUSER student

SetEnv POSTGRESPASSWORD password

SetEnv USER_SERVICE_URI http://localhost:9091/api/v1

SetEnv REDIS_URL tcp://localhost:6379

SetEnv ENCRYPTION_KEY vjLFfQoanpJtwu8M2VIAJdJessqw2UKAANdU+Z0t1nI=

SetEnv KEYCLOAK_AUTH_URL <keycloak_url>