# АО Балтийский Телекоммуникационный Холдинг

## Инструкция для исползования

### Клонирование проекта и копирование env

```bash
$ git clone https://github.com/JaloladdinRozmetov/productsTest.git
$ cd productsTest
$ cp .env.example .env
```

### Запуск проекта через докер
```bash
$ docker-compose up -d
```

### Запускаем установку пакетов php (композер)
```bash
$ docker exec -it productstest-app-1 composer install
```

### Генерация ключа и запуск миграции для Laravel
```bash
$ docker exec -it productstest-app-1 php artisan key:generate
```

### Запуск миграции для Laravel
```bash
$ docker exec -it productstest-app-1 php artisan migrate
```

### Чтобы заполнить БД заранее прописанными данными можно использовать seed
```bash
$ docker exec -it productstest-app-1 php artisan DB:seed
```
### Открываем браузер и заходим http://localhost:8080/
### login: admin@example.com
### parol: password

### Для проверки отправлений увидомлений измените в /config/product.php есть email поставте свою почту 
### И запустите команду для запустка Очереди
```bash
$ docker exec -it productstest-app-1 php artisan queue:listen
```
