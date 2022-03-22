<?php
  session_start();
  $bdd = new PDO('mysql:host=127.0.0.1; dbname=scolarite1','root', '');
  if(isset($_POST['valider']))
{
            $idt=$_POST['et'];
            $nom = htmlspecialchars(trim($_POST['nom']));
            $pre = htmlspecialchars(trim($_POST['pre']));
            $pre1 = htmlspecialchars(trim($_POST['pre1']));
            $sx = $_POST['sx'];
            $ct= $_POST['ct'];
            $fil = $_POST['fil'];
            
                      
  if(!empty($nom) AND !empty($pre) AND !empty($pre1) AND ($sx!="Selectionnez le sexe") AND !empty($ct) AND ($fil!="Selectionnez la filiere de l'étudiant") ){
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
                    if($fil!="Selectionnez la filiere de l'étudiant")
                   {
                    
             
                        $reqenre=$bdd->prepare("SELECT * FROM etudiant WHERE nom_e = ? and pren = ? and preno = ? and sexe = ? and contact_e = ? and code_f = ? ");
                        $reqenre->execute(array($nom,$pre,$pre1,$sx,$ct,$fil));
                        $enregistrexist =$reqenre->rowcount();
                        if($enregistrexist == 0)
                        {           
                              $_update = $bdd->prepare("UPDATE etudiant SET nom_e='$nom', pren='$pre', preno='$pre1', sexe='$sx', contact_e='$ct', code_f='$fil' WHERE idp=$idt ");
                              $_update->execute();
                              $erreur="Modification effectuée avec succes! ";
							  
                         } 
                        else
                        {
                          $erreur="ATTENTION !!! Risque de doublon un enregistrement deja effectué correspond avec cette modification";
                        }
                    }
                      else
                      {
                        $erreur="SVP Veuillez selectionnez la filiere de l'etudiant !";
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


          if(isset($_POST['supprimer']))
           {
           $idt=$_POST['et'];
           $_delete = $bdd->prepare("DELETE  FROM etudiant WHERE idp=$idt");
           $_delete->execute();
           $erreur="Suppression effectuée avec succes! ";
           }
  
?>