@extends('neometeor.library.layouts.top_page')

@section('content')

    <h1>{!! Neometeor\Library\NeoLibrary::label('Some People', 'page_title') !!}</h1>
    <hr>
    {!! Neometeor\Library\NeoLibrary::table($multiArray, $restrict) !!}
    {!! Neometeor\Library\NeoLibrary:: dropdown('This is a Dropdown', $options) !!}
    <div id="selection" class="selection"></div>
    {!! Neometeor\Library\NeoLibrary::textfield('This is a Text Field', $content) !!}

@endsection
