# laravel-url-alias
Allow aliasing of URLs.
Also manages URL redirects.

## Installation instructions

1. Add ```"monkiibuilt/laravel-url-alias": "dev-master",``` to the require array in composer.json
2. Add this to the respositories array in composer.json:
```
{
    "type": "package",
    "package": {
        "name": "MonkiiBuilt/laravel-url-alias",
        "version": "dev-master",
        "source": {
            "url": "https://github.com/MonkiiBuilt/laravel-url-alias.git",
            "type": "git",
            "reference": "master"
        },
        "autoload": {
            "classmap": [""]
        }
    }
}
```
3. Add ```MonkiiBuilt\LaravelUrlAlias\ServiceProvider::class,``` to the providers array in config/app.php

4. Run ```php artisan vendor:publish```

5. Run ```php artisan migrate```

6. You need to add the CheckUrlAlias middleware to your Kernel. Open up ```/app/Http/Kernel.php``` and at the top of the file add 

```use App\Http\Middleware\CheckUrlAlias;```

and then update the ```$middleware``` array to look like this:

```
protected $middleware = [
        ...
        \MonkiiBuilt\LaravelUrlAlias\Middleware\CheckUrlAlias::class
    ];
```
