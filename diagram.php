<?php
	session_start();
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
	// Значение столбцов от 0 до 100
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
	
	$sum = 0;
	for ($i = 0; $i < count($statist); $i++)
	{
		$sum = $sum + $statist[$i][0];
	}

	// Ширина изображения
	$width = 1200;
	// Высота изображения
	$height = $sum*25;
	// Ширина одного столбца
	$rowWidth = 50;
	// Ширина интервала между столбцами
	$rowInterval = 10;

	// Создаем пустое изображение
	$img = imagecreatetruecolor($width, $height);

	// Заливаем изображение белым цветом
	$white = imagecolorallocate($img, 220, 225, 225); 
	imagefill($img, 0, 0, $white);

	for($i = 0, $y1 = $height, $x1 = 0; $i < count($statist); $i++) {
	  // Формируем случайный цвет для каждого из столбца
	  $color = imagecolorallocate($img, rand(0, 255), rand(0, 255), rand(0, 255)); 

	  // Нормирование высоты столбца
	  $y2 = $y1 - $statist[$i][0]*$height/$sum;
	  // Определение второй координаты столбца
	  $x2 = $x1 + $rowWidth;
	  // Отрисовываем столбец
	  imagefilledrectangle($img, $x1, $y1, $x2, $y2, $color);
	  // Между столбцами создаем интервал в $row_interval пикселей
	  $x1 = $x2 + $rowInterval;
	//  imagettftext($img, 15, 0, 10, 10, black,$image, $i);
	}

	// Выводим изображение в браузер, в формате GIF
	header ("Content-type: image/gif"); 
	imagegif($img);
?>