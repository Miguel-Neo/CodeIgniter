<?php defined('BASEPATH') OR exit('No direct script access allowed'); 


if ( ! function_exists('alerts')){
	function alerts($_alerts){
		echo '<div id = "panel_message_alert">';
		foreach ($_alerts['_warning'] as $_msg){
		echo '<div class="alert alert-warning" role="alert">'. $_msg .'</div>';
		}
		foreach ($_alerts['_success']  as $_msg){
		echo '<div class="alert alert-success" role="alert">'. $_msg .'</div>';
		}
		foreach ($_alerts['_error'] as $_msg){
		echo '<div class="alert alert-danger" role="alert">'. $_msg .'</div>';
		}
		foreach ($_alerts['_info'] as $_msg){
		echo '<div class="alert alert-info" role="alert">'. $_msg .'</div>';
		}
		echo "</div>";
	}
}
