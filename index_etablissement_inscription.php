<?php
  $bdd = new PDO('mysql:host=127.0.0.1; dbname=scolarite1','root', '');
if(isset($_POST['forminscription']))
{

    $pseudo = htmlspecialchars(trim($_POST['pseudo']));
    $mail = htmlspecialchars(trim($_POST['mail']));
    $mail2 = htmlspecialchars(trim($_POST['mail2']));
    $mdp = $_POST['mdp'];
    $mdp2 = $_POST['mdp2'];

  if(!empty($pseudo) AND !empty($mail) AND !empty($mail2) AND !empty($mdp) AND !empty($mdp2))
   
  {
     $mdpe = sha1($mdp);
    $mdp23 = sha1($mdp2);
    $pseudolength = strlen($pseudo);
    //$pseudo = test_input($_POST["pseudo"]);
    if($pseudolength <= 255)
    {
      if (preg_match("/^[a-zA-Z ]*$/",$pseudo)) 
      {
        if($mail == $mail2)
        {
          if(filter_var($mail,FILTER_VALIDATE_EMAIL))
          {
            $reqmail=$bdd->prepare("SELECT * FROM etablissement WHERE mail = ? ");
            $reqmail->execute(array($mail));
            $mailexist =$reqmail->rowcount();
            if($mailexist == 0)
            { 

              if($mdpe == $mdp23)
              {
                $insertmbr = $bdd->prepare("INSERT INTO etablissement(pseudo,mail,motdepasse) VALUES(?,?,?)");
                $insertmbr->execute( array($pseudo,$mail,$mdpe)); 
                "<br/>";
                $erreur="votre compte a ete cree avec succes!"; 
              }
              else
              {
                $erreur ="Vos mot de passe ne correspondent pas!";
              }
            } 
            else
            {
              $erreur="Ce Adresse mail est deja utiliser";
            }
        }
        else
        {
          $erreur="votre adresse mail n est pas valide!";
        }
      }
      else
      {
        $erreur="vos adresse mail ne correspondent pas!";
      }
    }
    else
    {
      $erreur = "Seuls les caractères alphabetiques sont autorisés";
    }
  }else
    {
      $erreur="votre pseudo ne dois pas depasser 255 caracteres!!!";
    }
  }
  else
  {
    $erreur = "veuillez remplir tous les champs!";
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
<?php 
      include_once 'index_etablissement_inscription.php';
    ?>
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
     
      <form class="w3-container w3-card-4" method="POST" action="">
		  <!--<h2 class="w3-text-blue">Inscription Etablissement</h2>-->
		  
		  <p>
		  <label for="pseudo" class="w3-text-black"><b>Pseudo</b></label>
		  <input class="w3-input w3-border" value="<?php if (isset($pseudo)) {echo $pseudo;} ?>" placeholder="Votre pseudo" id="pseudo" name="pseudo" type="text"></p>
		  <p>      
		  <label for="mail" class="w3-text-black"><b>Mail</b></label>
		  <input class="w3-input w3-border" type="email" value="<?php if (isset($mail)) {echo $mail;} ?>" placeholder="Votre mail" id="mail" name="mail" ></p>
		  <p>
			<label for="mail2" class="w3-text-black"><b>Confirmation de mail</b></label>
		  <input class="w3-input w3-border" type="email" value="<?php if (isset($mail2)) {echo $mail2;} ?>" placeholder="Confirmer votre mail" id="mail2" name="mail2" >
		  </p>
		  <p>
			<label for="mdp" class="w3-text-black"><b>Mot de passe</b></label>
		  <input class="w3-input w3-border" type="password"  placeholder="Votre mot de passe" id="mdp" name="mdp" >
		  </p>
		  <p>
			<label for="mdp2" class="w3-text-black"><b>Confirmer votre mot de passe</b></label>
		  <input class="w3-input w3-border" type="password"  placeholder="Votre mot de passe" id="mdp2" name="mdp2" >
		  </p>
		  <p>      
		  <button type="submit" name="forminscription" class="w3-btn w3-black">S'inscrire</button>
		  
		  <button type="reset" class="w3-btn w3-black">Annuler</button> <a  href="index.php"  class="w3-btn w3-black">Retour</a></p>
		   <?php
      if (isset($erreur))
      {?>
         <script>  alert('<?php  echo  $erreur  ;?>')</script>
      <?php   
      }

        ?>
	  </form>
  </div>

  <!-- Grid -->
  <div class="w3-row-padding" id="about">
    <div class="w3-center w3-padding-64">
      <span class="w3-xlarge w3-bottombar w3-border-dark-grey w3-padding-16">Professeur</span>
    </div>
		<div class="col-sm-8">
      <h4>En vue d’atteindre l’objectif de l'application web, l'utilisation d'un smartphone est vivement conseillé. Les professeurs peuvent disposer d'un compte qui leur permettra de controler les presences d'étudiants aux cours 
		et d'envoyer les notes d'évaluations à la fin de chaque évaluation. Grace à la <a style="text-decoration:none; cursor:pointer;" 
	  href="index_inscription_parent.php" target="_parent"><strong style="color:#B25312;" >création d’un compte professeur </strong></a>, les professeurs peuvent consulter les absences des étudiants
	   et leurs notes à une évaluation donnée.<a style="text-decoration:none;" href="index_connexion_parent.php" 
	  target="_parent"><strong style="color:#B25312;">Connectez-vous</strong></a> pour vivre l’expérience! </h4><br>
      <!--<p><strong>VISION:</strong> </p>-->
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
