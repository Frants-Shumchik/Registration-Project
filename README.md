# Registration-Project

Необходимые ресурсы:
1. server MySQL
2. php-server (OpenServer, Apache...).

Для работы:
1. Разместить файлы в сетевой папке севера,
2. Запустить сервер БД (DBName - testsys: создать БД, а потом миграцию (php artisan migrate:fresh -> php artisan db:seed --class=RoleSeeder),
3. запустить проект на хосте (хост обычно 127.0.1.1).
