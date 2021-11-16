### Используемый стек: PHP, MYSQL, NGINX

1. Для начала необходимо настроить правильно Nginx. Для этого можно использовать конфиг ниже или модифицировать под свои нужды.
**Главное условие - все запросы должны направляться в index.php**  **nginx.conf** смотрите в папке с проектом.

2. Установим необходимые зависимости.
`cd {project_folder}
composer install
`

3. Настройка конфига. Скопируйте файл example.env -> .env и отредактируйте под себя.

4. Импортируем SQL дамп. **ads.sql** - в папке с проектом

5. Теперь можно и проверить работу API. Документация к API: <link>
---------
Время затраченное на реализацию:

1. Research - 2 h.
2. Создание базы/архитектуры проекта/подговка к разработке - 6.5
3. Решение задачи/разработка апи - 4 h.
4. PHP Doc - 0.5 h