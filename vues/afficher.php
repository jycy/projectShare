<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" href="./css/bootstrap/stylesheets/styles.css" type="text/css" >
<script src="./css/jquery-1.12.1.min.js"></script>

</head>

<body class= "background-image">
	<?php
		include("./vues/nav.php");
	?>	
	<div class="container container-white">
		<div class="jumbotron">
				<h1><span class="glyphicon glyphicon-globe"></span>Project</h1>
		</div>
		<?php
			require_once('./modele/classes/Projet.class.php');
			require_once('./modele/classes/Photo.class.php');
			require_once('./modele/classes/Liste.class.php');
			require_once('./modele/ProjetDAO.class.php');
			require_once('./modele/PhotoDAO.class.php');
			$pjdao = new ProjetDAO();
			$photodao = new PhotoDAO();
			$listeproj = $pjdao->findLimit($_REQUEST["pageProjet"]);
			if ($listeproj != null){
				while ($listeproj->next()){
					$p = $listeproj->getCurrent();
					if ($p!=null)
					{
						$resminia = $photodao->findMiniature($p->getId());
						echo "<div class= 'col-xs-12 col-sm-6 col-md-4 col-lg-3 '>
  								<div class='panel panel-default'>
    								<div class='panel-heading'><h4>".$p->getName()."</h4></div>
    								<div class='panel-body panel-body-projet'>";
    									if ($resminia != null) echo "<div class = 'div-thumbnail' style = 'background-image: url(data:".$resminia->getExtension().";base64,".base64_encode($resminia->getPhoto())."); '></div>";
    									else echo "<div class = 'div-no-thumbnail'></div>";
    										//echo "<img class = 'img-responsive' src='data:image/jpeg;base64,".base64_encode($resminia->getPhoto())."'/>";
									    echo "<p class = 'panel-projet'>
									       ".$p->getIntroduction()."
									      </p>
									     <a href = './?action=visiter&pageCommentaire=0&projetid=".$p->getId()."'><button class = 'btn btn-lg btn-default btn-block'>View</button></a>
									</div>
									</div>
								</div>";
						}
					}
				}
			?>

		</div>
		<nav>
			<ul class='pager'>
				<?php $pageup = $_REQUEST["pageProjet"]+1;?>
				<?php $pagedown = $_REQUEST["pageProjet"]-1;?>
				<li <?php if ($_REQUEST["pageProjet"] == 0) echo "class = 'disabled'";?> ><a <?php if ($_REQUEST["pageProjet"] != 0) echo "href='./?action=afficher&pageProjet=".$pagedown."'";?>>Précédent</a></li>
				<li <?php if ($_REQUEST["pageProjet"]+1 >= $_SESSION["nbpages"]) echo "class = 'disabled'";?>> <a <?php if ($_REQUEST["pageProjet"]+1 < $_SESSION["nbpages"]) echo "href='./?action=afficher&pageProjet=".$pageup."'"; ?>> Suivant</a></li>    
			</ul>
		</nav>
	<?php
		include("./vues/footer.php");
	?>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

</body>

</html>