<?php
class Core 
{

	public function run()
	{

		$url = isset($_GET['url']) ? '/'.$_GET['url'] : '/';
		//echo "URL: ".$url;

		$params = array();

		if (!empty($url) && $url != '/') {

			$url = explode('/', $url); // Array ( [0] => [1] => galeria [2] => abrir [3] => 123 )
			array_shift($url); // Array ( [0] => galeria [1] => abrir [2] => 123 )
			
			$currentController = ucfirst($url[0]).'Controller'; // ucfirst deixa primeira letra maiuscula
			array_shift($url); // Array ( [0] => abrir [1] => 123 ) CONTROLLER: galeriaController

			// Verifica se usuário passou segundo parametro na url
			if (!empty($url[0])) {
				$currentAction = $url[0];
				array_shift($url); // Remove o action da url também  Array ( [0] => 123 )
			} else {
				$currentAction = 'index';
			}

			// Verifica se existe parametros na url
			if (count($url)) {
				$params = $url;
			}

		} else {
			$currentController = 'HomeController';
			$currentAction = 'index';
		}


		$c = new $currentController();

		// Execute uma função de uma classe sem saber o nome da classe e da função e passa os parametros
		call_user_func_array(array($c, $currentAction), $params);

		// echo "CONTROLLER: ".$currentController."<br />";
		// echo "ACTION: ".$currentAction."<br />";
		// echo "PARAMS: ".print_r($params, true);"<br />";
	}
}
