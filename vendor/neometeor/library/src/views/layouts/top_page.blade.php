<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Squaretown</title>
    {!! Html::style('/neometeor/library/neometeor.css') !!}
</head>
<body>
<nav>
    <div>
        <div>
            <!-- Branding Image -->
            {!! NeoLibrary::link('Squaretown', '/', array("class" => "neologo")) !!}
        </div>
        <div>
            <!-- Left Side Of Navbar -->
            <ul>
                <li>{!! NeoLibrary::link('Home', '/') !!}</li>
            </ul>
            <!-- Right Side Of Navbar -->
            <ul>
                <li>{!! NeoLibrary::link('Logout', '/logout', array("class" => "italic")) !!}</li>
            </ul>
        </div>
    </div>
</nav>
<div>
    @yield('content')
</div>

<!-- JavaScripts -->
{!! Html::script('/neometeor/library/selection_script.js') !!}
</body>
</html>