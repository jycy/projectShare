<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" href="./css/bootstrap/stylesheets/styles.css" type="text/css" >
<script src="./css/jquery-1.12.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

</head>

<body class= "background-image">
	<?php
		include("./vues/nav.php");
	?>	
	<div class="container container-white">
		<?php
			require_once('./modele/classes/Projet.class.php');
			require_once('./modele/classes/Photo.class.php');
			require_once('./modele/classes/Commentaire.class.php');
			require_once('./modele/classes/User.class.php');
			require_once('./modele/classes/Video.class.php');
			require_once('./modele/classes/Liste.class.php');
			require_once('./modele/ProjetDAO.class.php');
			require_once('./modele/reseauDAO.class.php');
			require_once('./modele/classes/reseau.class.php');
			require_once('./modele/CommentaireDAO.class.php');
			require_once('./modele/VideoDAO.class.php');
			require_once('./modele/PhotoDAO.class.php');
			require_once('./modele/UserDAO.class.php');
			$pjdao = new ProjetDAO();
			$photodao = new PhotoDAO();
			$usrdao = new UserDAO();
			$viddao = new VideoDAO();
			$res = new ReseauDAO();
			if (ISSET($_REQUEST["projetid"]))
				$proj = $pjdao->find($_REQUEST["projetid"]);
			if (ISSET($_REQUEST["projetname"]))
				$proj = $pjdao->findByName($_REQUEST["projetname"]);
			
		?>
		<div class='jumboproj'>
			<div class='container'>
				<h1>
					<span class='glyphicon glyphicon-globe'></span>
					<?php if ($proj != null) echo $proj->getName(); else echo "Erreur"; ?>
				</h1>
			</div>
		</div>
		<?php
			if ($proj != null)
			{		
			if (ISSET($_REQUEST["pageCommentaire"]))
			{
				$comdao = new CommentaireDAO();
				$count = $comdao->Ccount($proj->getId());
				$_SESSION["nbpagesCom"]= ceil($count/16);
			}
			$reseau = $res->findByProjet($proj->getId());
			$vid = $viddao->find($proj->getId());
			$usr = $usrdao->findById($proj->getUserId());
			$listephoto = $photodao->findAllByProject($proj->getId(),0);
			$listecommentaire = $comdao->findLimit($proj->getId(),$_REQUEST["pageCommentaire"]);
			echo"<div  class = 'padding-7 col-xs-12'>
					<div class = 'padding-7 col-xs-12 col-md-9'>
						<div class='embed-responsive embed-responsive-16by9'>
							"; if ($vid != null) echo "<iframe class='embed-responsive-item' src='".$vid->getUrl()."?rel=0&amp;showinfo=0' allowfullscreen></iframe>";
					echo "</div>
					</div>";
			echo "<div  class= 'padding-7 col-xs-12 col-md-3'>
  						<div class='panel panel-default'>
    						<div class='panel-body panel-body-projet info-proj'>
    							<h4 class = 'center-ccc'>Projet crée par</h4>";
    								if ($usr->getAvatar() != null)
    								{
    								echo"<div id = 'div-avatar' class = 'col-xs-8 col-xs-offset-2'>
    										<img id = 'avatar' class = 'img-responsive img-circle col-xs-12' src = 'data:".$usr->getExtension().";base64,".base64_encode($usr->getAvatar())."'/>
    									</div>";
    								}
    								else
    								{
    								echo"<div id = 'div-avatar' class = 'col-xs-8 col-xs-offset-2'>
    										<img id = 'avatar' class = 'img-responsive img-circle col-xs-12' src = './images/no-thumbnail.jpg'/>
    									</div>";
    								}
    								echo"<div class = 'col-xs-12'>
    										<h4 ><a class = 'center-ccc' href='./?action=visiterProfil&userVisitId=".$usr->getId()."'>".$usr->getUserName()."</a></h4>
    									</div>";
    									if ($reseau != null){ 
    									echo"
    									<div class = 'col-xs-12'>
    										<h4 >";
    										echo"<a class = 'center-ccc' href='http://".$reseau->getUrl()."'>";
    											if ($reseau->getType() == "Facebook") echo "<i class='fa fa-facebook-square fa-lg' aria-hidden='true'></i>";
	    										elseif ($reseau->getType() == "Twitter") echo "<i class='fa fa-twitter-square fa-lg' aria-hidden='true'></i>";
	    										elseif ($reseau->getType() == "Youtube") echo "<i class='fa fa-youtube-play fa-lg' aria-hidden='true'></i>";
	    										elseif ($reseau->getType() == "Google+") echo "<i class='fa fa-google-plus-square fa-lg' aria-hidden='true'></i>";
    										echo $reseau->getType()."</a></h4>
    									</div>";
    									}

						echo"</div>
						</div>
					</div>
				</div>
				<div class = 'clearfix col-xs-12 col-sm-9'>
					<ul class='nav nav-tabs nav-justified'>
						<li role='presentation' class='active'>
							<a href='#presentation' class = 'a-nav' aria-controls='presentation' role='tab' data-toggle='tab'><strong>Présentation</strong></a>
						</li>
						<li role='presentation'>
							<a href='#photo' class = 'a-nav' aria-controls='photo' role='tab' data-toggle='tab'><strong>Photo</strong></a>
						</li>
						<li role='presentation'>
							<a href='#commentaire' class = 'a-nav' aria-controls='commentaire' role='tab' data-toggle='tab'><strong>Commentaire</strong></a>
						</li>
						<li role='presentation'>
							<a href='#donation' class = 'a-nav' aria-controls='donation' role='tab' data-toggle='tab'><strong>Donation</strong></a>
						</li>
					</ul>
					<div class='tab-content'>
						<div role='tabpanel' class='tab-pane fade in active' id='presentation'>
							<p>".$proj->getDescription()."</p>
						</div>
						<div role='tabpanel' class='tab-pane fade' id='photo'>";
							if ($listephoto != null)
							{	$i = 0;
								while ($listephoto->next())
								{

									$photo = $listephoto->getCurrent();
									$i++;
									if ($photo!=null)
									{
										echo"<a data-toggle = 'modal' data-target='.bs-example-modal-lg-".$photo->getId()."'>
												<div class = 'div-photo-proj col-xs-12 col-sm-6 col-md-4 col-lg-3'>
		    										<img id = 'avatar' class = 'img-responsive col-xs-12' src = 'data:".$photo->getExtension().";base64,".base64_encode($photo->getPhoto())."'/>
		    									</div>
    										</a>


    									<div class='modal fade bs-example-modal-lg-".$photo->getId()."' tabindex='-1' role='dialog' aria-labelledby='myLargeModalLabel'>
											<div class='modal-dialog modal-lg'>
										    	<div class='modal-content'>
										        	<img id = 'avatar' class = 'img-responsive col-xs-12' src = 'data:".$photo->getExtension().";base64,".base64_encode($photo->getPhoto())."'/>";
										        	if ($proj->getUserId() == $_SESSION["idConnecte"]) echo"<a href = './?action=Supprimer&projid=".$proj->getId()."&photoid=".$photo->getId()."'><button class = 'btn btn-danger btn-block'>supprimer</button></a>";
										        echo "
										    	</div>
											</div>
										</div>

    									";
									}
								}
							}
					if ($proj->getUserId() == $_SESSION["idConnecte"])
					echo"<div  id = 'ajout-p' class = 'div-photo-proj col-xs-12 col-sm-6 col-md-4 col-lg-3'>
							<a id = 'ajout-photo' data-toggle = 'modal' data-target='.bs-example-modal-lg-new-img'>
		    					<i class='center-block fa fa-plus-circle fa-5x' aria-hidden='true'> </i>
		    				</a>
		    			</div>
    						<div class='modal fade bs-example-modal-lg-new-img tabindex='-1' role='dialog' aria-labelledby='myLargeModalLabel'>
								<div class='modal-dialog modal-lg'>
									<div class='modal-content'>

										<div class='input-group padding-input-login'>
							                <div id='preview'>
													
											</div>
										</div>
										<form method='post' action='' enctype='multipart/form-data'>
							              	<div class='btn-ajout input-group padding-input-login'>
								              	<div class='fileUpload btn btn-default'>
									                <span>Choisir photo</span>
									                <input name ='photoprojet' id= 'file' type='file' class='upload' accept='image/jpg, image/jpeg, image/gif, image/png' />
								                </div>
								                <input name='action' value='ajouter' type='hidden'>
								                <input name='projetid' value='".$proj->getId()."' type = 'hidden'>
								                <button type = 'submit' class = 'btn btn-default margin-left-10' >Confirmer</button></a>
							                </div> 
						                </form> 

									</div>
								</div>
							</div>";
					echo"
						</div>
						<div role='tabpanel' class='tab-pane fade' id='commentaire'>";
						?>
							<button type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#modalCommentaire" >Nouveau commentaire</button>
							<div class="modal fade" id="modalCommentaire" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
							  	<div class="modal-dialog" role="document">
							    	<div class="modal-content">
							      		<div class="modal-header">
								        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								        	<h4 class="modal-title" id="modalCommentaireLabel">Nouveau commentaire</h4>
							      		</div>
							      		<form>
							      			<div class="modal-body">									        
									          	<div class="form-group">
										            <label for="recipient-name" class="control-label">Commentaire:</label>
										            <textarea name="commentaire" type="text" id = "text-area-commentaire" class="form-control" placeholder="Votre commentaire" aria-describedby="basic-addon2" data-toggle="tooltip" data-placement="top" title="Entrez votre commentaire pour le projet"></textarea>
									         	</div>									        
							      			</div>
									      	<div class="modal-footer">
										        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
										        <input type = "hidden" name = "projetid" value=<?php echo "'".$proj->getId()."'"; ?> ></input>
										        <button type="submit" name = "action" value="createNewCommentaire" class="btn btn-default">Confirmer</button>
									      	</div>
								      	</form>
							    	</div>
							  	</div>
							</div>
						<?php
							
							if ($listecommentaire != null)
							{
								while ($listecommentaire->next())
								{
									$com = $listecommentaire->getCurrent();
									if ($com!=null)
									{
										echo"
											<div class = 'col-xs-12 comment'>
												<div class = 'align-avatar clearfix col-xs-12 col-md-2'>
													<div class = 'img-comment'>
			    										<img id = 'avatar' class = 'img-responsive img-circle ' src = 'data:image/jpeg;base64,".base64_encode($com->getAvatar())."'/>
			    									</div>
		    										<div class = 'text-center'>
		    											<h5><a href='./?action=visiterProfil&userVisitName=".$com->getUser()."'>".$com->getUser()."</a></h5>
		    										</div>
	    										</div>
	    										<div class = 'col-xs-12 col-md-10'>
	    											<p>".stripslashes($com->getMessage())."</p>
	    										</div>
	    										<div class = 'col-md-12'>
			    									<span class = 'pull-right'>
			    										Date: ".$com->getDate()."
			    									</span>
			    								</div>
			    								<br>
	    									</div>";
									}
								}
							}?>
							<nav>
								<ul class='pager'>
									<?php $pageup = $_REQUEST["pageCommentaire"]+1;?>
									<?php $pagedown = $_REQUEST["pageCommentaire"]-1;?>
									<li <?php if ($_REQUEST["pageCommentaire"] == 0) echo "class = 'disabled'";?> ><a <?php if ($_REQUEST["pageCommentaire"] != 0) echo "href='./?action=visiter&projetid=".$proj->getId()."&pageCommentaire=".$pagedown."'";?>>Précédent</a></li>
									<li <?php if ($_REQUEST["pageCommentaire"]+1 >= $_SESSION["nbpagesCom"]) echo "class = 'disabled'";?>> <a <?php if ($_REQUEST["pageCommentaire"]+1 < $_SESSION["nbpagesCom"]) echo "href='./?action=visiter&projetid=".$proj->getId()."&pageCommentaire=".$pageup."'"; ?>> Suivant</a></li>    
								</ul>
							</nav>



					<?php
					echo"</div>
						<div role='tabpanel' class='tab-pane fade' id='donation'>
							<p>Section des Donations va ici (à finir)</p>
						</div>	
					</div>
				</div>";
			}
			else
			{	
				if (ISSET($_REQUEST["projetid"]))
				echo "<h1>
						<p class = 'text-center'>
							Oups! Aucun projet avec un ID de '".$_REQUEST["projetid"]."'							
						</p>
					</h1>";
				if (ISSET($_REQUEST["projetname"]))
				echo "<h1>
						<p class = 'text-center'>
							Oups! Aucun projet avec le nom '".$_REQUEST["projetname"]."'							
						</p>
					</h1>";
			}
		?>
				

		</div>
	<?php
		include("./vues/footer.php");
	?>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script>
 	(function() {

    function createThumbnail(file) {

        var reader = new FileReader();

        reader.addEventListener('load', function() {

            var imgElement = document.createElement('img');
           
            imgElement.src = this.result;
            prev = document.getElementById("preview");
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
        prev = document.querySelector('#preview');

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