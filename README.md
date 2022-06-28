# zelenkaru_test

https://gist.github.com/bezdelnique/ee37c8ab9566f091e96b6e10d2d4d36b

## Install with Makefile
 ```sh
make bootstrap
```
Will install project dependencies and build mysql+adminer container

## Install manually
 ```sh
composer install
docker-compose up -d
```

## Adminer
http://127.0.0.1:8080/
 - Driver: MySQL
 - Server: zelenka-db
 - User: zelenka
 - Password: zelenkapassword
 - Database: zelenka


## Commands
Available commands
```sh
./yii order
```

Update db from url (https://zelenka.ru/sample/orders.json)
```sh
./yii order/update-net [url]
```

Update db from local file
```sh
./yii order/update-local [path-to-file]
```

Show info
```sh
./yii order/info [order-real-id]
```