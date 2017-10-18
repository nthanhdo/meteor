<?php
Route::get('neolibrary', function () {
    return view('neometeor/library/neolibrary', [
        'multiArray' => NeoLibrary::testArray(),
        'restrict' => NeoLibrary::testRestrict(),
        'options' => NeoLibrary::testDropdown(),
        'content' => NeoLibrary::testTextfield(),
    ]);
});
