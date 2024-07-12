<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title><?php echo $APPLICATION_NAME; ?></title>
    <script src="<?php echo JS_DIR; ?>/popper.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link href="<?php echo CSS_DIR; ?>/dashboard.css" rel="stylesheet">
    <link href="<?php echo CSS_DIR; ?>/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="<?php echo JS_DIR; ?>/app.js"></script>
</head>
<body>
<div id="modalsHolder"></div>
<!-- header -->
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 app-name" href="/"">
        <img src="/public/img/academi-chain-logo-inversed.webp" width="40" />
        <?php echo $APPLICATION_NAME; ?>
    </a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-nav">
        <?php if(isUserLoggedIn()): ?>
            <a class="btnLogout btn btn-danger btn-sm" style="margin-right:20px;"><i class="fa-solid fa-arrow-right-from-bracket"></i> Sign out</a>
        <?php else: ?>
            <a href="index.php?c=login" class="btn btn-success btn-sm" style="margin-right:20px;"><i class="fa-solid fa-arrow-right-to-bracket"></i> Sign in</a>
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
                <div id="alerts" class="col-12">
                    <?php

                    if (isset($_COOKIE['msg'])) {
                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
                        echo $_COOKIE['msg'];
                        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                        echo '</div>';
                    }
                    ?>
                    <?php if($FLASH) {
                        FlashMessage::read();
                    } ?>
                </div>

                <div class="col-12 view-wrap">
                    <div class="row">
                        <div class="col-xl-9 col-lg-9">
                            <!-- USER SIDEBAR -->
                            <?php if(isUserLoggedIn()):?>
                                <?php include("searchbar.php"); ?>
                            <?php endif; ?>
                            <!-- //USER_SIDEBAR -->
                            <?php
                            // include view file if present , otherwise fallback view file
                            $viewFilePath = VIEWS_DIR . DS . $CONTROLLER . DS . $VIEW . ".php";
                            if(file_exists($viewFilePath)) {
                                include_once(VIEWS_DIR . DS . $CONTROLLER . DS . $VIEW . ".php");
                            } else {
                                include_once(VIEWS_DIR . DS . "no-view-file.php");
                            }
                            ?>
                        </div>
                        <?php include("_sidebar_right.php"); ?>

                </div>
            </div>

        </main>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>


<?php
if(isset($jsfilesExternal)) {
    foreach ($jsfilesExternal as $file) {
        echo '<script src="' . $file . '"></script>';
        }
}
?>

<script src="<?php echo JS_DIR; ?>/login.js"></script>
<script src="<?php echo JS_DIR; ?>/search.js"></script>
<?php
if (isset($jsfiles)) {
    foreach ($jsfiles as $file) {
        echo '<script src="' . JS_DIR . '/' . $file . '.js"></script>';
    }
}
?>
</body>
</html>