<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">

    <title><?php echo $pageTitle; ?></title>
    <meta name="description" content="<?php echo $pageDescription; ?>">
    <meta name="keywords" content="<?php echo $pageKeyboards; ?>"/>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta property="og:image" content="<?php echo $socialImage; ?>" />
    <meta name="twitter:image" content="<?php echo $socialImage; ?>" />
    <meta property="og:site_name" content="www.ag-grid.com" />
    <meta property="og:type" content="website" />
    <meta name="twitter:site" content="@ceolter" />
    <meta name="twitter:creator" content="@ceolter" />
    <meta property="og:url" content="<?php echo $socialUrl; ?>" />
    <meta property="twitter:url" content="<?php echo $socialUrl; ?>" />
    <meta property="og:title" content="<?php echo $pageTitle; ?>" />
    <meta name="twitter:title" content="<?php echo $pageTitle; ?>" />
    <meta property="og:description" content="<?php echo $pageDescription; ?>" />
    <meta name="twitter:description" content="<?php echo $pageDescription; ?>" />
    <meta name="twitter:card" content="summary_large_image" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.8/angular.min.js"></script>

    <link rel="stylesheet" type="text/css" href="/style.css">

    <link rel="shortcut icon" href="https://www.ag-grid.com/favicon.ico" />

</head>

<body  class="big-text">
<!--<body ng-app="index" class="big-text">-->

<?php $navKey = "about"; include 'navbar.php'; ?>

<?php $headerTitle = "About Us: Jobs"; include 'headerRow.php'; ?>

<div class="container">