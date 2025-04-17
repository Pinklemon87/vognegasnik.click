==== Vognegasnik.click =====
----------------------------

Конфігурація
------------------------------
+ Apache 2.4, PHP 8.0, MYSQL 8.0.

Фреймворки
------------------------------
+ Bootstrap 5.3 (CDN).

Структура проекту
------------------------------
+ app > контролери та сервіси проекту.
+ assets > css та js файли, картинки.
+ config > конфігураційний файл БД.
+ database > конфігураційний файл бази даних (до експорту).
+ includes > блоки html коду з обробниками php.
+ vendor > ядро проекту, композер та додатки для тестів.
+ .htaccess > конфігурація Apache серверу.
+ composer.json, composer.lock > налаштування композеру.
+ index.php, profile.php, login.php, equipment.php, article.php, about.php, 404.php > веб-сторінки.

Запуск веб-сайту
------------------------------
Завантажте та запустіть Open Server. Виставте налаштування відповідно п. Configuration.
У теці Open Server перейдіть до domain, створіть теку з будь-яким ім'ям (наприклад localhost).
Завантажте туди всі файли проекту. Запустіть з Open Server вбудований додаток phpMyAdmin та імпортуйте
файл vognegasnik.sql з теки database, яка знаходиться в корні проекту.
Запустіть Open Server та перейдіть в браузері за посиланням http://(ім'я створеної теки)
якщо ви вводили приклад, то посилання виглядає так: http://localhost 

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.