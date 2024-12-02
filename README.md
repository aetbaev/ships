### Развертывание локально

### 1. Создание файла `.env`

```bash
cp .env.example .env
```

### 2. Установка зависимостей

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```

### 3. Запуск Docker-контейнеров
```bash
./vendor/bin/sail up -d
```

### 4. Миграция базы данных

```bash
./vendor/bin/sail artisan migrate
```

### 5. Создание символической ссылки на папку storage
```bash
./vendor/bin/sail artisan storage:link
```

### 6. Установка зависимостей frontend

```bash
npm i
```

### 7. Сборка frontend

```bash
npm run build
```

### 8. Запуск сайта

Сайт доступен по адресу: http://localhost:8087

### 9. Демонстрация работы
https://github.com/user-attachments/assets/cd545e57-625b-4db4-9d3b-2a434399a06d


