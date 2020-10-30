# Json Field for Backpack 4

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]

This package provides a ```json``` field type for the [Backpack for Laravel](https://backpackforlaravel.com/) administration panel.

## Screenshots

## Installation

Via Composer

``` bash
composer require ziming/json-field-for-backpack
```

## Usage

Inside your custom CrudController:

```php
$this->crud->addField([
     'name'  => 'column_name',
     'type'  => 'json_editor',
     'modes' => ['form', 'tree', 'code'], // Optional. 1st item will be the default mode
     
    // Optional. default json value in php array style.

    // If there is an actual value in the json column, it will do an 
    // array_merge_recursive. With the json column values replacing the 
    // ones with the same keys
    'default' => [], // Optional. default json value in php array style.
    'view_namespace' => 'json-field-for-backpack::fields',
]);
```

Notice the ```view_namespace``` attribute - make sure that is exactly as above, to tell Backpack to load the field from this _addon package_, instead of assuming it's inside the _Backpack\CRUD package_.


## Overwriting

If you need to change the field in any way, you can easily publish the file to your app, and modify that file any way you want. But please keep in mind that you will not be getting any updates.

**Step 1.** Copy-paste the blade file to your directory:
```bash
# create the fields directory if it's not already there
mkdir -p resources/views/vendor/backpack/crud/fields

# copy the blade file inside the folder we created above
cp -i vendor/ziming/json-field-for-backpack/src/resources/views/fields/json.blade.php resources/views/vendor/backpack/crud/fields/json.blade.php
```

**Step 2.** Remove the vendor namespace wherever you've used the field:
```diff
$this->crud->addField([
-   'view_namespace' => 'json-field-for-backpack::fields'
]);
```

**Step 3.** Uninstall this package. Since it only provides one file - ```json.blade.php```, and you're no longer using that file, it makes no sense to have the package installed:

```bash
composer remove ziming/json-field-for-backpack
```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.


## Security

If you discover any security related issues, please email [the author](composer.json) instead of using the issue tracker.

## Credits

- [ziming](https://github.com/adoptavia) - Created the initial field type
- [vesper8](https://github.com/vesper8) - Polished & fixed bugs in the field type to allow multiple instances of the field
- [stephanus-stuff](https://github.com/stephanus-stuff) - For updating the field type to be compatible with Backpack 4.0 and 4.1
- [Cristian Tabacitu](https://github.com/tabacitu) - For being the creator of Backpack.
- [josdejong](https://github.com/josdejong) - For creating [jsoneditor](https://github.com/josdejong/jsoneditor)

- [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/ziming/json-field-for-backpack.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/ziming/json-field-for-backpack.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/ziming/json-field-for-backpack
[link-downloads]: https://packagist.org/packages/ziming/json-field-for-backpack
[link-author]: https://github.com/ziming
[link-contributors]: ../../contributors
