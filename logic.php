
<?php

	$tipos = array("numerico" => "number",
					"cadena" => "text",
					"mail" => "email");

?>

<html>

<head>
	<title>EJERCICIO XML</title>
	<link rel="stylesheet" href="css/bootstrap.css">
</head>

<body>

	<?php

		$doc = simplexml_load_file('data.xml');

		foreach ($doc as $element) {
			
			
			echo "<h3>",strtoupper($element->getName()),"</h3>";
			echo "<form>";

			foreach ($element as $field) {

				echo "<div> <label for='", $field->getName(), "'>",$field->getName(),"</label>";

				echo "<input id='", $field->getName(), "' ";

				if ($field->attributes()["validador"]) {

					$t = $field->attributes()["validador"];
					echo "type='", $tipos[(string)$t], "' ";
				}
				else if ($field->attributes()["tipo"]) {

					$t = $field->attributes()["tipo"];
					echo "type='", $tipos[(string)$t], "' ";
				}

				echo ">";
				echo "</div>";
			}
			echo "<button type= 'submit' class='btn btn-primary'>Guardar</button>";
			echo "</from>";

		}


	?>


</body>

</html>