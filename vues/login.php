<html>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <!--<link rel="stylesheet" href="./css/PersonnalRule.css" type="text/css" >-->
  <link rel="stylesheet" href="./css/bootstrap/stylesheets/styles.css" type="text/css" >
  <script src="./css/jquery-1.12.1.min.js"></script>
  <script type="text/javascript">
  $(function () {
      $('[data-toggle="tooltip"]').tooltip()
  })
 </script>

<head>
  <meta http-equiv="Content-Language" content="en-ca">
  <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
  <meta name="GENERATOR" content="Microsoft FrontPage 4.0">
  <meta name="ProgId" content="FrontPage.Editor.Document">
  <title>Log in</title>
</head>

<body class= "background-image">
  <?php
    include("./vues/nav.php");
  ?>
    <div class="container">
      <?php
      if (ISSET($_REQUEST["success"]) && ($_REQUEST["success"] == true)) include("./vues/confirmationModal.php");
      ?>
      <form method="post" id="Login" action="">
        <div class = "padding-login-menu">
          <div class= "col-xs-12 col-md-4 ">
            <div class="panel panel-default">
              <div class="panel-heading"><h3>Log in</h3></div>
              <div class="panel-body">
                <img src="./images/stark logo.png" class="img-responsive img-circle logo-test" alt="logo" width="100" height="100">
                <div class="input-group padding-input-login">
                  <span class="input-group-addon" id="User"><span class="glyphicon glyphicon-user"></span></span>
                  <input name="User"type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1" data-toggle="tooltip" data-placement="top" title="Entrez votre nom d'utilisateur">
                </div>
                <?php
                  if((ISSET($_REQUEST["field_messages"]["username"])) && ($_REQUEST["field_messages"]["username"] == true)) echo "<div class='alert custom-alert alert-danger' id = 'userAlert'role='alert'><span class='glyphicon glyphicon-exclamation-sign'></span><strong>  Bad Username</strong></div>"
                ?>
                <div class="input-group padding-input-login">
                  <span class="input-group-addon" id="Pass"><span class="glyphicon glyphicon-lock"></span></span>
                  <input name="Pass" type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon2" data-toggle="tooltip" data-placement="top" title="Entrez votre password">
                </div>
                <?php
                  if((isset($_REQUEST["field_messages"]["password"])) && ($_REQUEST["field_messages"]["password"] == true)) echo "<div class='alert custom-alert alert-danger' role='alert' id ='passwordAlert' ><span class='glyphicon glyphicon-exclamation-sign'></span><strong>  Bad Password</strong></div>"
                ?>
                <div class=" padding-input-login">
                  <input name="pageProjet" type = "hidden" value="0">
                  <input name="action" class="btn btn-lg btn-success btn-block" type="submit" value="connecter">
                </div>
              </div>
            </div>
          </div>
        </div>
    </form>
    <?php
      include("./vues/createAccountPanel.php");
    ?>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <?php
    if (ISSET($_REQUEST["success"]) && ($_REQUEST["success"] == true)){
      echo "<script type='text/javascript'> $('.bs-example-modal-sm').modal('toggle') </script>";
      //unset($_REQUEST["Success"]);
    }  
    ?>
</body>

</html>