<?php
	session_start();
  $bdd = new PDO('mysql:host=127.0.0.1; dbname=scolarite1','root', '');
if(isset($_POST['formconnexion']))
{
	$tel= $_POST['tel'];
	$mdp= sha1($_POST['mdp']);
	if (!empty($tel) AND !empty($mdp)) {
		//echo "BJ";
		$requser = $bdd->prepare("SELECT * FROM professeur WHERE ct= ? AND motdepasse = ? ");
		$requser->execute(array($tel,$mdp));
		$userexist=$requser->rowCount();
		if ($userexist==1) {
			$userinfo = $requser->fetch();
			$_SESSION['idpo']= $userinfo['idpo'];
			$_SESSION['pseudo']= $userinfo['pseudo'];
			$_SESSION['ct']= $userinfo['ct'];
			header("location:index_professeur_comte.php?idpo=".$_SESSION['idpo']);
		}else{
			$erreur= " Mauvais numéro de téléphone ou Mot de passe incorrect ";
		}
	}else
	{
		$erreur="Tous les champs doivent etre renseignés !!";
	} 
}

?>
<!DOCTYPE html>
<html>
<title>COPEGENE</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">

<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4 {font-family:"Lato", sans-serif}
.mySlides {display:none}
.w3-tag, .fa {cursor:pointer}
.w3-tag {height:15px;width:15px;padding:0;margin-top:6px}
</style>
<body>

<!-- Links (sit on top) -->
<div class="w3-top">
  <div class="w3-row w3-large">
    <div class="w3-col s3">
      <a href="#" class="w3-btn-block w3-light-grey">Accueil</a>
    </div>
    <div class="w3-col s3">
      <a href="#plans" class="w3-btn-block w3-light-grey">Etablissement</a>
    </div>
    <div class="w3-col s3">
      <a href="#about" class="w3-btn-block w3-light-grey">Professeur</a>
    </div>
    <div class="w3-col s3">
      <a href="#contact" class="w3-btn-block w3-light-grey">Contact</a>
    </div>
  </div>
</div>

<!-- Content -->
<div class="w3-content" style="max-width:1100px;margin-top:80px;margin-bottom:80px">

  <div class="w3-panel">
    <h1><img src="P/lop.png" style="margin-right:10px;">DEFITECH EDUCATION</h1>
    
  </div>

  <!-- Slideshow -->
  <div class="w3-container">
    <div class="w3-display-container mySlides">
      <img src="P/a.jpg" style="width:100%">
      <div class="w3-display-topleft w3-container w3-padding-32">
        <span class="w3-white w3-padding-large w3-animate-bottom">ARLE 2</span>
      </div>
    </div>
    <div class="w3-display-container mySlides">
      <img src="w3images/workbench.jpg" style="width:100%">
      <div class="w3-display-middle w3-container w3-padding-32">
        <span class="w3-white w3-padding-large w3-animate-bottom">Klorim tipsum</span>
      </div>
    </div>
    <div class="w3-display-container mySlides">
      <img src="w3images/sound.jpg" style="width:100%">
      <div class="w3-display-topright w3-container w3-padding-32">
        <span class="w3-white w3-padding-large w3-animate-bottom">Blorum pipsum</span>
      </div>
    </div>

    <!-- Slideshow next/previous buttons -->
    <div class="w3-container w3-dark-grey w3-padding-8 w3-xlarge">
      <div class="w3-left" onclick="plusDivs(-1)"><i class="fa fa-arrow-circle-left w3-hover-text-teal"></i></div>
      <div class="w3-right" onclick="plusDivs(1)"><i class="fa fa-arrow-circle-right w3-hover-text-teal"></i></div>
    
      <div class="w3-center">
        <span class="w3-tag demodots w3-border w3-transparent w3-hover-white" onclick="currentDiv(1)"></span>
        <span class="w3-tag demodots w3-border w3-transparent w3-hover-white" onclick="currentDiv(2)"></span>
        <span class="w3-tag demodots w3-border w3-transparent w3-hover-white" onclick="currentDiv(3)"></span>
      </div>
    </div>
  </div>
  
  
  <div  class="w3-row w3-container">
  <div class="w3-center w3-padding-64">
    <div class="col-sm-8">
      <h2>About </h2><br>
      <h3>COPEGENE est une application de controle de presence et gestion des notes des étudiants. L'application web est spécialement conçue pour les établissements d’enseignement supérieurs 
		et les professeurs qui dispensent des cours dans ces établissements. COPEGENE met à la disposition des professeurs la possibilité d'envoyer la liste de présence des étudiants à l'administration ainsi que les notes obtenues par les étudiants apres chaque évaluation.</h3>
      <br>
    </div>
   
  </div>
