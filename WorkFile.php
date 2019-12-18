<?php

include_once 'WorkStr.php';

$inpText = "Октябрь уж наступил — уж роща отряхает 
Последние листы с нагих своих ветвей; 
Дохнул осенний хлад — дорога промерзает. 
Журча еще бежит за мельницу ручей, 
Но пруд уже застыл; сосед мой поспешает 
В отъезжие поля с охотою своей, 
И страждут озими от бешеной забавы, 
И будит лай собак уснувшие дубравы.";

if(isset($_POST['validation']))
{
    
    if(!empty($_POST['message']))
    {
		$inpText = $_POST['message'];
		$workstr = new WorkStr($inpText);

		$workstr->inputCsv('text');
    }
    else if (!empty($_FILES['wordinpt'])) 
    {
    	//получение данных файла
		$file = $_FILES['wordinpt'];
		//сбор информации из файла
		$inpText = htmlentities(file_get_contents($file['tmp_name']));

		$workstr = new WorkStr($inpText);

		$workstr->inputCsv('files');
    } 
    else 
    {
    	echo "Введите данные!";
    }
}

?>

<p>
	<a href="index.php">back</a>
</p>



