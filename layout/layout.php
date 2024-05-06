<!doctype html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title th:text="#{app.name}">AcademiChain</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="<?php echo CSS_DIR; ?>/dashboard.css" rel="stylesheet">
    <link href="<?php echo CSS_DIR; ?>/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="<?php echo JS_DIR; ?>/app.js"></script>
</head>
<body>
<div id="modalsHolder"></div>
<!-- header -->
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/" th:text="#{app.name}">AcademiChain</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-nav">
        <?php if(isUserLoggedIn()): ?>
            <a class="btnLogout btn btn-danger btn-sm" style="margin-right:20px;">Sign out</a>
        <?php else: ?>
            <a href="index.php?c=login" class="btn btn-success btn-sm" style="margin-right:20px;">Sign in</a>
        <?php endif; ?>
    </div>
</header>
<!-- end header -->


<div class="container-fluid">
    <div class="row">

        <!-- Sidebar Nav -->
        <?php include_once("_sidebar_nav.php"); ?>
        <!-- end Sidebar Nav -->

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" id="page">
            <div class="row">
                <?php if (isUserLoggedIn()): ?>
                    <div class="row userbar">
                        <div class="col-12">
                            <h4>User: <?php echo academichain_user('name') ?> visible
                                as: <b><?php echo academichain_user('visibleUsername'); ?></b></h4>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="row">
                <div id="alerts" class="col-12">
                    <?php

                    if (isset($_COOKIE['msg'])) {
                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
                        echo $_COOKIE['msg'];
                        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                        echo '</div>';
                    }
                    ?>
                </div>

                <?php include_once(VIEWS_DIR . DS . $CONTROLLER . DS . $VIEW . ".php"); ?>
            </div>

        </main>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<script src="<?php echo JS_DIR; ?>/login.js"></script>
<?php
if (isset($jsfiles)) {
    foreach ($jsfiles as $file) {
        echo '<script src="' . JS_DIR . '/' . $file . '.js"></script>';
    }
}
?>
</body>
</html>