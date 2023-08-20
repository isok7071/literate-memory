# Деплой
1. ```docker compose up --build```
2. Зайти в контейнер с php-fpm и в корне проекта
```
composer install
php yii migrate
```

3. Зайти в контейнер с frontend и в корне
```
npm install
npm run build
```

4. Готово. 
Адрес фронтенда - http://localhost
Адрес обработчика при отправки формы на бэкэнде - http://localhost/api/create-user

#Стек
Я использовал: 
*Yii 2
*PostgreSQL
*Vue 3
*Pinia
*TypeScript
*Docker
*php-fpm
*nginx
