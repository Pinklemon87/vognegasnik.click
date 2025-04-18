### 🚀 `docs/deployment.md`

**Опис:** Покрокова інструкція для DevOps / Release Engineer

```md
# Розгортання у продакшн

## Вимоги:
- CPU: 2 ядра+
- RAM: 4GB+
- SSD: 100MB+
- Ubuntu 22.04/Windows Server 2019

## Необхідне ПЗ:
- Apache 2.4
- PHP 8.0
- MySQL 8.0
- Composer

## Кроки:
```bash
git clone https://github.com/Pinklemon87/vognegasnik.click.git
cd vognegasnik.click
composer dump-autload -o