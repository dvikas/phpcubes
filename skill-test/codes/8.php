<?php 
	$array = '0123456789ABCDEFG'; 
	$s =''; 
	for ($i = 1; $i < 50; $i++) { 
	$s .=$array[rand(0,strlen ($array) - 1)]; 
	} 
	echo$s; 
?>