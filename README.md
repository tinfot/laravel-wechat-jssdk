# Laravel Wechat JSSDK for Laravel 5


---

[![Latest Stable Version](https://poser.pugx.org/maatwebsite/excel/v/stable.png)](https://packagist.org/packages/richardtianke/laravel-wechat-jssdk) 
[![Total Downloads](https://poser.pugx.org/maatwebsite/excel/downloads.png)](https://packagist.org/packages/richardtianke/laravel-wechat-jssdk)  
[![License](https://poser.pugx.org/maatwebsite/excel/license.png)](https://packagist.org/packages/richardtianke/laravel-wechat-jssdk)
[![Monthly Downloads](https://poser.pugx.org/maatwebsite/excel/d/monthly.png)](https://packagist.org/packages/richardtianke/laravel-wechat-jssdk)
[![Daily Downloads](https://poser.pugx.org/maatwebsite/excel/d/daily.png)](https://packagist.org/packages/richardtianke/laravel-wechat-jssdk)

# Installation
Require this package in your composer.json and update composer. 

```php
composer require tinfot/laravel-wechat-jssdk:dev-master
```

In Laravel 5.5 or higher, this package will be automatically discovered and you can safely skip the following two steps.

If using Laravel 5.4 or lower, after updating composer, add the ServiceProvider to the providers array in config/app.php

```php
Tinfot\Wechat\WechatServiceProvider::class,
```


You can use the facade for shorter code; if using Laravel 5.3 or lower, add this to your aliases:
```php
'JSSDK' => Tinfot\Wechat\Facades\JSSDK::class,
```

# Usage

```php
$model = new \Tinfot\Wechat(config('wechat.app_id'), config('wechat.app_secret'), $request->input('url'));
$model->setSignPackage();
return $model->getSignPackage();
```

# Support
Support only through Github. Please don't mail us about issues, make a Github issue instead.