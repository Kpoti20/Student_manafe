<?php
	$connect = mysqli_connect("localhost", "root", "", "scolarite1");
	if (isset($_POST["ryr"])) 
	{
		$outer = '';
		$ryr = "SELECT * FROM matiere WHERE nom LIKE '%".$_POST["ryr"]."%'";
		$result = mysqli_query($connect, $ryr);
		$outer = '<ul class="list-unstyled">';
		if (mysqli_num_rows($result) > 0)
		 {
			while ($ro = mysqli_fetch_array($result)) 
			{
				$outer .= '<li>'.$ro["nom"].'</li>';
			}
			
		}else
		{
			$outer .= '<li>Desole aucune matiere ne correspond à votre recherche</li>';
		}
		$outer .='</ul>'; 
		echo $outer;

	}
?>