</div>
  
  <!-- Grid -->
  

  <!-- Grid -->
  <div class="w3-row w3-container" id="plans">
    <div class="w3-center w3-padding-64">
      <span class="w3-xlarge w3-bottombar w3-border-dark-grey w3-padding-16">Inscription Etablissement</span>
    </div>
	<div class="col-sm-8">
     <h4>L'utilisation de GOPEGENE permet à l'établissement d’enseignement supérieur de recueillir apres chaque heure de cours le nombre(s) d'étudiant(s) absent(s).
	  Grace à la création d’un <a style="text-decoration:none;" href="index_etablissement_inscription.php" target="_parent"><strong style="color:#B25312;" >compte établissement
	  </strong></a> l’administration pourra creer la liste des étudiants des étudiants par filieres. A la fin de chaque jour de cours l'administration pourra consulter la statistique des étudiants absents. 
	  De plus apres la remise des copies des évaluations aux étudiants l'administration aura la note d'évaluation de chaque étudiant, ce qui sera indispensable pour la constitution du bulletin de fin de trimestre ou semestre.<a style="text-decoration:none;"
	  href="index_etablissement_connexion.php" target="_parent"><strong style="color:#B25312;">Connectez-vous</strong></a> pour vivre cette expérience ! </h4><br>
      <!--<p><strong>VISION:</strong> </p>-->
    </div>
    <div class="w3-col l3 m6 w3-light-grey w3-container w3-padding-12">
      <h3>DA 1 et DA 2</h3>
      <p>Niveau de formation BTS. Developpeur d'application premiere et deuxieme annee.</p>
    </div>

    <div class="w3-col l3 m6 w3-grey w3-container w3-padding-12">
      <h3>ARLE 1 et ARLE 2</h3>
      <p>Niveau BTS. Administration Reseaux et Locaux d'Entreprise premiere et deuxieme annee.</p>
    </div>

    <div class="w3-col l3 m6 w3-dark-grey w3-container w3-padding-12">
		<h3>AG 1 et AG 2</h3>
      <p>Niveau BTS. Assistant de Gestion des PME et PMI premiere et deuxieme annee.</p>
    </div>

    <div class="w3-col l3 m6 w3-black w3-container w3-padding-12">
      <h3>TLCOM 1 et 2</h3>
      <p>Niveau de formation BTS. Telecommunication premiere et deuxieme annee.</p>
    </div>
  </div>

  <!-- Grid -->
  <div class="w3-row-padding" id="about">
    <div class="w3-center w3-padding-64">
      <span class="w3-xlarge w3-bottombar w3-border-dark-grey w3-padding-16">Connexion Professeur</span>
    </div>
		<div class="col-sm-8">
		<form class="w3-container w3-card-4" method="POST" action="<?php echo htmlspecialchars("index_professeur_connexion.php");?>">
		 
		       
		  <label for="tel" class="w3-text-black"><b>Numéro de téléphone </b></label>
		  <input class="w3-input w3-border" type="tel" value="<?php if (isset($tel)) {echo $tel;} ?>" placeholder="228 XX XX XX XX" id="tel" name="tel" ></p>
		  <p>
			<label for="mdp" class="w3-text-black"><b>Mot de passe</b></label>
		  <input class="w3-input w3-border" type="password"  placeholder="Votre mot de passe" id="mdp" name="mdp" >
		  </p>
		  
		  <p>      
		  <button type="submit" name="formconnexion" class="w3-btn w3-black">S'inscrire</button>
		  
		  <button type="reset" class="w3-btn w3-black">Annuler</button> <a  href="index.php"  class="w3-btn w3-black">Retour</a></p>
		   <?php
      if (isset($erreur))
      {?>
         <script>  alert('<?php  echo  $erreur  ;?>')</script>
      <?php   
      }

        ?>
	  <br></form>
      <!--<p><strong>VISION:</strong> </p>-->
    </div>
   </div> 

   

  <!-- Contact -->
  <div class="w3-center w3-padding-64" id="contact">
    <span class="w3-xlarge w3-bottombar w3-border-dark-grey w3-padding-16">Contactez Nous</span>
  </div>

  <form class="w3-container" action="http://www.w3schools.com/w3css/form.asp" target="_blank">
    <div class="w3-group">
      <label>Name</label>
      <input class="w3-input w3-border w3-hover-border-black" style="width:100%;" type="text" name="Name" required>
    </div>
    <div class="w3-group">
      <label>Email</label>
      <input class="w3-input w3-border w3-hover-border-black" style="width:100%;" type="text" name="Email" required>
    </div>
    <div class="w3-group">
      <label>Subject</label>
      <input class="w3-input w3-border w3-hover-border-black" style="width:100%;" name="Subject" required>
    </div>
    <div class="w3-group">
      <label>Message</label>
      <input class="w3-input w3-border w3-hover-border-black" style="width:100%;" name="Message" required>
    </div>
    <button type="submit" class="w3-btn w3-btn-block w3-padding-12">Send</button>
  </form>

</div>

<!-- Footer -->

<footer class="w3-container w3-padding-32 w3-light-grey w3-center">
  <h4></h4>
  <a href="#" class="w3-btn w3-padding w3-black w3-margin"><i class="fa fa-arrow-up w3-margin-right"></i>To the top</a>
  <div class="w3-xlarge w3-section">
    <i class="fa fa-facebook-official w3-hover-text-indigo"></i>
    <i class="fa fa-instagram w3-hover-text-purple"></i>
    <i class="fa fa-snapchat w3-hover-text-yellow"></i>
    <i class="fa fa-pinterest-p w3-hover-text-red"></i>
    <i class="fa fa-twitter w3-hover-text-light-blue"></i>
    <i class="fa fa-linkedin w3-hover-text-indigo"></i>
  </div>
  <p>Powered by <a href="default.html" title="W3.CSS" target="_blank" class="w3-hover-text-green">Joel AHOLOU</a></p>
</footer>


<script>
// Slideshow
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function currentDiv(n) {
  showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demodots");
  if (n > x.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = x.length} ;
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
     dots[i].className = dots[i].className.replace(" w3-white", "");
  }
  x[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " w3-white";
}
</script>

</body>

<!-- Mirrored from www.w3schools.com/w3css/tryit.asp?filename=tryw3css_templates_marketing&stacked=h by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Dec 2016 15:09:51 GMT -->
</html>
