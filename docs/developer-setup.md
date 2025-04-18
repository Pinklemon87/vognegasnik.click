# 👨‍💻 `docs/developer-setup.md`

**Опис:** Налаштування середовища розробника

## Вимоги
- Git
- Open Server (Apache, PHP, MySQL)
- Composer

## Кроки:

```bash
git clone https://github.com/Pinklemon87/vognegasnik.click.git
cd vognegasnik.click

# Завантажуємо Open Server і встановлюємо
[Завантажити](https://files.1progs.ru/wp-content/uploads/2023/09/Open Server 5.4.0.rar) 
# Переносимо нашу теку з проектом у теку domains, що знаходиться в корні Open Server 5.4.0.
# Відкриваємо налаштування Open Server переходимо на вкладку "Модулі" та виcтавляємо такі налаштування:
# HTTP -> Apache_2.4-PHP_8.0
# PHP -> PHP 8.0
# MySQL/MariaDB -> MySQl-8.0-Win10
# Зберігаємо налаштування і закриваємо вікно.
# У розширеннях є Open Server є phpMyAmdin, переходмо і авторизуємось (за замовчувавнням логін: root і відсутній пароль).
# У корні проекту vognegasnik.click є тека database і там vognegasnik.sql топрібно експортувати файл в phpMyAmdin для розгортання бази даних.
# Запускаємо сервер.
# У браузері переходимо по посиланню http://vognegasnik.click і бачимо наш сайт.