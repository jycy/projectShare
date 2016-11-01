<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" href="./css/bootstrap/stylesheets/styles.css" type="text/css" >
<script src="./css/jquery-1.12.1.min.js"></script>
</head>

<body class= "background-image">
	<!--<div class="jumbotron">
		<div class="container">
			<h1>Project</h1>
		</div>
	</div>-->
	<?php
		include("./vues/nav.php");
	?>	
		<div class="container">
			<?php
				require_once('./modele/classes/Projet.class.php');
				require_once('./modele/classes/Photo.class.php');
				require_once('./modele/classes/Liste.class.php');
				require_once('./modele/classes/User.class.php');
				require_once('./modele/UserDAO.class.php');
				require_once('./modele/ProjetDAO.class.php');
				require_once('./modele/PhotoDAO.class.php');
				$pjdao = new ProjetDAO();
				$photodao = new PhotoDAO();
				$userdao = new UserDAO();
				if (ISSET($_REQUEST["userVisitId"]))
					$user = $userdao->findById($_REQUEST["userVisitId"]);
				else if (ISSET($_REQUEST["userVisitName"]))
					$user = $userdao->find($_REQUEST["userVisitName"]);
			?>
			<div class = "col-xs-12 col-md-8 col-md-offset-2">
				<div class='panel panel-default panel-profil'>
	    			<div class='panel-heading'>
	    				<h2>
	    					Profil
	    				</h2>
	    			</div>
	    			<div class='panel-body panel-body-projet'>
	    				<?php
	    				if ((ISSET($_REQUEST["userVisitId"])) || (ISSET($_REQUEST["userVisitName"]))){
	    					if ($user != null) {
	    						if ($user->getAvatar() != null) echo "<div id = 'div-avatar' class = 'col-xs-12 col-sm-4'><img id = 'avatar' class = 'img-responsive col-xs-12' src = 'data:".$user->getExtension().";base64,".base64_encode($user->getAvatar())."'/></div>";
	    						else echo "<div class = 'div-no-avatar col-xs-11 col-sm-4'></div>";
	    				
	    				?>
						<div class = 'panel-projet col-xs-12 col-sm-7'>
						<?php
							if ($user == null) echo "<p> no user found</p>";
							else echo "<h4>Utilisateur</h4><hr> <p>".$user->getUserName()."</p>";
						?>
						</div>
						<div class = "col-xs-12 panel-proj-perso">
							<div class="panel panel-default">
								<a class = "btn btn-default btn-block" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									<div  class="panel-heading" role="tab" id="headingOne">
										<h4 class="panel-title">
										    Mes projets
										    <span class="pull-right glyphicon glyphicon-triangle-bottom"></span>
										</h4>
									</div>
								</a>
								<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
									<div class="panel-body panel-proj-perso">
										<?php
										$liste = $pjdao->findByUser(0,$user);
										if ($liste == null) echo "<div class = 'well'>Aucun projet</div>";
										else
										{
											while ($liste->next())
											{
												$p = $liste->getCurrent();
												if ($p!=null)
												{
													$resminia = $photodao->findMiniature($p->getId());
													echo "<div class= 'col-xs-12 col-sm-6 '>
									  							<div class='panel panel-default'>
									    							<div class='panel-heading'><h4>".$p->getName()."</h4></div>
									    								<div class='panel-body panel-body-projet'>";
									    									if ($resminia != null) echo "<div class = 'div-thumbnail' style = 'background-image: url(data:image/jpeg;base64,".base64_encode($resminia->getPhoto())."); '></div>";
									    									else echo "<div class = 'div-no-thumbnail'></div>";
									    									echo "<p class = 'panel-projet'>
																		    ".$p->getIntroduction()."
																		    </p>
																			<a href = './?action=visiter&pageCommentaire=0&projetid=".$p->getId()."'><button class = 'btn btn-lg btn-default btn-block' >View</button></a>";
																			if ($_SESSION["idConnecte"] == $user->getId()) echo"
																			<a href = './?action=updater&projetid=".$p->getId()."'><button class = 'btn btn-lg btn-warning btn-block'>Updater</button></a>";

																			if ($_SESSION["idConnecte"] == $user->getId()) echo"
																			<a href = './?action=Supprimer&projetid=".$p->getId()."'><button class = 'btn btn-lg btn-danger btn-block'>Supprimer</button></a>";

																			

																	echo"</div>
																	</div>
																</div>";
												}
											}
										}
										?>
									</div>	
								</div>
							</div>
						</div>
							
							<a href = ''><button class = 'btn btn-lg btn-default pull-right'>contact</button></a>
							<?php 
							}
							else 
							{
								if (ISSET($_REQUEST["userVisitId"]))
								{
									echo "<h1>
											<p class = 'text-center'>
												Oups! Aucun Utilisateur avec un ID de '".$_REQUEST["userVisitId"]."'.							
											</p>
										</h1>";
								}
								elseif (ISSET($_REQUEST["userVisitName"]))
								{
									echo "<h1>
											<p class = 'text-center'>
												Oups! Aucun Utilisateur avec le nom de '".$_REQUEST["userVisitName"]."'.							
											</p>
										</h1>";
								}
							}
						}
						else{
							echo "<h1>
									<p class = 'text-center'>
										Oups! Aucun Utilisateur saisi. Veuillez chercher un utilisateur par son nom ou son id.
									</p>
								</h1>";
							}
						?>
							
						</div>
				</div>
			</div>
		</div>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script >
		$(function () {
		  $('[data-toggle="popover"]').popover()
		})	
	</script>
	
</body>

</html>