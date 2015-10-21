<?php
include 'simple_html_dom.php';

    $html = file_get_html("./buscity.html");

    $main = $html->find('div[id=con_one_1]',0);

    foreach($main->find('a') as $element)
       echo $element->id . ','; 

