<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{$title}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="/templates/Default/css/materialize.css?t={$time}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <!--<script src="{$theme_path}/js/script.js"></script> -->

    <script src="/templates/Default/js/script.js?t={$time}"></script>
    <link rel="stylesheet" href="/templates/Default/css/styles.css?t={$time}">

    <!-- ONLY FOR DEV -->
    <script src="/templates/Default/js/admin-script.js?t={$time}"></script>


</head>
<body>

<header>
    <nav>
        <div class="nav-wrapper">
            <a href="/" class="brand-logo">IE23S Shop</a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <li><a href="sass.html">Sass</a></li>
                <li><a href="badges.html">Components</a></li>
                <li><a href="collapsible.html">Javascript</a></li>
                <li><a href="mobile.html">Mobile</a></li>
                <li><a href="https://shop.ie23s.com/administrator/categories/?admin=ok">Admin</a></li>
            </ul>
        </div>
    </nav>
    <ul class="sidenav" id="mobile-demo">
        <li><a href="sass.html">Sass</a></li>
        <li><a href="badges.html">Components</a></li>
        <li><a href="collapsible.html">Javascript</a></li>
        <li><a href="mobile.html">Mobile</a></li>
        <li><a href="https://shop.ie23s.com/administrator/categories/?admin=ok">Admin</a></li>
    </ul>
</header>
{$content}
</body>
</html>