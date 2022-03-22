<?php
  session_start();
  $bdd = new PDO('mysql:host=127.0.0.1; dbname=scolarite1','root', '');
  
             if(isset($_POST['valider']))
              {
                        $idr=$_POST['idr'];
                        $note=$_POST['note'];
                        $_update = $bdd->prepare("UPDATE resultat SET note='$note'  WHERE idr=$idr ");
                        $_update->execute();
                        $erreur="Modification effectuée avec succes! ";

               } 
              else
              {
               // $erreur="ATTENTION !!! Risque de doublon un enregistrement deja effectué correspond avec cette modification";
              }  


          if(isset($_POST['supprimer']))
           {
           $ida=$_POST['code'];
           $_delete = $bdd->prepare("DELETE  FROM absence WHERE ida=$ida");
           $_delete->execute();
           $erreur="Suppression effectuée avec succes! ";
           }



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
      include_once 'index_control_note_action.php';
    ?>
<!-- Sidenav/menu -->
<nav class="w3-sidenav w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidenav"><br>
  <div class="w3-container">
    <a href="#" onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding" title="close menu">
      <i class="fa fa-remove"></i>
    </a> 
    <img src="w3images/avatar_g2.jpg" style="width:45%;" class="w3-circle"><br><br>
    <h4 class="w3-padding-0"><b> Profil :<?php echo $_SESSION['pseudos']; ?></b></h4>
    <p class="w3-text-grey"></p>
	
  </div>
  <a href="index_professeur_comte.php?idpo=<?php echo ($_SESSION['idpo']);?>" onclick="w3_close()" class="w3-padding w3-text-teal"><i class="fa fa fa-info-circle fa-fw w3-margin-right"></i>INFORMATION</a> 
  <a href="#about" onclick="w3_close()" class="w3-padding"><i class="fa fa-envelope fa-fw w3-margin-right"></i>MESSAGE</a> 
  <!--<a href="#contact" onclick="w3_close()" class="w3-padding"><i class="fa fa-envelope fa-fw w3-margin-right"></i>CONTACT</a>-->
   <a href="index_control_presence.php?idpo=<?php echo ($_SESSION['idpo']);?>" onclick="w3_close()" class="w3-padding"><i class="fa  fa fa-check-square-o fa-fw w3-margin-right"></i>CONTROLE DE PRESENCE</a>
   <a href="#" onclick="w3_close()" class="w3-padding"><i class="fa fa fa-edit w3-margin-right"></i>GESTION DES NOTES</a>
   <a href="#" onclick="w3_close()" class="w3-padding"><i class="fa fa fa-bar-chart-o w3-margin-right"></i>STATISTIQUES</a>
   <a href="#" onclick="w3_close()" class="w3-padding"><i class="fa fa fa-cog w3-margin-right"></i>PARAMETRES</a>
   <a href="deconnexion.php" onclick="w3_close()" class="w3-padding"><i class="fa fa fa-sign-out w3-margin-right"></i>DECONNEXION</a>
  <div class="w3-section w3-padding-top w3-large">
    <a href="#" class="w3-hover-white w3-hover-text-indigo w3-show-inline-block"><i class="fa fa-facebook-official"></i></a>
    <a href="#" class="w3-hover-white w3-hover-text-purple w3-show-inline-block"><i class="fa fa-instagram"></i></a>
    <a href="#" class="w3-hover-white w3-hover-text-yellow w3-show-inline-block"><i class="fa fa-snapchat"></i></a>
   
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
  <?php
    $bdd = new PDO('mysql:host=127.0.0.1; dbname=scolarite1','root', '');
            $idpo=$_GET['idpo'];
            $_select = $bdd->prepare("SELECT idr,noe,etu,mat,note FROM resultat,examen,etudiant WHERE resultat.idet=etudiant.idp and resultat.idex=examen.ide and idr=$idpo ");
            $_select->execute();
            while ($s=$_select->fetch(PDO::FETCH_OBJ)) {
  ?>
  <div class="w3-panel w3-card-12 w3-margin-bottom w3-white" style="width:1050px;">
		<div class="w3-container w3-grey">
  <h2>Opérations sur l'étudiant(e) : <?php echo $s->etu; ?></h2>
</div>
<br/>
	<div class="w3-content">
          
            <form method="POST" action="">
                <p>
          <label>Examen</label>
            <select name="noe" class="w3-select" id="noe" >
                <option><?php echo $s->noe;?></option>
              </select>
            </p>
             <p>
          <input type="hidden"  value="<?php echo $s->idr; ?>" readonly="true" name="idr">
          <label>Nom</label>
          <input class="w3-input" value="<?php echo $s->etu;?>" autocomplete="off" name="etu" type="text"></p>

                 <p>
          <label>Matiere</label>
          <input class="w3-input" value="<?php echo $s->mat;?>" autocomplete="off" name="mat" type="text"></p>
          <p>
          <label>Note</label>
          <input class="w3-input" value="<?php echo $s->note;?>" autocomplete="off" name="note" type="float"></p>
              <br/><br/>
              <button  type="submit" class="btn btn-success" name="valider" >Modifier</button>
            </form><br/>
            
              </div>
              <?php 
      }
        ?>
<br/><br>
<?php 
      $bdd = new PDO('mysql:host=127.0.0.1; dbname=scolarite1','root', '');
             $idpo=$_GET['idpo'];
            $_select = $bdd->prepare("SELECT idr,noe,etu,mat,note FROM resultat,examen,etudiant WHERE resultat.idet=etudiant.idp and resultat.idex=examen.ide and idr=$idpo ");
            $_select->execute();
            while ($z=$_select->fetch(PDO::FETCH_OBJ)) {
        ?>
  <div>
    <p style="margin-left: 15px;">
    Voulez-vous réellement supprimer la note de l'étudiant(e) : <?php echo $z->etu; ?>
      <form method="POST" action="">
        <input type="hidden"  value="<?php echo $z->idr; ?>" readonly="true" name="code">
        <button type="submit" class="btn btn-danger" style="margin-left:15px;" name="supprimer" >Supprimer</button>
      </form>
      </p>
      
  
  </div>
  <?php 
      }
        ?>
<br/><br/>

<?php
      if (isset($erreur))
      {?>
         <script>  alert('<?php  echo  $erreur  ;?>')</script>
      <?php   
      }

        ?>
  <p style="margin-left: 700px;"><b><i class="fa fa fa-arrow-left fa-fw w3-margin-right w3-text-teal"></i><a href="index_control_note.php?idpo=<?php echo ($_SESSION['idpo']);?>" target="_parent" class="w3-padding-2" style="text-decoration:none;">Retour Gestion de note</a></b></p>

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
    $('#nom').keyup(function(){
      var query = $(this).val();
      if (query != '') 
      {
        $.ajax({
          url:"search_presence.php",
          method:"POST",
          data:{query:query},
          success:function(data)
          {
            $('#nomList').fadeIn();
            $('#nomList').html(data);
          }
        }); 
      } 
    });
    $(document).on('click', 'li', function(){
      $('#nom').val($(this).text());
      $('#nomList').fadeOut();
    });
  });
</script>

