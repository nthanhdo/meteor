NeoLibrary
==========

## Synopsis

A Test Package for Mod 10, designed to create HTML elements such as tables, dropdowns, and links.


## Getting the Code

### Via GitHub

    git clone git@github.com:NeoMeteor/library.git

### Via Packagist

* Add the dependency to composer.json (see https://packagist.org/packages/neometeor/library)
* You can also download to the application using the Composer command, `php composer require neometeor/library`

## Installation
1. First, add `Neometeor\Library\NeoLibraryServiceProvider::class,` to the `providers` section of the application's `config/app.php` file
    1. You may also need to add `Collective\Html\HtmlServiceProvider::class,` to the `providers` section, if the application does not already contain it (only if Composer had to also install the `illuminate/html` package when this was installed)
2. Next, add `'NeoLibrary' => Neometeor\Library\NeoLibrary::class,` to the `alias` section of the application's `config/app.php` file
    1. You may also need to add both `'Form' => Collective\Html\FormFacade::class,` AND `'Form' => Collective\Html\FormFacade::class,` to the `alias` section, if the application does not already contain it (only if Composer had to also install the `illuminate/html` package when this was installed)
3. Then, run `php composer update` (or whatever command your application uses to update its installed packages)

__NOTE:__ After you've installed the package to the application, you should then follow up by: installing the vendor files to the application, using `vendor publish`.

## Code Usage

###### In PHP
```php
table($multiArray, $restrict = null, $orderBy = null, $sort = null);
```
###### In Blade Views
```blade
{!! Neometeor\Library\NeoLibrary::table($multiArray, $restrict) !!}
```
## Documentation

Currently, these are the following available package __functions__:

* table(__array__ _$multiArray_, __array__ _$restrict_ = __null__)
* dropdown(_$name_, __array__ _$options_)
* link(_$text_, _$target_, __array__ _$options_ = __null__)
* textfield(_$name_, _$content_, __array__ _$options_ = __null__)
* label(_$content_, _$for_, __array__ _$options_ = __null__)
* prettyUC(_$str_)
* webReadyText(_$str_)
* sortByKey(_$a_, _$b_)

__NOTE:__ There are also currently test functions, used to showcase `NeoLibrary`'s potential. They aren't mandatory for use. Those functions are:

* _testArray()_
* _testRestrict()_
* _testOrderBy()_
* _testDropdown()_
* _testTextfield()_

##### table(_$multiArray_, _$restrict_ = __null__)
Creates a simple HTML table using the arrays inside `$multiArray`. It can accept numerous revisions and options:

* The only required variable, `$multiArray` should be a multidimensional collections of similar arrays, that can be sorted and output as a HTML table
* `$restrict` is an array of `$multiArray` key names, used to remove the associated column from the generated `table()`

##### dropdown(_$name_, _$options_)
Creates a simple HTML dropdown using an array, `$options`:

* `$name` is the desired name for the dropdown, to be placed within the HTML tag
* `$options` is an array used to create the dropdown’s list of options. The `$value` is used as the option’s web id, and the `$text` is the way a User would see the option on the site. EX: `<option value = "$value"> $text </option >`

##### link(_$text_, _$target_, _$options_ = __null__)
Creates a simple HTML link:

* `$text` is the User-visible text that the user will see on the site
* `$target` is a string URL of the link’s path.
* `$options` is an optional array that should contain `<a>` tag attributes that could be used for CSS styling. EX: `$options = array(“class” => “boldlink”), leading to an HTML output of <a href=“/desired_target” class=“boldlink”> [Desired Text] </a>`

##### textfield(_$name_, _$content_, _$options_ = __null__)
Creates an editable Textfield box:

* `$name` is the name of the HTML textfield, to be placed within the HTML textfield tag
* `$content` is anything you’d like the text field to display to the User by default
* `$options` is an optional array that should contain `<textfield>` tag attributes that could be used for CSS styling. *Same as Link*

##### label(_$content_, _$for_, _$options_ = __null__)
Creates a label that can be used in varying ways:

* `$content` is the text output for the label
* `$for` is the specific desired value for the label’s `for` tag
* `$options` is an optional array that should contain `<label>` tag attributes that could be used for CSS styling. *Same as Link*

##### prettyUC(_$str_)
Takes the input `$str`, usually from databases or HTML tags, and:

1. Strips any underscores, replacing them with spaces (whitespace)
2. Capitalizes every word, so that it looks good enough to display elsewhere

##### webReadyText(_$str_)
Takes the input `$str`, and:

1. Replaces the spaces (whitespace) between words with underscores
2. Replaces any capitalized characters with it’s lower-cased equivalent

##### sortByKey(_$a_, _$b_)
Used by `table()` in the sorting and ordering of its `$multiArray`

The test methods are used in to help give examples of how the NeoLibrary methods work in views, with an example view located in `src/views/neolibrary.blade.php`