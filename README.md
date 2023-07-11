# AnthonyCecconato_7_12052023
PHP/Symfony - Créez un web service exposant une API

[![Codacy Badge](https://app.codacy.com/project/badge/Grade/dd16d278a0ff4096a89a3b372279e0ec)](https://app.codacy.com/gh/acecconato/AnthonyCecconato_7_12052023/dashboard?utm_source=gh&utm_medium=referral&utm_content=&utm_campaign=Badge_grade)
![phpstan level 9](https://img.shields.io/badge/PHPStan-level%209-brightgreen.svg?style=flat)

# Install

Clone the repository
 
> `git clone https://github.com/acecconato/AnthonyCecconato_7_12052023.git`

Move into it

> `cd AnthonyCecconato_7_12052023`

Install project dependencies

> `composer install`

Create .env.local file and configure the database credentials

> `cp .env .env.local && nano .env.local`
 
Setup database

> `php bin/console d:d:c && php bin/console d:m:m`

Load fixtures

> `php bin/console d:f:l`

Run the web api

> `symfony serve`

# Documentation

Use the `/api/docs` url to see the SwaggerUI documentation.

Alternatively you can use the [Postman configuration](https://github.com/acecconato/AnthonyCecconato_7_12052023/blob/main/BileMo.postman_collection.json).

# Demo accounts

You can use the following credentials to try the app:

- Username: demo1@demo.fr
- Password: demo

```php
for ($i = 0; $i < 3; ++$i) {
    $client = new Client();
    $client
        ->setEmail("demo$i@demo.fr")
        ->setPassword($this->hasher->hashPassword($client, 'demo'));

    $manager->persist($client);
    $clients[] = $client;
}
```
