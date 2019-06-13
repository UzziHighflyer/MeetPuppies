<?php  
	$dir =  dirname(__FILE__);
    $dir = explode('/', $dir);

    $parent = $dir[count($dir)-1];

	function autoload($klasa){
		// if($parent == 'function'){
		// 	require_once("../Classes/{$klasa}.php");
		// }else{
		// 	require_once("Classes/{$klasa}.php")
		// }
		require_once("{$klasa}.php");
	}
	spl_autoload_register("autoload");

