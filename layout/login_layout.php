<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title th:text="#{app.name}" >Academi-Link - Students Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="<?php echo CSS_DIR; ?>/dashboard.css" rel="stylesheet">
    <link href="<?php echo CSS_DIR; ?>/style.css" rel="stylesheet">
</head>
<body>

<div class="container" id="loginpage">
  <div class="main">
  
   <div class="col-md-6 col-sm-12">
      <div class="login-form">
        <div id="logo-wrapper">
        
        </div>
        <div class="col-md-6 col-sm-12"><h1>AcademiChain</h1> </div>
         <form id="loginform" action="/" >
            <div class="form-group">
               <label>User Name</label>
               <input id='editUsername' type="text" class="form-control" placeholder="User Name" value="smicho01">
            </div>
            <div class="form-group">
               <label>Password</label>
               <input id='editPassword' type="password" class="form-control" placeholder="Password" value="password123">
            </div>
            <div class="form-group d-grid gap-2 d-md-flex justify-content-md-end">
              <button id="btnLogout" class="btn btn-red" type="button">Clear Session</button>
              <button id="btnLogin" class="btn btn-black" type="submit">Login</button>
            </div>
         </form>
      </div>
   </div>
</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="<?php echo JS_DIR; ?>/app.js"></script>
    <script src="<?php echo JS_DIR; ?>/login.js"></script>
    <?php 
    if(isset($jsfiles)) {
        foreach($jsfiles as $file) {
            echo '<script src="'. JS_DIR .'/' . $file . '.js"></script>';
        }
    }
?>
</body>
</html>