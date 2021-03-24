# PHP MVC Development Kit

### Instalation
1. Clone this repository
   ```bash
   git clone https://github.com/azizsama/php-mvc-kit
   ```
2. Happy Coding

### Usage
#### Routing
##### Basic
Go to `router/routes.php` and Add
```php
...
Route::get('/foo', [FooController::class, 'fooAction']); // for GET method
Route::post('/foo', [BarController::class, 'barAction']); // for POST method
Route::get('/direct', function() {
  return view('foo.bar', [
    'title' => 'Hi',
    'body' => 'There...'
  ]);
}); // for direct action
```
##### Additional
Create new file in `router` directory then add this line:
```php
<?php

Route::get('/foo', [FooController::class, 'fooAction']); // for GET method
Route::post('/foo', [BarController::class, 'barAction']); // for POST method
```
then include the new file to `router/routes.php`
```php
...
include __DIR__."/new-routes.php";
```

_-Other Docs coming soon-_
