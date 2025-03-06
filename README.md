## Cистема для управления контрагентами с возможностью их добавления по ИНН с получением данных из API DaData .

### Инициализация:

    composer install
    npm install

### Подготовка базы данных:

1. Подготовка базы данных по пути /database/database.sqlite. Прописываем пути к базе в настройках подключения и в .env файле  DB_CONNECTION=sqlite.
2. Для тестов. Подготовка тестовой базы данных по пути /database/test_database.sqlite. По умолчанию конфигурация test_database и в .env файле DB_CONNECTION=test_database.
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

### API. [Swagger документация](http://localhost:8000/api/documentation).
  Авторизация по API осуществляется с помощью Bearer token. 



