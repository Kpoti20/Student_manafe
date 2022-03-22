<?php
  session_start();
  $bdd = new PDO('mysql:host=127.0.0.1; dbname=scolarite1','root', '');
  
   if(isset($_POST['forminscription']))
{
    $nom = $_POST['nom'];
    $cour = $_POST['cour'];
    $no  = $_POST['no'];
    
    $nbretud = $_POST['nbretud'];
    
    for($i=1; $i<=$nbretud; $i++)
     { 
       if((isset($_POST['idetud'.$i])) and (isset($_POST['ide'.$i])))
      {
          $idetud = $_POST['idetud'.$i];
          $ide = $_POST['ide'.$i];
          $not = $_POST['not'.$i];
          $datactu = date('Y-m-d');  
          $reqenre=$bdd->prepare("SELECT * FROM resultat WHERE ljr ='$datactu' and idet = ? and idex = ? and mat = ? ");
          
           $reqenre->execute(array($idetud,$ide,$cour));
           $enregistrexist =$reqenre->rowcount();
              if($enregistrexist == 0)
              { 
                
                  $inserttut = $bdd->prepare("INSERT INTO resultat(ljr,idet,idex,mat,note) VALUES ('$datactu',?,?,?,?)");
                  $inserttut->execute(array($idetud,$ide,$cour,$not));
             } 
              else
              {
                $erreur="ATTENTION !!! Enregistrement deja effectué";
              }
      }

    }
}		 

