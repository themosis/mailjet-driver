MailJet Mail Driver
===================

This package provides a [MailJet](https://www.mailjet.com/) mail driver for your [Themosis](https://framework.themosis.com/) / [Laravel](https://laravel.com/) / Illuminate based application.

It extends the default list of mail drivers provided by the `illuminate/mail` package by adding the `mailjet` option.

## Installation

The installation is done through [Composer](https://getcomposer.org/):

```bash
composer require themosis/mailjet-driver
```

## Usage

### Set the default driver

First, specify your default mail driver as `mailjet` from your application environment file and add the service public and secret keys:

```dotenv
MAIL_DRIVER=mailjet

MAILJET_PUBLIC_KEY=1234567890
MAILJET_SECRET_KEY=1234567890
```

### Add the MailJet service

Open (or create) the `config/services.php` file and add the MailJet services credentials:

```php
return [
    'mailjet' => [
        'public' => env('MAILJET_PUBLIC_KEY'),
        'secret' => env('MAILJET_SECRET_KEY'),
        'version' => env('MAILJET_VERSION', 'v3.1')
    ],
    ...
];
```

### Set the service provider

By default, your application has the `Illuminate\Mail\MailServiceProvicer` defined inside the `config/app.php` file. In order to enable the `mailjet` driver, you need to replace the default service provicer by the one provided by this package, the `Themosis\MailJet\MailServiceProvider` like so:

```php
return [
    'providers' => [
        // Illuminate providers...

        Themosis\MailJet\MailServiceProvider::class,

        // Application providers
    ]
];
```

## Changelog

Please see the [CHANGELOG](CHANGELOG.md) file for more information on releases changes.

## Security

If you discover any security related issues, please send an email email to julien@themosis.com.

## Credits

- [Julien Lambé](https://github.com/jlambe)
- [All contributors](https://github.com/themosis/mailjet-driver/graphs/contributors)

## Support us

[Themosis](https://www.themosis.com) is a webdesign agency based in Arlon, Belgium. We specialized in custom publishing web platforms and have expertise in building applications with WordPress.

We've built the [Themosis framework](https://framework.themosis.com), an open-source WordPress framework.

## License

GPL-2.0-or-later. Please see [LICENSE](LICENSE.md) file for more information.
