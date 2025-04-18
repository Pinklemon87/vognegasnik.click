### 🔄 `docs/update-guide.md`

**Опис:** Процедура оновлення проєкту

```md
# Інструкція з оновлення

## 1. Підготовка
- Попередження користувачів модальним вікном при вході на сайт
- Резервна копія: створити резервну копію веб-сайту

## 2. Зупинка серверу, завантаження оновлення та запуск серверу
```bash
service apache2 stop
service httpd stop

git pull origin main

service apache2 start
service httpd start