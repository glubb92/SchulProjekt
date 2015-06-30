<?php

include"insert_tables.php";


$add = new addDB();
echo $add->openDB();
echo $add->add_supplier("amen", "Strasse", "PLZ", "Ansprechpartner", "ww.URL.de");
?>