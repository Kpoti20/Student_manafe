<?php
	$connect = mysqli_connect("localhost", "root", "", "scolarite1");
	if (isset($_POST["query"])) 
	{
		$output = '';
		$query = "SELECT * FROM professeur WHERE pop LIKE '%".$_POST["query"]."%'";
		$result = mysqli_query($connect, $query);
		$output = '<ul class="list-unstyled">';
		if (mysqli_num_rows($result) > 0)
		 {
			while ($rows = mysqli_fetch_array($result)) 
			{
				$output .= '<li>'.$rows["pop"].'</li>';
			}
			
		}else
		{
			$output .= '<li>Desole aucun professeur ne correspond à votre recherche</li>';
		}
		$output .='</ul>'; 
		echo $output;

	}
?>