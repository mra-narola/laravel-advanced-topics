<p align="center">
    <h1 align="center">...::: 🎁Extra Bonus🎁 :::...</h1>
</p>

## Coding Standerds

being a developer, we have to make sure that, we write a code clean, reusable and optimized.

here some best practice example given in <a href="https://github.com/alexeymezenin/laravel-best-practices/#contents">Laravel Best Practice</a>. about what you need to take care about while you are developling in the Laravel or any other frameworks.

## Laravel Debug Bar
Laravel have one package called <a href="https://packagist.org/packages/barryvdh/laravel-debugbar">Laravel Debug Bar</a>
it will helps you in ...
1. to debug the code
2. how much memory it consume and query execution time
3. how many SQL query execute

and many more...

## Spatie Packages
Spatie provides many packages that helps to develop feature easly.

1. <a href="https://spatie.be/docs/laravel-permission/v5/introduction">Laravel Permission</a>
Laravel Permission provides, role-permission funtionality where we can implement easly.

Once installed you can do stuff like this:
```php
// Adding permissions to a user
$user->givePermissionTo('edit articles');

// Adding permissions via a role
$user->assignRole('writer');

$role->givePermissionTo('edit articles');
```
Assign permission to role
```php
$role->permissions()->sync($permissions);
```
also, you can protect the route for role
```php
// in routes/web.php
Route::group(['middleware' => 'role:writer'], function() {
    // route for writer
});
```

2. <a href="https://spatie.be/docs/laravel-activitylog/v4/introduction">Laravel Activity Log</a>

Laravel Activity Log provides, activity log that will sync with Database and add logs in the `activity_logs` table.

Here's a litte demo of how you can use it:
```php
activity()->log('Look mum, I logged something');
```

## Get all timezone
Sometimes, in project we need to play with the timezones. for listing all the timezone here is the best and eaziest way to do...

```php
$time_zone_lists = \DateTimeZone::listIdentifiers(\DateTimeZone::ALL);
```
as a output you will get all the timezones list in array.

