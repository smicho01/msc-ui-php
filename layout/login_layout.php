<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>AcademiChain - Students Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <link href="<?php echo CSS_DIR; ?>/dashboard.css" rel="stylesheet" />
    <link href="<?php echo CSS_DIR; ?>/style.css" rel="stylesheet" />
</head>
<body>
<div class="container" id="loginpage">
  <div class="main">
  
   <div class="col-md-6 col-sm-12">
      <div class="login-form">
        <div id="logo-wrapper">
            <img src="public/img/academi-chain-logo.webp" width="350" />
        </div>
        <div class="text-center"><h1>AcademiChain</h1> </div>
          <?php
          if(isset($_GET['msg'])) {
              echo $_GET['msg'];
          }
          if(isset($_SESSION['message'])) {
              echo  $_SESSION['message'];
          }
          ?>
         <form id="loginforms" action="index.php?c=login&v=process" method="post">
            <div class="form-group">
               <label>User Name</label>
               <input id='editUsername' name="username" type="text" class="form-control" placeholder="User Name" value="smicho01">
            </div>
            <div class="form-group">
               <label>Password</label>
               <input id='editPassword' name="password" type="password" class="form-control" placeholder="Password" value="password123">
            </div>
            <div class="form-group d-grid gap-2 d-md-flex justify-content-md-end">
              <button id="btnLogins" class="btn btn-black" type="submit">Login</button>
            </div>
         </form>
      </div>
   </div>
</div>
</div>
</body>
</html>