<?php
  session_start();
  $bdd = new PDO('mysql:host=127.0.0.1; dbname=scolarite1','root', '');
  
  if(isset($_POST['forminscription']))
{
        $nom = htmlspecialchars(trim($_POST['nom']));
        $pre = htmlspecialchars(trim($_POST['pre']));
        $pre1 = htmlspecialchars(trim($_POST['pre1']));
        $sx = $_POST['sx'];
        $ct= $_POST['ct'];
       
      if(!empty($nom) AND !empty($pre) AND !empty($pre1) AND ($sx!="Selectionnez le sexe") AND !empty($ct) )

      {
        $nomlength = strlen($nom);
        $prelength = strlen($pre);
        $pre1length = strlen($pre1);
        $ctlength = strlen($ct);
        
        if($nomlength <= 30)
        {
          if (preg_match("/^[a-zA-Z ]*$/",$nom)) 
          {
            if($prelength <= 15)
           {
            if(preg_match("/^[a-zA-Z ]*$/",$pre))
            {
              if($pre1length <= 15)
             {
               if(preg_match("/^[a-zA-Z ]*$/",$pre1))
              {
                if($sx=="Masculin" or $sx=="Féminin")
               {
                  if($ctlength>=2)
                 {
                    
                        $reqenre=$bdd->prepare("SELECT * FROM professeur WHERE no = ? and p1 = ? and p2 = ? and sx = ? and ct = ? ");
                        $reqenre->execute(array($nom,$pre,$pre1,$sx,$ct));
                        $enregistrexist =$reqenre->rowcount();
                        if($enregistrexist == 0)
                        { 
                            $inserttut = $bdd->prepare("INSERT INTO professeur(no,p1,p2,sx,ct) VALUES(?,?,?,?,?)");
                            $inserttut->execute(array($nom,$pre,$pre1,$sx,$ct)); 
                           $update = $bdd->prepare("UPDATE professeur SET pop=(SELECT concat(no,' ',p1,' ',p2)) WHERE idpo=(SELECT MAX(idpo))");
                            $update->execute();
                            $nom="";
                            $pre="";
                            $pre1="";
                            $sx="";
                            $ct="";
                            
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
                    $erreur = "SVP Veuillez saisir le numero de contact de l'etudiant !";
                  }
              }else
                {
                  $erreur="SVP Veuillez selectionnez le sexe de l'etudiant !";
                }
              }
              else
                 {
                   $erreur = "Seuls les caractères alphabetiques sont autorisés pour le deuxieme prénom ! ";
                 }
               }
               else
                {
                  $erreur = "Le deuxieme prénom ne dois pas depasser 15 caracteres !!!  ";
                }
                 }
               else
                  {
                    $erreur = "Seuls les caractères alphabetiques sont autorisés pour le premier prénom !! ";
                  }
                }
               else
                  {
                    $erreur = "Le premier prénom ne dois pas depasser 15 caracteres !!! ";
                  }
                }
               else
                  {
                    $erreur = "Seuls les caractères alphabetiques sont autorisés pour le nom !! ";
                  }
                }
               else
                  {
                    $erreur = "Le nom ne dois pas depasser 15 caracteres !!! ";
                  }
                }
               else
                  {
                    $erreur = "Veuillez remplir tous les champs !!! ";
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

</style>
<body class="w3-light-grey w3-content" style="max-width:1600px">
<?php 
      include_once 'index_etablissement_professeur.php';
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
   <a href="#" onclick="w3_close()" class="w3-padding"><i class="fa  fa fa-check-square-o fa-fw w3-margin-right"></i>CONTROLE DE PRESENCE</a>
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
  <h2>Enregistrement Professeur</h2>
</div>
<br/>
<form class="w3-container" method="POST" action="">
  <p>
  <label for="nom">Nom</label>
  <input class="w3-input" type="text" autocomplete="off" type="text" value="<?php if (isset($nom)) { echo $nom; } ?>" placeholder="Le nom du professeur" id="nom" name="nom"></p>
 <p>
              <label for="pre" >Prénom 1</label>
              <input class="w3-input" type="text" value="<?php if (isset($pre)) {echo $pre; } ?>" autocomplete="off" placeholder="Premier prénom du professeur" id="pre" name="pre"></p>
              
              <p>
              <label for="pre1" >Prénom 2</label>
              <input class="w3-input" type="text" autocomplete="off" value="<?php if (isset($pre1)) {echo $pre1;} ?>" placeholder="Deuxieme prénom du professeur" id="pre1" name="pre1"></p>
              <p>
              <label for="sx" >Sexe</label>
              <select name="sx" class="w3-select" id="sx" >
                <option value="">Selectionnez le sexe</option>
                <option value="Masculin">Masculin</option>
                <option value="Féminin">Féminin</option>
              </select>
              </p>
              <p>
              <label for="ct">Contact</label>
              <input class="w3-input" type="tel" autocomplete="off" value="<?php if (isset($ct)) {echo $ct; } ?>" placeholder="Contact du professeur" id="ct" name="ct"></p>
			  
  <p><button type="submit" name="forminscription" class="w3-btn w3-teal w3-round-xxlarge">Sauvegarder</button>
  <button  type="reset" class="w3-btn w3-teal w3-round-xxlarge">Annuler</button></p>
  <?php
      if (isset($erreur))
      {?>
         <script>  alert('<?php  echo  $erreur  ;?>')</script>
      <?php   
      }

        ?>
</form><br/>

		<h2 class="w3-text-teal w3-padding-16" style="margin-left:15px;"><i>Liste des Professeurs</i></h2>
<?php   
    $bdd = new PDO('mysql:host=127.0.0.1; dbname=scolarite1','root', '');
    
    
      $_select = $bdd->prepare("SELECT * FROM professeur order by idpo desc limit 10");
    
    
    $_select->execute();
    ?>
	<form method="POST" action="">
  <div class="input-group">
  <label for="choix" style="margin-left:15px;">Rechercher par </label>
    <select class=""  style="width:150px; margin-left:15px;" name="choix">
      <option value="">Nom</option>
      <option value="">Contact</option>
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
        <th>Nom </th>
        <th>Prénom 1</th>
		<th>Prénom 2</th>
		<th>Sexe</th>
		<th>Contact</th>
        <th>Operations</th>
      </tr>
    </thead>
    <tbody>

     <?php  while ($s=$_select->fetch(PDO::FETCH_OBJ)) {
?>    
      <tr>
        <td><?php echo $s->idpo;?></td>
        <td><?php echo $s->no;?></td>
        <td><?php echo $s->p1;?></td>
        <td><?php echo $s->p2;?></td>
        <td><?php echo $s->sx;?></td>
		<td><?php echo $s->ct;?></td>
        <td>
       <a href="index_etablissement_professeur_action.php?idpo=<?php echo $s->idpo;?>" target="_parent"  style="text-decoration:none;">Action</a></td>
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
<?php

  }else{
    echo "Desole";
  }
?>
