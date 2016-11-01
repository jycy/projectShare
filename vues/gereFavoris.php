<?php
  require_once('./User.class.php');
  require_once('./UserDAO.class.php');

  session_start();
  #session_destroy();
  if (!ISSET($_SESSION["USER"]))
    {
    #session_start(); <-- ne marche pas car il oublie la session
      if (ISSET($_REQUEST["User"])){
        $_SESSION["USER"] = $_REQUEST["User"];
        echo "Was not connected, welcome ".$_SESSION["USER"] ;
      }
      else {
        $_SESSION["USER"] = "anonymous";
        echo "No user, welcome anonymous" ;
      }
    
    }
  else echo "Hello, ".$_SESSION["USER"];
?>



<html>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <script src="jquery-1.12.1.min.js"></script>
<head>
  <meta http-equiv="Content-Language" content="en-ca">
  <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
  <meta name="GENERATOR" content="Microsoft FrontPage 4.0">
  <meta name="ProgId" content="FrontPage.Editor.Document">
  <title>Liste des cours</title>
</head>

<body>
  <?php
  if (isset($_GET['ID'])){
  //echo "<p>".$_REQUEST["ID"]."</p>";
  $cnx = new PDO('mysql:host=localhost;dbname=favoris', "root", "root");
  $sup = "DELETE FROM favoris WHERE ID =".$_REQUEST["ID"]; 
  $cnx->exec($sup);
  $cnx = null; 
  }

  if (isset($_GET['ajouter'])){
  //echo "<p>".$_REQUEST["ID"]."</p>";
  $cnx = new PDO('mysql:host=localhost;dbname=favoris', "root", "root");
  $ajout = "INSERT INTO favoris (URL,TITRE,DESCRIPTION,USER) VALUES ('".$_REQUEST["URL"]."','".$_REQUEST["TITRE"]."','".$_REQUEST["DESCRIPTION"]."','".$_SESSION["USER"]."');"; 
  //echo "".$ajout."";
  //$prepare = $cnx->prepare($ajout);
  //$prepare->execute();
  $cnx->exec($ajout);
  $cnx = null; 
  }

  ?>

  <form method="get" id="supprimer" action="gereFavoris.php">
    <div class="container">
    <div class="jumbotron"><h1>Liste des favoris</h1></div>
    <table class="table">
    <tr>
      <th>ID</th>
      <th>URL</th>
      <th>TITRE</th>
      <th>DESCRIPTION</th>
      <th></th>
    </tr>

    <?php
    try {
      $cnx = new PDO('mysql:host=localhost;dbname=favoris', "root", "root");
  	$requete = "SELECT * FROM favoris where USER = '".$_SESSION["USER"]."'";
  	$res = $cnx->query($requete);		//Utiliser la fonction exec() pour une requête de mise à jour (INSERT, DELETE, UPDATE)
      foreach($res as $row) {
  	  echo "<tr>";
  	  echo "<td>".$row["ID"]."</td>";
  	  echo "<td>".$row["URL"]."</td>";
  	  echo "<td>".$row["TITRE"]."</td>";
        echo "<td>".$row["DESCRIPTION"]."</td>";
        echo "<td><button value=".$row["ID"]." name='ID' class='btn btn-danger pull-right' type='submit' form='supprimer'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span>Supprimer</button></td>";
  	  echo "</tr>";	
      }
  	$res->closeCursor();
      $cnx = null;
  } catch (PDOException $e) {
      print "Error!: " . $e->getMessage() . "<br/>";
      die();
  }
  ?>
  </form>
  <form method="get" id="ajouter" action="gereFavoris.php">
    <tr>
      <td></td>
      <td>
        <input type="text" name = "URL" value="" class="form-control" placeholder="URL" aria-describedby="basic-addon1">
      </td>
      <td>
        <input type="text" name = "TITRE" value="" class="form-control" placeholder="TITRE" aria-describedby="basic-addon1">
      </td>
      <td>
        <input type="text" name = "DESCRIPTION" value="" class="form-control" placeholder="DESCRIPTION" aria-describedby="basic-addon1">
      </td>
    </tr>
  </table>
  <button value= "ajouter" name="ajouter" type='submit' form='ajouter' class="btn btn-lg btn-warning pull-right">Ajouter<span class="glyphicon glyphicon-ok"></span></button>
  </form>
    </div>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

</body>

</html>


