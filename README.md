
# Laravel Attribute Routes

Пакет, позволяющий задавать маршруты (`routes`) прямо внутри методов контроллера с помощью `#[Attribute]` для Laravel 9+ и PHP 8+. Вместо объявления маршрутов в `routes/web.php`, вы можете указывать их напрямую в контроллерах.

---

## 🔧 Установка

1. Установите через Composer:
```bash
composer require diyorbek/laravel-attribute-routes
```

2. Laravel автоматически загрузит `AttributeRouteServiceProvider`. Если потребуется — можно добавить его вручную в `config/app.php`:
```php
'providers' => [
    ...
    Diyorbek\AttributeRoutes\AttributeRouteServiceProvider::class,
],
```

---

## 📦 Как это работает?

Маршруты задаются с помощью атрибутов вроде `#[Get]`, `#[Post]` и т.д. Эти атрибуты автоматически распознаются и регистрируются в системе маршрутизации Laravel.

---

## 🧪 Пример использования

### 1. Пример контроллера `Http\Controllers\PostController.php`:

```php
<?php

namespace App\Http\Controllers;

use Diyorbek\AttributeRoutes\Routing\Attributes\Get;
use Diyorbek\AttributeRoutes\Routing\Attributes\Post;

class PostController extends Controller
{
    #[Get('/posts', name: 'posts.index', middleware: ['web'])]
    public function index()
    {
        return view('posts.index');
    }

    #[Post('/posts', name: 'posts.store', middleware: ['web'])]
    public function store()
    {
        // Сохранение данных
    }
}
```

---

## ✍️ Доступные атрибуты

| Атрибут | Описание |
|--------|----------|
| `#[Get(uri)]` | Маршрут с методом `GET` |
| `#[Post(uri)]` | Маршрут с методом `POST` |
| `#[Put(uri)]` | Маршрут с методом `PUT` |
| `#[Parch(uri)]` | Маршрут с методом `PATCH` |
| `#[Delete(uri)]` | Маршрут с методом `DELETE` |

Каждый атрибут может содержать следующие параметры:

```php
#[Get('/url', name: 'route.name', middleware: ['web', 'auth'])]
```

| Параметр | Описание |
|----------|----------|
| `uri` | Адрес маршрута (обязательный) |
| `name` | Имя маршрута (необязательный) |
| `middleware` | Список middleware (необязательный) |

---

## ⚙️ Дополнительные настройки

Если ваши контроллеры находятся в другой директории, вы можете указать путь вручную в `AttributeRouteRegistrar`:

```php
(new \Diyorbek\AttributeRoutes\AttributeRouteRegistrar())->registerRoutes(app_path('Custom/Controllers'));
```

---

## ❗ Примечания

- Пакет работает только с **PHP 8.0 или выше** и **Laravel 9+**.
- Поддерживаются только `public` методы контроллеров.
- Не требуется регистрировать маршруты в `routes/web.php`. Однако, если маршрут работает только через `web` middleware, обязательно указывайте его.

---

## 🤝 Вклад в развитие

1. Сделайте fork репозитория
2. Создайте новую ветку
3. Внесите изменения
4. Отправьте Pull Request

---

## 📫 Автор

- Диёрбек (Telegram: `@Diyorbek_tj`)
- GitHub: [github.com/diyorbektj](https://github.com/diyorbektj)
