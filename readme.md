# Настройки сервера

php 7.2
laravel 5.5

# Установка

```bash
composer install
cp backend/.env.example  backend/.env
ln -s backend/.env .env

docker-compose build app
docker-compose up -d
```


# Подготовка данных

```bash
docker exec -ti wow_market_test_app /bin/bash -c 'php artisan migrate --seed'
```

---

### Тестовые пользователи и права к их ролям

Admin имеет доступ ко всему
> **email**: admin@admin.com  
> **password**: admin@admin.com

Client имеет доступ на просмотр всего
> **email**: client@client.com 
> **password**: client@client.com

Manager имеет доступ на CRUD всего кроме пользователей и ролей
> **email**: manager@manager.com 
> **password**: manager@manager.com


# Из того что можно было сделать лучше

- переписать бек на апи к примеру с использованием апи ресурсов
- добавить проверки прав еще в контроллер
- добавить soft delete для моделей
- фронт
  - поменять на какой-то более современный (react/vue)
  - подключение через laravel mix (или другой способ), а не cdn
  - достичь большего визуально совпадения с макетами
