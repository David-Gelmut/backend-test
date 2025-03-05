# Cистема для управления контрагентами.

### Инициализация:

    composer install
    npm install

### Подготовка базы данных:

1. Подготовка тестовой базы данных по пути /config/database.php. По умолчанию конфигурация test_database.
  
2. Выполняем миграции:

    ```
    php artisan migrate
    ```
### Подготовка окружения: 

  Для работы сервиса DaData в .env файле прописываем параметр DADATA_TOKEN. Получаем его в личном кабинете DaData.

### Запускаем сервер и пакетный менеджер:

    php artisan serve
    npm run dev

### Запуск проекта по http://localhost:8000/ .

### [Swagger документация](http://localhost:8000/api/documentation)



