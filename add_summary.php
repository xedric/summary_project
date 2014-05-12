<?php

	$host = "localhost";
	$dbname = "summary_project";
	$username= "summary_project";
	$password = "123456";
	$dsn = "mysql:host=$host;dbname=$dbname";
	$attr = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
	$pdo = new PDO($dsn, $username, $password, $attr);

?>

<form action="summaries.php" method="POST">
	<p>
		<label for="author_name">Ditt namn: </label>
		<input type="text" name="author_name">
	</p>
	<p>
		<label for="title">Rubrik: </label>
		<input type="text" name="title">
	</p>
	<p>
		<label for="content">Sammanfattning: </label>
		<input type="text" name="content">
	</p>
		<p>
		<label for="subject_id">Ämne: </label>
		<select name="subject_id">

			<?php

				foreach($pdo->query("SELECT * FROM subjects ORDER BY name") as $row)
				{
					echo "<option value=\"{$row['id']}\">{$row['name']}</option>";					
				}

			?>

		</select>
	</p>
	<input type="submit" value="Lägg till sammanfattning">
</form>