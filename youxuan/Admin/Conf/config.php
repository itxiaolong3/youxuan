<?php
return array(
	//'配置项'=>'配置值'
);
function J($str){
	return str_replace('./', '', str_replace('//', '/', $str));
}