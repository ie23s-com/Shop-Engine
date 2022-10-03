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
    <div class="progress">
        <div class="indeterminate"></div>
    </div>
    <!-- Dropdown Structure -->
    <ul id='profile-dropdown' class='dropdown-content ie23s-margin-64'>
        {if $currentUser->hasPermission('admin')}
            <li><a href="/administrator/">Admin</a></li>
        {/if}
        <li><a href="/logout">Logout</a></li>
    </ul>
    <nav>
        <div class="nav-wrapper">
            <a href="/" class="brand-logo">IE23S Shop</a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">

                <li><a href="#" class="login unAuth {if $isAuth}hidden{/if}">Sign in</a></li>
                <li><a href="#" class="register unAuth {if $isAuth}hidden{/if}">Sign up</a></li>
                <li>
                    <a href="#" class="profile authOnly dropdown-trigger {if ! $isAuth}hidden{/if}"
                       data-target='profile-dropdown'>Profile</a>

                </li>

                <li></li>
            </ul>
        </div>
    </nav>
    <ul class="sidenav" id="mobile-demo">
        <li><a href="#" class="login">Sign in</a></li>
        <li><a href="#" class="register">Sign up</a></li>
    </ul>
</header>
<div id="auth-div" class="modal" style="max-width: 800px;">
    <div class="progress" style="display: none">
        <div class="indeterminate"></div>
    </div>
    <div class="modal-content">
        <div class="content"></div>
    </div>
</div>
{$content}
</body>
</html>