<?php
	session_start();
	
	include 'header.php';
	//include 'include/function.php';
		function input_statist()
	{
		$file = fopen('articl.csv', 'r');
		$statist = array();
		while (!feof($file))
		{
			$a = fgetcsv($file,1000,';');
			if ($a[0] !== NULL)
			{
				$statist[] = $a[6];
			}
		}
		fclose($file);
		$_SESSION['statist'] = $statist;
	}
		function input_articles()
	{
		$file = fopen('articl.csv', 'r');
		$articles = array();
		while (!feof($file))
		{
			$a = fgetcsv($file,10000,';');
			if ($a[0] !== NULL)
			{
				$articles[] = $a;
			}
		}
		fclose($file);
		$_SESSION['articles'] = $articles;
	}
	
	echo "<div id='user'>ОТЧЕТ ПО ПРОСМОТРАМ СТАТЕЙ</div>";
	
	if (!isset($_SESSION['articles']))
	{
		input_articles();
	}
	if (!isset($_SESSION['statist']))
	{
		input_statist();
	}
	
	$statist = $_SESSION['statist'];
	$articles = $_SESSION['articles'];
	
	echo '<div class = "cnt" style = "background:white; width:100%; display:block;">';
	echo '<img src="diagram.php">';
	echo '<br>';
	for ($i = 1; $i < count($articles)+1; $i++)
	{
		echo '<a class = "diag" style = "width:32px">'.$i.'</a>';
	}
	echo '</div>';
	
	/*echo "<div id='user'>ТАБЛИЦА ПРОСМОТРОВ СТАТЕЙ</div>";
	echo "<div class = 'cntt'> ";
	echo "<table>";
	echo "<th>id</th> <th>Название</th> <th>Количество просмотров</th>";
	for ($i = 0; $i < count($articles); $i++)
	{
		echo "<tr>";
		echo "<td>".$i."</td><td>".$articles[$i][1]."</td><td>".$statist[$i][0]."</td>";
		echo "</tr>";
	}
	echo "</table><div>";*/
	

?>