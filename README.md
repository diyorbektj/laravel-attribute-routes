# Laravel Attribute Routes

Laravel 9+ va PHP 8+ uchun `#[Attribute]` yordamida controller methodlariga route (yo‘nalish) belgilash imkonini beruvchi paket. Oddiy `routes/web.php` fayliga yozish o‘rniga, controllerning ichida route e'lon qilinadi.

---

## 🔧 O'rnatish (Installation)

1. Composer orqali o‘rnating:
```bash
composer require diyorbek/laravel-attribute-routes
```

2. Laravel avtomatik ravishda `AttributeRouteServiceProvider`ni yuklaydi. Agar kerak bo‘lsa, `config/app.php` fayliga qo‘lda qo‘shishingiz mumkin:
```php
'providers' => [
    ...
    Diyorbek\AttributeRoutes\AttributeRouteServiceProvider::class,
],
```

---

## 📦 Qanday ishlaydi?

Controller methodlariga quyidagi kabi atributlar (`#[Get]`, `#[Post]` va h.k.) orqali marshrutlar belgilanadi. Bu atributlar avtomatik tarzda aniqlanadi va Laravel routing tizimiga ro‘yxatdan o‘tadi.

---

## 🧪 Foydalanish (Usage)

### 1. `Http\Controllers\PostController.php` misoli:

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
        // Ma'lumotlarni saqlash
    }
}
```

---

## ✍️ Mavjud atributlar (Available Attributes)

| Atribut | Tavsifi |
|--------|---------|
| `#[Get(uri)]` | `GET` marshrut |
| `#[Post(uri)]` | `POST` marshrut |
| `#[Put(uri)]` | `PUT` marshrut |
| `#[Parch(uri)]` | `PATCH` marshrut |
| `#[Delete(uri)]` | `DELETE` marshrut |

Har bir atributda siz quyidagi parametrlarni ko‘rsatishingiz mumkin:

```php
#[Get('/url', name: 'route.name', middleware: ['web', 'auth'])]
```

| Parametr | Tavsifi |
|----------|---------|
| `uri` | Yo‘nalish manzili (required) |
| `name` | Route nomi (optional) |
| `middleware` | Middlewarelar ro‘yxati (optional) |

---

## ⚙️ Qo‘shimcha sozlamalar (Configuration)

Agar sizning controllerlar boshqa joyda bo‘lsa, `AttributeRouteRegistrar` ga maxsus papkani uzatishingiz mumkin:

```php
(new \Diyorbek\AttributeRoutes\AttributeRouteRegistrar())->registerRoutes(app_path('Custom/Controllers'));
```

---

## ❗ Eslatma

- Bu paket faqat **PHP 8.0 yoki undan yuqori** va **Laravel 9+** da ishlaydi.
- Faqat `public` methodlar qabul qilinadi.
- `routes/web.php` ichida marshrut qo‘shish shart emas. Lekin faqat `web` middleware bilan ishlayotgan bo‘lsa, middleware parametri ko‘rsatilishi kerak.

---

## 🤝 Hissa qo‘shish (Contributing)

1. Fork qiling
2. Yangi branch oching
3. O‘zgartirish kiriting
4. Pull Request yuboring

---

## 📫 Muallif

- Diyorbek (Telegram: `@Diyorbek_tj`)
- GitHub: [github.com/diyorbektj](https://github.com/diyorbektj)