<?php

Class WorkStr
{
	private $strok;

	private $fp;

	public function __construct($strok)
	{
		$this->strok = $strok;
	}

	public function getStrok()
	{
		return $this->strok;
	}

	private function explodStr()
	{
		//разбиваем входную строку на массив 
		$mas_strok = explode(" ", $this->strok);
		//удаляем справа лишние знаки
		for ($i = 0; $i < count($mas_strok); $i++)
		{
			$mas_strok[$i] = rtrim($mas_strok[$i], ",");
			$mas_strok[$i] = rtrim($mas_strok[$i], ";");
			$mas_strok[$i] = rtrim($mas_strok[$i], ".");
			//удаляем тире
			if ($mas_strok[$i] == "—") 
				unset($mas_strok[$i]);
		}
		
		return $mas_strok;
	}
	//подсчет общего количества слов
	public function countStr()
	{
		$mas_strok = $this->explodStr();

		$outstr = count($mas_strok);

		$list = array ("Всего слов:", (string)$outstr);

		return $list;
	}
	//подсчет повторения слов
	public function countwordsStrword()
	{
		$mas_strok = $this->explodStr();
		//возвращает массив, ключами которого являются значения массива исходный_массив, а значениями - частота повторения этих значений.
		$outmas = array_count_values($mas_strok);

		return $outmas;
	}

	public function inputCsv($namefile)
	{
		$countword = $this->countStr();

		$countwordsstr = $this->countwordsStrword();

		$fp = fopen((string)$namefile . '.csv', 'a');

		$countword = $this->toWindow($countword);

		$new_countwordsstr = array(array());

		$array_keys = array_keys($countwordsstr);
		$array_values = array_values($countwordsstr);

		$array_values = $this->toWindow($array_values);

		$array_keys = $this->toWindow($array_keys);

		for ($i = 0; $i < count($countwordsstr); $i++)
		{
			$new_countwordsstr[$i][0] = $array_keys[$i];
			$new_countwordsstr[$i][1] = $array_values[$i];
		}
		
		fputcsv($fp, $countword, ';');

		foreach ($new_countwordsstr as $fields) {
    		fputcsv($fp, $fields, ';');
		}

		fclose($fp);
	}

	/* кодируем данные массива в windows-1251 */
	private function toWindow($mas)
	{
		foreach($mas as $p => $titlesItem)
		{
		    $mas[$p] = iconv( "utf-8", "windows-1251", $titlesItem);
		}	
    	return $mas;
	}

}