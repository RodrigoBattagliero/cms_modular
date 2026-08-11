## Set up

### Pre requisites

In order to proceed with the instalation, you need to have these packages installed.

- git
- php
- Composer
- Symfony cli.

### Install

```bash
git clone https://github.com/RodrigoBattagliero/cms_modular

cd cms_modular/

composer install

php bin/console doctrine:migrations:migrate -y

symfony serve
```

## Usage

### User

- get All`GET api/user`

- get one `GET api/user/{id}`

- create `POST api/user`

Body:

```json
{
    "name": "Rodrigo",
    "email": "rodrigo@test.com",
    "status": true,
    "rol": 1
}
```

- update `POST api/user/{id}`

Body:

```json
{
    "name": "Rodrigo",
    "email": "rodrigo@test.com",
    "status": true,
    "rol": 1
}
```

- detele `DELETE api/user/{id}`

### Category

- get all `GET api/category`

- get one `GET api/category/{id}`

- create `POST api/category`

Body:

```json
{
    "name": "tit 2",
    "description": "desc",
    "status": true
}
```

- update `POST api/category/{id}`

Body:

```json
{
    "name": "tit 2",
    "description": "desc",
    "status": true
}
```

- delete `DELETE api/category/{id}`

### Article

- get all `POST api/article/{id}`

- get one `POST api/article`

- create `POST api/article`

Body:

```json
{
    "title": "tit 2",
    "content": "desc",
    "status": true,
    "author_id": 2,
    "categories": [3, 2]
}
```

- update `POST api/article`

Body:

```json
{
    "title": "tit 2",
    "content": "desc",
    "status": true,
    "author_id": 2,
    "categories": [3, 2]
}
```

- delete `DELETE api/article/{id}`
