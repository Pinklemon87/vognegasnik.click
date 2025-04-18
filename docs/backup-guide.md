### 💾 `docs/backup-guide.md`

**Опис:** Стратегія резервного копіювання та відновлення

```md
# Резервне копіювання та відновлення

## Типи копій:
- Повні: щотижня
- Інкрементальні: щодня

## Зберігання:
- Локально: `/backups`
- Хмара: Amazon S3

## Резервна копія та відновлення:
```bash
mysql -u root -p dbname > /backups/db-YYYY-MM-DD.sql #резервна копія

mysql -u root -p dbname < /backups/db-YYYY-MM-DD.sql #відновлення