Blade Components and slots for Laravel 5.1.x
==============
This package introduces the concept of components in blade templating for Laravel 5.1.x LTS

Components allow you to extend a view and inject content into it, inline, within your views.

Why?
---
To make it easier to create reusable components. Maybe, like me, you need this feature in your L5.1.x app and cant upgrade to L5.4.x because is to hard change a big project.

Installation
------------
Begin by installing this package through Composer.

```json
{
    "require": {
        "yocmen/blade-components": "1.*"
    }
}
```
Next open up `app/config/app.php`, comment out the Illuminate View Service Provider, and add the one from this package:
```php
'providers' => array(
    //'Illuminate\View\ViewServiceProvider',
    ...
    'Yocmen\BladeComponents\BladeComponentsServicesProvider',
)
```

And that's it!

All documentation for this feature u can find it here: https://laravel.com/docs/5.4/blade#components-and-slots