if (isset($_GET['idpo'])) 
{
    $getid = intval($_GET['idpo']);
    $requser = $bdd->prepare('SELECT * FROM professeur WHERE idpo = ? ');
    $requser->execute(array($getid));
    $userinfo=$requser->fetch(); 
    $_SESSION['idpo'] = $userinfo['idpo'];
    $_SESSION['pseudos']= $userinfo['pseudo'];
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
      include_once 'index_control_note.php';
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
   <a href="index_control_presence.php?idpo=<?php echo ($_SESSION['idpo']);?>" onclick="w3_close()" class="w3-padding"><i class="fa  fa fa-check-square-o fa-fw w3-margin-right"></i>CONTROLE DE PRESENCE</a>
   
   <a href="index_control_note.php?idpo=<?php echo ($_SESSION['idpo']);?>" onclick="w3_close()" class="w3-padding"><i class="fa fa fa-edit w3-margin-right"></i>GESTION DES NOTES</a>
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
  <h2>GESTION DES NOTES</h2>
</div>
<br/>
	<form method="POST" action="">
  <div class="input-group">
  <label for="no" style="margin-left:15px;">Examen</label>
  <select style="width:150px; margin-left:15px;" name="no">
    <option value="">Selectionnez un examen </option>
     <?php
     $_select=$bdd->query("SELECT *  FROM examen ");
         while ($o = $_select->fetch(PDO::FETCH_OBJ)) {
     ?>

           <option><?php echo $o->noe; ?></option>
     <?php
         }
     ?>
   </select>
  
  <label for="mat" style="margin-left:15px;">Matiere</label>
  <select style="width:150px; margin-left:15px;" name="mat">
    <option value="">Selectionnez une matiere </option>
     <?php
     $idprof= $_GET['idpo'];
     $_select=$bdd->query("SELECT mat  FROM seance WHERE idpro='$idprof' ");
         while ($a = $_select->fetch(PDO::FETCH_OBJ)) {
     ?>

           <option><?php echo $a->mat; ?></option>
     <?php
         }
     ?>
   </select>
  
  <label for="fil" style="margin-left:15px;">Filiere</label>
	<select style="width:150px; margin-left:15px;" name="fil">
		<option value="">Selectionnez la filiere de l'étudiant</option>
     <?php
     $idprof= $_GET['idpo'];
     $_select=$bdd->query("SELECT fil  FROM seance WHERE idpro='$idprof' ");
         while ($S = $_select->fetch(PDO::FETCH_OBJ)) {
     ?>

           <option><?php echo $S->fil; ?></option>
     <?php
         }
     ?>
   </select>
	<button class="btn btn-default" type="submit" name="liste" style="margin-left:20px; " >Voir la liste de classe</button>
	<br/><br/>
</form>
</div>
<br/>
<?php   
    $bdd = new PDO('mysql:host=127.0.0.1; dbname=scolarite1','root', '');
	
    if(isset($_POST['liste'])){
	  $fil=$_POST['fil'];
    $mat=$_POST['mat'];
    $no=$_POST['no'];
    $idprof= $_GET['idpo'];
    $_select = $bdd->prepare("SELECT ide,noe,idp,etu,mat FROM etudiant,seance,examen WHERE noe='$no' and code_f='$fil' and idpro='$idprof'");
    $_select->execute();
	
    ?>
 <div class="table-responsive ">
<form method="POST" action="">
  <table style="width:820px; margin-left:10px;">
    <thead>
      <tr>
        <th>EXAMEN</th>
        <th>NOM ET PRENOMS</th>
		    <th>MATIERE</th>
        <th>NOTE</th>
      </tr>
    </thead>
    <tbody>
     <?php  
     $lignes=0;
     while ($s=$_select->fetch(PDO::FETCH_OBJ)) {
      $lignes++;
?>    
      <tr>
        <td><input style="border:none;"  type="text" value="<?php echo  $s->noe;?>" name="no">
          <input style="border:none;"  type="hidden" value="<?php echo  $s->ide;?>" name="ide<?php echo $lignes;?>"></td>
        <td>
          <input style="border:none;"  type="text" value="<?php echo  $s->etu;?>" name="nom">
          <input style="border:none;"  type="hidden" value="<?php echo  $s->idp;?>" name="idetud<?php echo $lignes;?>">
        </td>
        <td><input style="border:none;"  type="text" value="<?php echo  $s->mat;?>" name="cour" ></td>
        <td>
          <input style="border:none;"  type="float"  name="not<?php echo $lignes; ?>" >
        </td>
       <?php
                    }
                    ?>
	</div>
      </tr>
    </tbody>
  </table><br/>
  <input type="hidden" name="nbretud" value="<?php echo $lignes; ?>">
       <button  type="submit" class="btn btn-success" style="margin-left: 15px;" name="forminscription" value="Sauvegarder" >Sauvegarder</button>
  <br/>
           <?php    }    ?>
<?php
      if (isset($erreur))
      {?>
         <script>  alert('<?php  echo  $erreur  ;?>')</script>
      <?php   
      }

        ?>
           
 </form><br/><br/>



<?php   
    $bdd = new PDO('mysql:host=127.0.0.1; dbname=scolarite1','root', '');
      $_sel = $bdd->prepare("SELECT distinct idr,ljr,noe,etu,mat,note FROM resultat,etudiant,examen WHERE resultat.idet=etudiant.idp and resultat.idex=examen.ide");
    $_sel->execute();
    ?>

 <div class="table-responsive ">
  <h4 style="margin-left: 10px;">Notes d'examen</h4>
   <table style="width:820px; margin-left:10px;">
    <thead>
     <tr>
       <th>Date</th>
       <th>Examen</th>
       <th>Nom</th>
       <th>Matiere</th>
       <th>Note</th>
       <th>Opérations</th>
     </tr>
     </thead>
     <tbody>
       <?php  while ($w=$_sel->fetch(PDO::FETCH_OBJ)) {
?>  
     <tr>
       <td><?php echo $w->ljr; ?></td>
       <td><?php echo $w->noe; ?></td>
       <td><?php echo $w->etu; ?></td>
       <td><?php echo $w->mat; ?></td>
       <td><?php echo $w->note; ?></td>
       <td><a href="index_control_note_action.php?idpo=<?php echo $w->idr;?>" target="_parent"  style="text-decoration:none;">Action</a></td>
       <?php
                    }
                    ?>
     </tr>
     </tbody>
   </table>
 </div><br/><br/>


  
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
<?php

  }else{
    echo "Desole";
  }
?>
