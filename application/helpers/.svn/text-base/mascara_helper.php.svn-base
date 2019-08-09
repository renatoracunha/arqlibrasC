<?php
	function mask($val, $mask)
	{
		//Exemplo de uso
		/*
		$cnpj = "11222333000199";
		$cpf = "00100200300";
		$cep = "08665110";
		$data = "10102010";

		echo mask($cnpj,'##.###.###/####-##');
		echo mask($cpf,'###.###.###-##');
		echo mask($cep,'#####-###');
		echo mask($data,'##/##/####');
		*/	
		 $maskared = '';
		 $k = 0;
		 for($i = 0; $i<=strlen($mask)-1; $i++)
		 {
			if($mask[$i] == '#')
			{
				if(isset($val[$k]))
					$maskared .= $val[$k++];
			}
			else
			{	
				if(isset($mask[$i]))
					$maskared .= $mask[$i];
			}
		 }
		 if(empty($val)){
			$maskared = '';
		 }
		 return $maskared;
	}
?>