<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="<?php echo CSS_DIR; ?>/style.css" rel="stylesheet">
    <title><?php echo $APPLICATION_NAME; ?> PHP Client</title>
</head>
<body>

<div class="container">
    <?php if (MODE == 'dev') {
        print_r($_SESSION);
    } ?>

    <?php if (isUserLoggedIn()): ?>
        <div class="row">
            <div class="col-6">
                <h4>User: <?php echo academichain_user('name') ?></h4>
            </div>
            <div class="col-6 position-relative">
                <button id="btnLogout" class="btn btn-danger position-absolute top-0 end-0 btn-jquery">Logout</button>
            </div>
        </div>
    <?php endif; ?>
    <?php include_once(VIEWS_DIR . DS . $CONTROLLER . DS . $VIEW . ".php"); ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?php echo JS_DIR; ?>/app.js"></script>
<script src="<?php echo JS_DIR; ?>/items.js"></script>
<script src="<?php echo JS_DIR; ?>/login.js"></script>
</body>
</html>