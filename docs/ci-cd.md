### 🔁 `docs/ci-cd.md`

**Опис:** Тести CI/CD

# CI/CD

## GitHub Actions

- Тести автоматично розгортаються при push до `main`

## deploy.yml

Файл: `.github/workflows/php.yml`

- Структура:

name: PHP Composer

on:
  push:
    branches: [ "main" ]
  pull_request:
    branches: [ "main" ]

permissions:
  contents: read

jobs:
  build:
    runs-on: ubuntu-latest

    steps:
    - uses: actions/checkout@v4

    - name: Validate composer.json and composer.lock
      run: composer validate --strict

    - name: Cache Composer packages
      id: composer-cache
      uses: actions/cache@v3
      with:
        path: vendor
        key: ${{ runner.os }}-php-${{ hashFiles('**/composer.lock') }}
        restore-keys: |
          ${{ runner.os }}-php-

    - name: Install dependencies
      run: composer install --prefer-dist --no-progress

    - name: Grant execute permissions to PHPUnit
      run: chmod +x vendor/bin/phpunit

    - name: Run PHPUnit tests
      run: vendor/bin/phpunit --testdox tests/*
