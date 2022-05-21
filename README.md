
### Step by step
Repository clone
```sh
git clone https://github.com/leowebdesigner/plataformaead.git plataformaead
```

```sh
cd plataformaead
```

remove versioning
```sh
rm -rf .git/
```

Update file environment variables .env
```dosini
APP_NAME=plataformaead
APP_URL=http://localhost:8989

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=nome_que_desejar_db
DB_USERNAME=root
DB_PASSWORD=root

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```


Upload project containers
```sh
docker-compose up -d
```


access the container
```sh
docker-compose exec app bash
```


Install project dependencies
```sh
composer install
```


Generate Laravel project key
```sh
php artisan key:generate
```


Access the project
[http://localhost:8989](http://localhost:8989)
