<!DOCTYPE html>
<html>
<head>
    <title>Relay Control</title>
    <link rel="shortcut icon" href="/assets/images/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/assets/css/style.css"/>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">Relay Control</a>
                </div>

                <div class="collapse navbar-collapse" id="header-navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="<?php echo ($current_page == 'boards') ? 'active' : '';?>">
                            <a href="/">My Boards</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="<?php echo ($current_page == 'add_board') ? 'active' : '';?>"><a href="/boards/new/">Add new Board</a></li>
                    </ul>
                </div>
            </div>
        </nav>