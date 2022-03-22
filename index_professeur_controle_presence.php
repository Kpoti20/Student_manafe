<?php
  session_start();
  $bdd = new PDO('mysql:host=127.0.0.1; dbname=scolarite1','root', '');

if (isset($_GET['idpo'])) 
{
    $getid = intval($_GET['idpo']);
    $requser = $bdd->prepare('SELECT * FROM professeur WHERE idpo = ? ');
    $requser->execute(array($getid));
    $userinfo=$requser->fetch(); 
    $_SESSION['idpo'] = $userinfo['idpo'];
      $_SESSION['pseudo']= $userinfo['pseudo'];
      $_SESSION['ct']= $userinfo['ct'];

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
 .button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 4px 2px;
    cursor: pointer;
}
  .button2 {background-color: teal;}
  .button3 {background-color: #B20808;} /* Red */ 

.w3-btn {width:150px;}

</style>
<body class="w3-light-grey w3-content" style="max-width:1600px">
  <?php 
      include_once 'index_professeur_controle_presence.php';
    ?>
<!-- Sidenav/menu -->
<nav class="w3-sidenav w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidenav"><br>
  <div class="w3-container">
    <a href="#" onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding" title="close menu">
      <i class="fa fa-remove"></i>
    </a> 
    <img src="w3images/avatar_g2.jpg" style="width:45%;" class="w3-circle"><br><br>
    <h4 class="w3-padding-0"><b> Profil :<?php echo $userinfo['pseudo']; ?></b></h4>
    <p class="w3-text-grey"></p>
	<?php
                  if (isset($_SESSION['idpo']) AND $userinfo['idpo'] == $_SESSION['idpo']) {
                  
                    ?>
  </div>
  <a href="index_professeur_comte.php?idpo=<?php echo ($_SESSION['idpo']);?>" onclick="w3_close()" class="w3-padding w3-text-teal"><i class="fa fa fa-info-circle fa-fw w3-margin-right"></i>INFORMATION</a> 
  <a href="#about" onclick="w3_close()" class="w3-padding"><i class="fa fa-envelope fa-fw w3-margin-right"></i>MESSAGE</a> 
  <!--<a href="#contact" onclick="w3_close()" class="w3-padding"><i class="fa fa-envelope fa-fw w3-margin-right"></i>CONTACT</a>-->
   <a href="index_professeur_controle_presence.php?idpo=<?php echo ($_SESSION['idpo']);?>" onclick="w3_close()" class="w3-padding"><i class="fa  fa fa-check-square-o fa-fw w3-margin-right"></i>CONTROLE DE PRESENCE</a>
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
  <h2>Controle de Présence aux cours</h2>
</div>
<br/>


		<!--<h2 class="w3-text-teal w3-padding-16" style="margin-left:15px;"><i>Liste des Professeurs</i></h2>-->
<?php   
    $bdd = new PDO('mysql:host=127.0.0.1; dbname=scolarite1','root', '');
    
      $_select = $bdd->prepare("SELECT * FROM absence order by ida desc");
      $_select->execute();
	  
    ?>
	<form method="POST" action="">
  <div class="input-group">
  <label for="choix" style="margin-left:15px;">Jour</label>
    <select class=""  style="width:150px; margin-left:15px;" name="jr">
     <option value="">Selectionnez un jour </option>
			  <option value="Lundi">Lundi</option>
			  <option value="Mardi">Mardi</option>
			  <option value="Mercredi">Mercredi</option>
			  <option value="Jeudi">Jeudi</option>
			  <option value="Vendredi">Vendredi</option>
			  <option value="Samedi">Samedi</option>
    </select>
	
	<label for="fil" style="margin-left:15px;">Filiere</label>
	<select style="width:150px; margin-left:15px;" name="fil">
		<option value="">Selectionnez la filiere de l'étudiant</option>
     <?php
     
     $_select=$bdd->query("SELECT NomFil  FROM filiere ");
         while ($S = $_select->fetch(PDO::FETCH_OBJ)) {
     ?>

           <option><?php echo $S->NomFil; ?></option>
     <?php
         }
     ?>

   </select>
	<button class="btn btn-default" type="submit" name="liste" style="margin-left:20px; " > Voir la liste de classe</button>
	<br/>
</form>
</div>
<?php
    $bdd = new PDO('mysql:host=127.0.0.1; dbname=scolarite1','root', '');

 
?>
<form>
 <div class="table-responsive ">

  <table style="width:820px; margin-left:10px;">
    <thead>
      <tr>
        <th>Etudiant </th>
        <th>Cours</th>
        <th>Statut</th>
    <th>Operations</th>
      </tr>
    </thead>
    <tbody>
   
      <tr>  
        <td><?php echo $s->etud;?></td>
        <td><?php echo $s->cour;?></td>
        <td><?php echo $s->statut;?></td>      
        <td>
       <a href="index_etablissement_professeur_controle_presence.php?idpo=<?php echo $s->idpo;?>" target="_parent"  style="text-decoration:none;">Action</a></td>
        
</form>
  </div>
      </tr>
    </tbody>
  </table>
   <?php
                    }
                    ?>
               
         <br/>

<br/>  
   

 
  
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
<?php

  }else{
    echo "Desole";
  }
?>
