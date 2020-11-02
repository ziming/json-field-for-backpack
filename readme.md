# JSON Field for Backpack 4

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]

This package provides a ```json``` field type for the [Backpack for Laravel](https://backpackforlaravel.com/) administration panel. The field allows the admin to manually edit the contents of a column where a JSON is stored, using the [`josdejong/jsoneditor`](https://github.com/josdejong/jsoneditor) JS plugin. That means they'll have:
- multiple modes of viewing the JSON (code, tree, form)
- syntax highlighting
- indented code
- color picker
- searching
- undo & redo
- etc.

Of course, this field should only be used when the admin is savvy enough to know what JSON is. Otherwise they can completely mess up the structure/format of the JSON stored in the database column.

## Screenshots

![https://user-images.githubusercontent.com/1032474/97699650-e2e92b80-1a80-11eb-8320-3ac35e8a59a1.gif](https://user-images.githubusercontent.com/1032474/97699650-e2e92b80-1a80-11eb-8320-3ac35e8a59a1.gif)

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
    'type'  => 'json',
    'view_namespace' => 'json-field-for-backpack::fields',
    
    // OPTIONAL
    
    // Which modes should the JsonEditor JS plugin allow?
    // Please note that the first mode in the array will be used as the default mode.
    'modes' => ['form', 'tree', 'code'],
     
    // Default value, if needed. If there is an actual value in the json column, 
    // it will do an array_merge_recursive(), with the json column values 
    // replacing the ones with the same keys.
    'default' => [],
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

- [ziming](https://github.com/ziming) - Created the initial field type
- [vesper8](https://github.com/vesper8) - Polished & fixed bugs in the field type to allow multiple instances of the field
- [stephanus-stuff](https://github.com/stephanus-stuff) - For updating the field type to be compatible with Backpack 4.0 and 4.1
- [Cristian Tabacitu](https://github.com/tabacitu) - For creating Backpack.
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
