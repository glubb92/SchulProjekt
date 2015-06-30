<?php

include"insert_tables.php";


$add = new addDB();
//echo $add->openDB();
// if ($add->add_Kompart("Laptop")){
	// echo "Laptop angelegt";
// }else{
// echo "Fehler";

if ($add->add_Kompattribut("Festplatte", "Gigabyte")){
	echo "Attribut angelegt";
}else{
echo "Fehler";
}
?>