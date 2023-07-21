TinyMCE editor extension for laravel-admin
======

This is a `laravel-admin` extension that integrates [TinyMCE 6](https://www.tiny.cloud/) into the `laravel-admin` form.

## Screenshot
![Screenshot 2023-07-21 at 10 52 44](https://github.com/han48/mr4-lax.tiny-mce/assets/27817127/e51c3700-3eb7-4efd-901e-8491bb49bb9a)

## Installation
```bash
composer require mr4-lax/tiny-mce
php artisan vendor:publish --tag=mr4-lax-tinymce
```

## Configuration
In the extensions section of the config/admin.php file, add some configuration that belongs to this extension.

```php
'extensions' => [
    'mr4lax' => [
        // If the value is set to false, this extension will be disabled
        'enable' => true,
        'tinymce' => [
            'editor' => [
                'plugins' => 'table lists link image media wordcount',
                'toolbar' => 'undo redo | formatselect| bold italic underline strikethrough forecolor backcolor | alignleft aligncenter alignright alignjustify | indent outdent | bullist numlist | code | table | image media link',
            ],
            'editor' => [
                'upload' => 'mr4.lax.tinymce.upload',
                'store' => 'public/mr4lax/tinymce',
            ],
        ],
    ],
],
```
The configuration of plugins and toolbar of the editor can be found in [TinyMCE Document](https://www.tiny.cloud/docs/tinymce/6/basic-example/)

## Usage
Use it in the form:
```php
$form->tinymce('content')
  ->rows(5)
  ->attribute([
      'menubar' => 'true',
      'statusbar' => 'true',
  ]);
```

## License
Licensed under The [MIT License (MIT)](https://github.com/han48/mr4-lax.tiny-mce/blob/main/LICENSE).
