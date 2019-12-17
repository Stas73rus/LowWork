<?php

Class WorkStr
{
	private $strok;

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
		for ($i = 0; $i <= count($mas_strok) + 1; $i++)
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

		return "Всего слов: " . $outstr;
	}
	//подсчет повторения слов
	public function countwordsStrword()
	{
		$mas_strok = $this->explodStr();
		//возвращает массив, ключами которого являются значения массива исходный_массив, а значениями - частота повторения этих значений.
		$outmas = array_count_values($mas_strok);

		$outstr = "";
			
		foreach ($outmas as $key => $value) {
			$outstr .= $key . ": " . $value . "<br>";
		}

		return $outstr;
	}

}