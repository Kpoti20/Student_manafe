<?php
	$connect = mysqli_connect("localhost", "root", "", "scolarite1");
	if (isset($_POST["query"])) 
	{
		$output = '';
		$query = "SELECT * FROM etudiant WHERE etu LIKE '%".$_POST["query"]."%'";
		$result = mysqli_query($connect, $query);
		$output = '<ul class="list-unstyled">';
		if (mysqli_num_rows($result) > 0)
		 {
			while ($rows = mysqli_fetch_array($result)) 
			{
				$output .= '<li>'.$rows["etu"].'</li>';
			}
			
		}else
		{
			$output .= '<li>Desole aucun étudiant ne correspond à votre recherche</li>';
		}
		$output .='</ul>'; 
		echo $output;

	}
?>