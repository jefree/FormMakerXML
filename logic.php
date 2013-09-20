
<?php

	$tipos = array("numerico" => "number",
					"cadena" => "text",
					"mail" => "email");

?>

<html>

<head>
	<title>EJERCICIO XML</title>
</head>

<body>

	<?php

		$doc = simplexml_load_file('data.xml');

		foreach ($doc as $element) {
			
			
			echo "<h1>",$element->getName(),"</h1>";
			echo "<form>";

			foreach ($element as $field) {

				echo "<div><input ";

				echo "id='", $field->.getName(), "' ";

				if ($field->attributes()["validador"]) {

					$t = $field->attributes()["validador"];
					echo "type='", $tipos[(string)$t], "' ";
				}
				else if ($field->attributes()["tipo"]) {

					$t = $field->attributes()["tipo"];
					echo "type='", $tipos[(string)$t], "' ";
				}

				echo "/>";
				echo "<label for='", $field->getName()
			}

			echo "</from>";

		}


	?>


</body>

</html>