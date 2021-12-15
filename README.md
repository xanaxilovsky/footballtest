# Test PHP Symfony - Football matches list

## Prerequisites

- [Docker CE](https://www.docker.com/community-edition)
- [Docker Compose](https://docs.docker.com/compose/install)


## Install
**1.** Copy `.dist` files

```bash
cp docker-compose.override.yml.dist docker-compose.override.yml
```

**2.** Create a local `.env` file

```bash
cp .env .env.local
```

In `.env.local`, change the value oe `FOOTBALL_API_KEY` by your own api key.

**3.** Builds, (re)creates and starts containers in the background

```bash
docker-compose up -d --build
```

**4.** Install project dependencies

```bash
docker-compose exec football-test-php composer install
```

## Website URL

http://localhost:8081

## Tests check

[![Tests check](https://github.com/xanaxilovsky/footballtest/actions/workflows/tests-check.yml/badge.svg)](https://github.com/xanaxilovsky/footballtest/actions/workflows/tests-check.yml)