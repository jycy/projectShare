<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" href="./css/bootstrap/stylesheets/styles.css" type="text/css" >
<script src="./css/jquery-1.12.1.min.js"></script>

 <script type="text/javascript">
 	$(function () {
  		$('[data-toggle="tooltip"]').tooltip()
	})
 </script>

 

</head>

<body class= "background-image">
	<?php
		include("./vues/nav.php");
	?>
    <div class="container">
    	<form method="post" id="createNewAccount" action="" enctype="multipart/form-data">
	        <div class = "padding-login-menu">
	          <div class= "col-xs-12 col-md-5 col-md-offset-4 ">
	            <div class="panel panel-default">
	              <div class="panel-heading"><h3>Create account</h3></div>
	              <div class="panel-body">
	                <img src="./images/stark logo.png" class="img-responsive img-circle logo-test" alt="logo" width="100" height="100">

	                <div class="input-group padding-input-login">
	                  <span class="input-group-addon" id="User"><span class="glyphicon glyphicon-user"></span></span>
	                  <input name="newUser"type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1" data-toggle="tooltip" data-placement="top" title="Entrez un nom d'utilisateur">
	                </div>
	                <?php
	                  if((ISSET($_REQUEST["CreateError"]["newUserName"])) && ($_REQUEST["CreateError"]["newUserName"] == true)) echo "<div class='alert custom-alert alert-danger' id = 'userAlert'role='alert'><span class='glyphicon glyphicon-exclamation-sign'></span><strong>User already exist or field empty</strong></div>";
	                ?>

	            	<div class="input-group padding-input-login">
	                  <span class="input-group-addon" id="email">@</span>
	                  <input name="Email" type="email" class="form-control" placeholder="email" aria-describedby="basic-addon2" data-toggle="tooltip" data-placement="top" title="Entrez votre adresse couriel">
	                </div>
	                <?php
	                  if((ISSET($_REQUEST["CreateError"]["Email"])) && ($_REQUEST["CreateError"]["Email"] == true)) echo "<div class='alert custom-alert alert-danger' id = 'userAlert'role='alert'><span class='glyphicon glyphicon-exclamation-sign'></span><strong>Email already used or field empty</strong></div>";
	                ?>
	                <div class="input-group padding-input-login">
	                  <span class="input-group-addon" id="Pass"><span class="glyphicon glyphicon-lock"></span></span>
	                  <input name="Pass" type="Password" class="form-control" placeholder="Password" aria-describedby="basic-addon2" data-toggle="tooltip" data-placement="top" title="Entrez un password. Ex: JadoreJc101">
	                </div>
	                <?php
	                  if((ISSET($_REQUEST["CreateError"]["Pass"])) && ($_REQUEST["CreateError"]["Pass"] == true)) echo "<div class='alert custom-alert alert-danger' id = 'userAlert'role='alert'><span class='glyphicon glyphicon-exclamation-sign'></span><strong>Password doesn't match or field empty</strong></div>";
	                ?>

	                <div class="input-group padding-input-login">
	                  <span class="input-group-addon" id="Pass"><span class="glyphicon glyphicon-lock"></span></span>
	                  <input name="ConfirmPass" type="Password" class="form-control" placeholder="Confirm Password" aria-describedby="basic-addon2" data-toggle="tooltip" data-placement="top" title="Confirmer password">
	                </div>
	                <div class="input-group padding-input-login">
		                <div id="prev">
								
						</div>
					</div>
	                <div class="input-group padding-input-login">
		                <div class="fileUpload btn btn-default">
						    <span>Avatar</span>
						    <input name = "avatar" accept ="image/jpg, image/jpeg, image/gif, image/png" id= "file" type="file" class="upload" />
						</div>
					</div>

	                <?php
	                  //if((isset($_REQUEST["field_messages"]["password"])) && ($_REQUEST["field_messages"]["password"] == true)) echo "<div class='alert custom-alert alert-danger' role='alert' id ='passwordAlert' ><span class='glyphicon glyphicon-exclamation-sign'></span><strong>  Bad Password</strong></div>"
	                ?>
	                <div class=" padding-input-login">
	                	<input name="action" value="createNewAccount" type="hidden" />
	                  <button type = "submit" class = "btn btn-lg btn-default btn-block">Create account</button>
	                </div>
	              </div>
	            </div>
	          </div>
	        </div>
    	</form>
    </div>
	

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script>
 	(function() {

   function createThumbnail(file) {

        var reader = new FileReader();

        reader.addEventListener('load', function() {

            var imgElement = document.createElement('img');
          
            imgElement.src = this.result;
            prev = document.getElementById("prev");
            if (prev.lastChild != null) {
            	prev.removeChild(prev.childNodes[0]);
            }
            prev.appendChild(imgElement);

        });

        reader.readAsDataURL(file);

    }

    var allowedTypes = ['png', 'jpg', 'jpeg', 'gif'],
        fileInput = document.querySelector('#file'),
        prev = document.querySelector('#prev');

    fileInput.addEventListener('change', function() {

        var files = this.files,
            filesLen = files.length,
            imgType;

        for (var i = 0; i < filesLen; i++) {

            imgType = files[i].name.split('.');
            imgType = imgType[imgType.length - 1];

            if (allowedTypes.indexOf(imgType) != -1) {
                createThumbnail(files[i]);
            }

        }

    });

})();
 </script>
</body>

</html>