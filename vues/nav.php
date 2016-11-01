<script>$(document).ready(function(){$(".dropdown-toggle").click(function(){
        $("#dropdown").fadeToggle();
    });
});
</script>
<script>
  $(document).click(function (e) {
    if (!$(e.target).closest('#dropdown').length)
    {
        $('#dropdown').fadeOut();
    }
});
</script>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="./?action=afficher&pageCommentaire=0&pageProjet=0"><span class="glyphicon glyphicon-globe"></span>Browse Project</a>
      </div>
      
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        
          <?php if (isset($_SESSION["connecte"])) echo"
            <form class='navbar-form navbar-left' role='search'>
              <div class='form-group'>
                <input type='text' name='projetname' class='form-control' placeholder='Nom de projet'>
              </div>
              <input type='hidden' name='pageCommentaire' value='0'>
              <button name = 'action' value='visiter' type='submit' class='btn btn-default'>C'est parti!</button>
            </form>";
            ?>
        
        <ul class="nav navbar-nav navbar-right">
          <?php
            if(!isset($_SESSION["connecte"])) echo "<li><a href='./?action=connecter'>Sign in</a></li>";
            else {
              echo "<li class='dropdown'>";
              echo "  <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>Welcome <strong>".$_SESSION["connecte"]."</strong><span class='caret'></span></a>";
              echo "  <ul id='dropdown' class='dropdown-menu' data-dropdown-in='fadeIn' data-dropdown-out='fadeOut'>";
              echo "    <li><a href='./?action=visiterProfil&userVisitId=".$_SESSION["idConnecte"]."'>Profil</a></li> ";
              echo "    <li><a href='./?action=createNewProjet'>Nouveau Projet</a></li>";
              echo "    <li role='separator' class='divider'></li>";
              echo "    <li><a href='./?action=deconnecter'>Logout</a></li>";
              echo "  </ul>";
              echo "</li>";
            }
          ?>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </div>
</nav>