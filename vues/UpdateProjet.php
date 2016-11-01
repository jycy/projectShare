<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" href="./css/bootstrap/stylesheets/styles.css" type="text/css" >
<script src="./css/jquery-1.12.1.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

 <script type="text/javascript">
 	$(function () {
  		$('[data-toggle="tooltip"]').tooltip()
	})
 </script>
 <script type="text/javascript">
	 $('.selectpicker').selectpicker({
	  	style: 'btn-default',
	});

 </script>

</head>

<body class= "background-image">
	<?php
		include("./vues/nav.php");
		require_once('./modele/ProjetDAO.class.php');
		require_once('./modele/classes/Projet.class.php');
		require_once('./modele/VideoDAO.class.php');
		require_once('./modele/classes/Video.class.php');
		require_once('./modele/reseauDAO.class.php');
		require_once('./modele/classes/reseau.class.php');
		$pdao = new ProjetDAO();
		$proj = $pdao->find($_REQUEST["projid"]);
		if ($proj != null){
			$vdao = new VideoDao();
			$vid = $vdao->find($proj->getId());
			$rdao = new ReseauDAO();
			$res = $rdao->findByProjet($proj->getId());
	?>
    <div class="container">
    	<form method="get" id="" action="" enctype="multipart/form-data" >
	        <div class = "padding-login-menu">
	          <div class= "col-xs-12 col-md-10 col-md-offset-1 ">
	            <div class="panel panel-default">
	              <div class="panel-heading"><h3>Update du Projet <?php echo $proj->getName();?></h3></div>
	              <div class="panel-body">
	                
	                <div class="input-group padding-input-login">
	                  <span class="input-group-addon" id="Introduction"><span class="glyphicon glyphicon-list-alt"></span></span>
	                  <textarea maxlength="100" name="Introduction" type="text" id = "text-area-intro" class="form-control" placeholder="votre introduction" aria-describedby="basic-addon2" data-toggle="tooltip" data-placement="top" title="Entrez votre introduction du projet (Elle sera affiché lors de la recherche de projet). Maximum de 100 charactères"><?php echo $proj->getIntroduction();?></textarea>
	                </div>

	            	<div class="input-group padding-input-login">
	                  <span class="input-group-addon" id="Description"><span class="glyphicon glyphicon-list-alt"></span></span>
	                  <textarea name="Description" type="text" id = "text-area-description" class="form-control" placeholder="Votre description" aria-describedby="basic-addon2" data-toggle="tooltip" data-placement="top" title="Entrez votre description du projet"><?php echo $proj->getDescription();?></textarea>
	                </div>
	               	<div class = "row">
	               		<div class = "col-xs-6 col-sm-8">
			                <div id = 'input-video-youtube' class="input-group padding-input-login">
			                  <span class="input-group-addon" id="video"><span class="glyphicon glyphicon-film"></span></span>
			                  <input name="video" <?php if ($vid != null) echo "value ='".$vid->getUrl()."'";?> type="text" class="form-control" placeholder="Lien vidéo youtube" aria-describedby="basic-addon1" data-toggle="tooltip" data-placement="top" title="Entrez lien video (lien youtube)">
			                </div>
		                </div>
		                <div class = "col-xs-6 col-sm-4">
		                	<div class="padding-input-login" id= 'div-btn-youtube'>
		                		<button id = 'btn-youtube'type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalTutoriel">Tutoriel youtube</button>
		                	</div>
		                </div>
		            </div>
		                <div class='modal fade' id = 'ModalTutoriel' tabindex='-1' role='dialog' aria-labelledby='myLargeModalLabel'>
							<div class='modal-dialog modal-lg'>
								<div class='modal-content'>
									<img class = 'img-responsive col-xs-12' src = './images/Youtube.png'/>
								</div>
							</div>
						</div>
		            
	                <div class = "row">
	                    <div class = "col-xs-6 col-sm-8">
			                <div class="input-group padding-input-login" id = "input-group-reseau">
			                	<span class="input-group-addon" id="reseau"><span class="glyphicon glyphicon-film"></span></span>
			                	<input name="reseauInput" <?php if ($res != null) echo "value ='".$res->getUrl()."'";?> type="text" class="form-control" placeholder="Lien réseau" aria-describedby="basic-addon1" data-toggle="tooltip" data-placement="top" title="Entrez un lien de reseaux sociaux">
			                </div>
		             	</div>
		             	<div class = "col-xs-6 col-sm-4">
		                	<div class="padding-input-login">
		                		<div class="btn-selector">
			                		<select class = "selectpicker" data-width="100%" name="reseau">
										<option data-content="<i class='fa fa-facebook-square fa-lg' aria-hidden='true'></i>  Facebook" value="Facebook"></option>
										<option data-content="<i class='fa fa-twitter-square fa-lg' aria-hidden='true'></i>  Twitter" value="Twitter"></option>
										<option data-content="<i class='fa fa-youtube-play fa-lg' aria-hidden='true'></i>  Youtube" value="Youtube"></option>
										<option data-content="<i class='fa fa-google-plus-square fa-lg' aria-hidden='true'></i>  Google+" value="Google+"></option>
									</select>
								</div>
							</div> 	
		              	</div>
	              	</div>
	              	<div class="input-group padding-input-login">
		                <div id="prev">
								
						</div>
					</div>
	              	<div class="input-group padding-input-login">
		              	<div class="fileUpload btn btn-default">
			                <span>Miniature de projet</span>
			                <input name ="miniatureup" id= "file" type="file" class="upload" accept="image/jpg, image/jpeg, image/gif, image/png" />
		                </div>
	                </div>		

	                <div class=" padding-input-login">
	                	<input name="projetid" <?php echo "value=".$proj->getId();?> type="hidden">
	                	<input name="update" value="valide" type="hidden">
	                	<input name="action" value="updater" type="hidden" />
	                 	<button type = "submit" class = "btn btn-lg btn-default btn-block">Updater le projet</button>
	                </div>
	            </div>
	          </div>
	        </div>
    	</form>
    </div>
    <?php
	}
	else header('Location: ./?action=afficher&pageCommentaire=0&pageProjet=0&erreur=10');
	?>
	

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
            //if (document.getElementById("file").value == "") {
            //	prev.removeChild(prev.childNodes[0]);
            //}

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