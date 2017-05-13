<html>
    <head>
        <meta charset="UTF-8">
        <title>
            <? if($page_type=="login"): ?>
                <? echo "Post-it | Login"; ?>
            <? elseif($page_type=="dashboard"): ?>
                <? if(empty($logged_blogger_data[0]['uname'])): ?>
                    <? echo $viewed_blogger_data[0]['uname']; ?> | Dashboard
                <? else: ?>
                    <? echo $viewed_blogger_data[0]['uname']; ?> | Dashboard
                <? endif; ?>
            <? elseif($page_type=="unknown"): ?>
                <? echo "Post-it | Not found!"; ?>
            <? else: ?>
                <? echo "Post-it" ?>
            <? endif; ?>
        </title>
        <link rel="icon" href='<?php echo site_url() . 'assets/img/postit.png'; ?>'>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- font awesome -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <!-- google fonts -->
        <link href="https://fonts.googleapis.com/css?family=<? echo (!empty($viewed_blogger_data[0]['font_preference']) ? str_replace(' ', '+', $viewed_blogger_data[0]['font_preference']) : 'Lato') ?>" rel="stylesheet">
        <!-- bootstrap 3.0.2 -->
        <link rel='stylesheet' type='text/css' href='<?php echo site_url() . 'assets/css/bootstrap.css'; ?>'>
        <link rel="stylesheet" type="text/css" href='<?php echo site_url() . 'assets/css/animate.min.css'; ?>'>
        <? if($page_type=="login"): ?>
            <? echo "<link rel='stylesheet' type='text/css' href='". base_url() ."assets/css/header.css'; ?>"; ?>
            <? echo "<link rel='stylesheet' type='text/css' href='". site_url() ."assets/css/jquery.fullPage.css'>; ?>"; ?>
        <? elseif($page_type=="dashboard"): ?>
            <? echo "<style>"; ?>
            <? echo ".blog-masthead{background-color:" . $viewed_blogger_data[0]['color_preference'] ."!important ;}"; ?>
            <? echo ".dropdown-menu a:hover{color:". $viewed_blogger_data[0]['color_preference'] .";}"; ?>
            <? echo ".blog-title, .blog-description{font-family:" . $viewed_blogger_data[0]['font_preference'] . ";}"; ?>
            <? echo ".blog-post-menu:hover{font-family:" . $viewed_blogger_data[0]['color_preference'] . ";}"; ?>
            <? echo "</style>"; ?>
            <? echo "<link rel='stylesheet' type='text/css' href='". base_url() ."assets/css/dashboard.css'; ?>"; ?>
        <? elseif($page_type=="unknown"): ?>
            <? echo "<link rel='stylesheet' type='text/css' href='". base_url() ."assets/css/unknown.css'; ?>"; ?>
        <?endif;?>
    </head>
<body class="animated fadeIn">
         