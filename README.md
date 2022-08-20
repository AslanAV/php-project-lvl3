# php-project-lvl3

[![PHP CI & heroku deploy](https://github.com/AslanAV/php-project-lvl3/actions/workflows/phpci.yaml/badge.svg)](https://github.com/AslanAV/php-project-lvl3/actions/workflows/phpci.yaml)
[![hexlet-check](https://github.com/AslanAV/php-project-lvl3/actions/workflows/hexlet-check.yml/badge.svg)](https://github.com/AslanAV/php-project-lvl3/actions/workflows/hexlet-check.yml)
[![codecov](https://codecov.io/gh/AslanAV/php-project-lvl3/branch/main/graph/badge.svg?token=XUJ0ZB7F3L)](https://codecov.io/gh/AslanAV/php-project-lvl3)
[![Maintainability](https://api.codeclimate.com/v1/badges/af531ceac8775cb767fb/maintainability)](https://codeclimate.com/github/AslanAV/php-project-lvl3/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/af531ceac8775cb767fb/test_coverage)](https://codeclimate.com/github/AslanAV/php-project-lvl3/test_coverage)

Demo: https://php-project-lvl-3.herokuapp.com/

## Requirements

* PHP 8.0
* Extensions: guzzle, curl, didom, xml, bootstrap, sqlite3
* Composer
* Node.js & npm
* SQLite for local
* [heroku cli](https://devcenter.heroku.com/articles/heroku-cli#download-and-install)

## Setup

For Docker setup update `.env.example`

```bash
make compose-setup
```

## Run

```bash
make start
```
