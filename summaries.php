<?php

	$host = "localhost";
	$dbname = "summary_project";
	$username= "summary_project";
	$password = "123456";
	$dsn = "mysql:host=$host;dbname=$dbname";
	$attr = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
	$pdo = new PDO($dsn, $username, $password, $attr);

	// add form data to summaries table, if form sent
	if(!empty($_POST))
	{
		if($_POST['author_name'] !== "" && $_POST['title'] !== "" && $_POST['content'] !== "" && $_POST['subject_id'] !== "")
		{
			$author_name = filter_input(INPUT_POST, 'author_name', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW);
			$title 		 = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW);
			$content     = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW);
			$subject_id  = filter_input(INPUT_POST, 'subject_id', FILTER_VALIDATE_INT);
			$statement = $pdo->prepare("INSERT INTO summaries (subject_id, author_name, date, title, content) VALUES (:subject_id, :author_name, NOW(), :title, :content)");
			$statement->bindParam(":subject_id", $subject_id);
			$statement->bindParam(":author_name", $author_name);
			$statement->bindParam(":title", $title);
			$statement->bindParam(":content", $content);
			if(!$statement->execute())
				print_r($statement->errorInfo());
		}
	}

	// show all posts from summaries table
	echo "<ul>";
	foreach($pdo->query("SELECT * FROM summaries ORDER BY date DESC") as $row)
	{
		echo "<li><a href=\"\">{$row['title']}, av {$row['author_name']} ({$row['date']})</a></li>";
	}
	echo "</ul>";

?>