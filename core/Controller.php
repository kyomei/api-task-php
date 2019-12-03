<?php
class Controller 
{
	protected function view($viewName, $viewData = array())
	{
		if (file_exists('views/'.$viewName.'.php')) {
			extract($viewData); // Pega a chave do array e transforma em variavel
			require 'views/'.$viewName.'.php';
		} else {
			require 'views/errors/error_404.php';
		}
	}

	protected function template($viewName, $viewData = array())
	{
		require 'views/template.php';
	}
}
