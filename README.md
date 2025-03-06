## Cистема для управления контрагентами с возможностью их добавления по ИНН с получением данных из API DaData .

### Инициализация:

    composer install
    npm install

### Подготовка базы данных:

1. Подготовка тестовой базы данных по пути /config/database/test_database.sqlite. По умолчанию конфигурация test_database.
2. Подготовка  базы данных по пути /config/database/database.sqlite. Прописываем пути в настройках.
3. Выполняем миграции:

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



