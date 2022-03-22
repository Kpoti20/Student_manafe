<?php
  session_start();
  $bdd = new PDO('mysql:host=127.0.0.1; dbname=scolarite1','root', '');
 
  if(isset($_POST['forminscription']))
{
    $prof = $_POST['prof'];
	  $mat = $_POST['mat'];
	  $fil = $_POST['fil'];
	  $jr = $_POST['jr'];
    
    

  if(($prof!="Selectionnez le professeur") AND ($mat!="Selectionnez la matiere") AND ($fil!="Selectionnez la filiere") AND ($jr!="Selectionnez le jour"))

  {
		
    if($prof!="Selectionnez le professeur")
    {
      if ($mat!="Selectionnez la matiere") 
      {
        if($fil!="Selectionnez la filiere")
       {
        if($jr != "Selectionnez le jour")
        {
	      
           $reqenre=$bdd->prepare("SELECT * FROM seance WHERE pro = ? and mat = ? and fil = ? ");
           $reqenre->execute(array($prof,$mat,$fil));
           $enregistrexist =$reqenre->rowcount();
              if($enregistrexist == 0)
              { 
                  $inserttut = $bdd->prepare("INSERT INTO seance(pro,mat,fil,jr) VALUES(?,?,?,?)");
                  $inserttut->execute(array($prof,$mat,$fil,$jr)); 
                  $op = $bdd->prepare("UPDATE seance SET idpro=(SELECT idpo FROM professeur WHERE professeur.pop=seance.pro) WHERE ids=(SELECT MAX(ids) )");
                  $op->execute();
                  $ope = $bdd->prepare("UPDATE seance SET idmat=(SELECT idm FROM matiere WHERE matiere.nom=seance.mat ) WHERE ids=(SELECT MAX(ids) )");
                  $ope->execute();
                  $pet = $bdd->prepare("
UPDATE seance SET idfil=(SELECT Codefil FROM filiere WHERE filiere.NomFil=seance.fil ) WHERE ids=(SELECT MAX(ids) )");
                  $pet->execute();
                  $prof = "";
    			  $mat = "";
				  $fil = "";
				  $jr = "";
                  "<br/>";
                  $erreur="Enregistrement effectué avec succes! "; 
              } 
              else
              {
                $erreur="ATTENTION !!! Enregistrement deja effectué";
              }  
      }
      else
      {
        $erreur = "Veuillez selectionnez le jour";
      }
    }else
    {
      $erreur="Veuillez selectionnez la filiere";
    }  
  }else
    {
      $erreur="Veuillez selectionnez la matiere";
    }
  }
  else
  {
    $erreur = "Veuillez selectionnez le professeur";
  }
	}
  else
  {
    $erreur = "veuillez remplir tous les champs!";
  }

}
  

if (isset($_GET['id'])) 
  {
    $getid = intval($_GET['id']);
    $requser = $bdd->prepare('SELECT * FROM etablissement WHERE id = ? ');
    $requser->execute(array($getid));
    $userinfo=$requser->fetch(); 
    $_SESSION['id'] = $userinfo['id'];
    $_SESSION['pseudot']= $userinfo['pseudo'];
    $_SESSION['mail']= $userinfo['mail'];
?>
<!DOCTYPE html>
<html>
<title>COPEGENE Etablissement</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="font-awesome.min.css">
<link rel="stylesheet" href="bootstrap.min.css">
<script src="jquery.min.js"></script>
<script src="bootstrap.min.js"></script>
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
.w3-sidenav a,.w3-sidenav h4 {font-weight:bold}
table {
    border-collapse: collapse;
    width: 100%;
    border: 1px solid #ddd;
}

th, td {
    text-align: left;
    padding: 8px;
    border: 1px solid #ddd;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: #9E9E9E;
    color: black;
}
.w3-btn {width:150px;}
a{
      cursor: pointer;
      text-decoration:none;
   }

    ul{
      background-color: #eee;
      cursor: pointer;

    }
    li{
      padding:12px; 
    }
</style>
<body class="w3-light-grey w3-content" style="max-width:1600px">
<?php 
      include_once 'index_etablissement_cours.php';
    ?>
<!-- Sidenav/menu -->
<nav class="w3-sidenav w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidenav"><br>
  <div class="w3-container">
    <a href="#" onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding" title="close menu">
      <i class="fa fa-remove"></i>
    </a> 
    <img src="w3images/avatar_g2.jpg" style="width:45%;" class="w3-circle"><br><br>
    <h4 class="w3-padding-0"><b>Profil : <?php echo $userinfo['pseudo']; ?></b></h4>
    <p class="w3-text-grey"></p>
	 <?php
                  if (isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
                  
                    ?>
  </div>
  <a href="#portfolio" onclick="w3_close()" class="w3-padding w3-text-teal"><i class="fa fa fa-info-circle fa-fw w3-margin-right"></i>INFORMATION</a> 
  <a href="#about" onclick="w3_close()" class="w3-padding"><i class="fa fa-envelope fa-fw w3-margin-right"></i>MESSAGE</a> 
  <!--<a href="#contact" onclick="w3_close()" class="w3-padding"><i class="fa fa-envelope fa-fw w3-margin-right"></i>CONTACT</a>-->
	<a href="index_etablissement_etudiant.php?id=<?php echo ($_SESSION['id']);?>" onclick="w3_close()" class="w3-padding"><i class="fa  fa fa-user fa-fw w3-margin-right"></i>ETUDIANTS</a>
	<a href="index_etablissement_filiere.php?id=<?php echo ($_SESSION['id']);?>" onclick="w3_close()" class="w3-padding"><i class="fa  fa-mortar-board fa-fw w3-margin-right"></i>FILIERES</a>
	<a href="index_etablissement_matiere.php?id=<?php echo ($_SESSION['id']);?>" onclick="w3_close()" class="w3-padding"><i class="fa  fa fa-book fa-fw w3-margin-right"></i>MATIERES</a>
	<a href="index_etablissement_professeur.php?id=<?php echo ($_SESSION['id']);?>" onclick="w3_close()" class="w3-padding"><i class="fa  fa fa-book fa-fw w3-margin-right"></i>PROFESSEUR</a>
	<a href="index_etablissement_cours.php?id=<?php echo ($_SESSION['id']);?>" onclick="w3_close()" class="w3-padding"><i class="fa  fa fa-calendar fa-fw w3-margin-right"></i>SEANCES DE COURS</a>
   <a href="" onclick="w3_close()" class="w3-padding"><i class="fa  fa fa-check-square-o fa-fw w3-margin-right"></i>CONTROLE DE PRESENCE</a>
   <a href="#" onclick="w3_close()" class="w3-padding"><i class="fa fa fa-edit w3-margin-right"></i>GESTION DES NOTES</a>
   <a href="#" onclick="w3_close()" class="w3-padding"><i class="fa fa fa-bar-chart-o w3-margin-right"></i>STATISTIQUES</a>
   <a href="#" onclick="w3_close()" class="w3-padding"><i class="fa fa fa-cog w3-margin-right"></i>PARAMETRES</a>
   <a href="deconnexion.php" onclick="w3_close()" class="w3-padding"><i class="fa fa fa-sign-out w3-margin-right"></i>DECONNEXION</a>
  <div class="w3-section w3-padding-top w3-large">
    <a href="#" class="w3-hover-white w3-hover-text-indigo w3-show-inline-block"><i class="fa fa-facebook-official"></i></a>
    <a href="#" class="w3-hover-white w3-hover-text-purple w3-show-inline-block"><i class="fa fa-instagram"></i></a>
    <a href="#" class="w3-hover-white w3-hover-text-yellow w3-show-inline-block"><i class="fa fa-snapchat"></i></a>
    <?php
                    }
                    ?>
  </div>
</nav>

<!-- Overlay effect when opening sidenav on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px">

  <!-- Header -->
  
  <header class="w3-container" id="portfolio">
    <a href="#"><img src="w3images/avatar_g2.jpg" style="width:65px;" class="w3-circle w3-right w3-margin w3-hide-large w3-hover-opacity"></a>
    <span class="w3-opennav w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
    
    <!--<div class="w3-section  w3-padding-8">
     <!-- <span class="w3-margin-right">Filieres:</span> -->
     <!-- <button class="w3-btn">ALL</button>-->
      <!--<button class="w3-btn w3-white"><i class="fa fa-diamond w3-margin-right"></i>Design</button>
      <button class="w3-btn w3-white w3-hide-small"><i class="fa fa-photo w3-margin-right"></i>Photos</button>
      <button class="w3-btn w3-white w3-hide-small"><i class="fa fa-map-pin w3-margin-right"></i>Art</button>-->
    <!--</div> -->
  </header>
  <div class="w3-panel w3-card-12 w3-margin-bottom w3-white" style="width:1050px;">
		<div class="w3-container w3-grey">
  <h2>Configuration des cours</h2>
</div>
<br/>
<form class="w3-container" method="POST" action="" >
	<p>
             <label for="prof" >Professeur</label>
              <input type="text" name="prof" id="prof" autocomplete="off" class="w3-input"  placeholder="Choisir un professeur"><div id="profList"></div>
              </p>
	<p>
              <label for="mat" >Matiere</label>
              <select  class="w3-select" name="mat">
              <option>Selectionnez la matiere</option>
     <?php
     
     $_select=$bdd->query("SELECT nom  FROM matiere");
         while ($V = $_select->fetch(PDO::FETCH_OBJ)) {
     ?>

           <option><?php echo $V->nom; ?></option>
     <?php
         }
     ?>

   </select></p>
  <p>
              <label for="fil" >Filière</label><select  class="w3-select" name="fil">
              <option>Selectionnez la filiere</option>
     <?php
     
     $_select=$bdd->query("SELECT NomFil  FROM filiere");
         while ($V = $_select->fetch(PDO::FETCH_OBJ)) {
     ?>

           <option><?php echo $V->NomFil; ?></option>
     <?php
         }
     ?>

   </select></p>
             <p>
              <label for="jr" >Jour</label>
			  <select  class="w3-select" id="jr" name="jr">
              <option value="">Selectionnez le jour</option>
			  <option value="Lundi">Lundi</option>
			  <option value="Mardi">Mardi</option>
			  <option value="Mercredi">Mercredi</option>
			  <option value="Jeudi">Jeudi</option>
			  <option value="Vendredi">Vendredi</option>
			  <option value="Samedi">Samedi</option>
				</select>
				</p>
			 
  <p><button type="sumit" name="forminscription" class="w3-btn w3-teal w3-round-xxlarge">Sauvegarder</button>
  <button type="reset" class="w3-btn w3-teal w3-round-xxlarge">Annuler</button></p>
  <?php
      if (isset($erreur))
      {?>
         <script>  alert('<?php  echo  $erreur  ;?>')</script>
      <?php   
      }

        ?>
</form><br/>


  <h2 class="w3-text-teal w3-padding-16" style="margin-left:15px;"><i>Liste des Cours</i></h2>
  <?php   
    $bdd = new PDO('mysql:host=127.0.0.1; dbname=scolarite1','root', '');
    
    
      $_select = $bdd->prepare("SELECT * FROM seance order by ids desc");
    
    
    $_select->execute();
    ?>
	<form method="POST" action="">
  <div class="input-group">
  <label for="choix" style="margin-left:15px;">Rechercher par </label>
    <select class=""  style="width:150px; margin-left:15px;" name="choix">
      <option value="">Matiere</option>
      <option value="">Filiere</option>
    </select><br/><br/>
    <input type="text" class="form-control" style="margin-left:15px; " name="search" value="<?php if (isset($search)) {echo ($search);} ?>" placeholder="Search..">
    <div class="input-group-btn">
      <button class="btn btn-default" style="margin-right:300px; margin-top:45px;" type="submit">
        <i class="fa fa-search fa-fw w3-margin-right w3-text-teal" style="margin-left:5px;" ></i>
      </button>
    </div>
  </div>
</form>
<br/>
 
 <div class="table-responsive ">

  <table style="width:820px; margin-left:10px;">
    <thead>
      <tr>
        <th>ID </th>        
        <th>Professeur</th>
        <th>Matiere</th>
		<th>Filiere</th>
		<th>Jour</th>
        <th>Operations</th>
      </tr>
    </thead>
    <tbody>

     <?php  while ($s=$_select->fetch(PDO::FETCH_OBJ)) {
?>    
      <tr>
        <td><?php echo $s->ids;?></td>
        <td><?php echo $s->pro;?></td>
        <td><?php echo $s->fil;?></td>
		<td><?php echo $s->mat;?></td>
        <td><?php echo $s->jr;?></td>
        <td>
       <a href="index_etablissement_cours_action.php?ids=<?php echo $s->ids;?>" target="_parent"  style="text-decoration:none;">Action</a></td>
		     <?php
                    }
                    ?>
 		
         
<!--Fin Formulaire de suppression-->
	</div>
      </tr>
    </tbody>
  </table><br/>
</div>  

  

 
   
   
      
     
     
  
   

 
  
  <div class="w3-black w3-center w3-padding-24">Powered by <a href="default.html" title="W3.CSS" target="_blank" class="w3-hover-opacity">Joel AHOLOU</a></div>

<!-- End page content -->
</div>

<script>
// Script to open and close sidenav
function w3_open() {
    document.getElementById("mySidenav").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
    document.getElementById("mySidenav").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}
</script>

</body>

<!-- Mirrored from www.w3schools.com/w3css/tryit.asp?filename=tryw3css_templates_portfolio&stacked=h by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Dec 2016 15:08:53 GMT -->
</html>
<script>
  $(document).ready(function(){
    $('#prof').keyup(function(){
      var query = $(this).val();
      if (query != '') 
      {
        $.ajax({
          url:"search.php",
          method:"POST",
          data:{query:query},
          success:function(data)
          {
            $('#profList').fadeIn();
            $('#profList').html(data);
          }
        }); 
      } 
    });
    $(document).on('click', 'li', function(){
      $('#prof').val($(this).text());
      $('#profList').fadeOut();
    });
  });
</script>

<?php

  }else{
    echo "Desole";
  }
?>
