[![Build Status](https://travis-ci.org/EngageDC/Portrayal.png?branch=master)](https://travis-ci.org/EngageDC/Portrayal)

# Portrayal

This simple, self-contained library allows you to capture screenshots using PhantomJS.

The library is much inspired by [Laravel Cashier](https://github.com/laravel/cashier)'s PDF generation process.

## Installation

You can install this package through Composer. Edit your project's `composer.json` file to require `engage/portrayal`.

```json
"require-dev": {
	"engage/portrayal": "dev-master"
}
```

Now run `composer update` from the terminal, and you're good to go!

## Usage
```php
$capture = new \Engage\Portrayal\Capture;
$filename = $capture->snap('https://github.com/engagedc/Portrayal', sys_get_temp_dir());

// $filename = /var/folders/6_/htvcfzcd4cb_w9z6bgpmnx5h0000gn/T/d0582362c2ffbf50ee119e504bb64fdc6bba5abd.png
```

You can adjust the timeout value by appending a third parameter to `snap(...)`. E.g. 15 second timeout: `$filename = $capture->snap('https://github.com/engagedc/Portrayal', sys_get_temp_dir(), 15);`
