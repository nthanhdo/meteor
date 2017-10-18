<?php
return [
    'providers' => [

        Neometeor\Library\NeoLibraryServiceProvider::class,
        Collective\Html\HtmlServiceProvider::class
    ],

    'aliases' => [
        'NeoLibrary' => Neometeor\Library\NeoLibrary::class,
        'Form' => Collective\Html\FormFacade::class,
        'Html' => Collective\Html\HtmlFacade::class,
    ],
];
