<?php
include 'simple_html_dom.php';

$citys = file("./citys.txt");

foreach ($citys as $city) {

	echo "数据抓取：".$city."中";

	$result = array();
	$city = rtrim($city);

	$myfile = fopen($city.".plist", "w+") or die("Unable to open file!");
	$plistTou = @'<?xml version="1.0" encoding="UTF-8"?>
				<!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
				<plist version="1.0">
				<array>';
	fwrite($myfile, $plistTou);

	for ($i = 1; $i<42; $i++){
		$html = file_get_html("http://".$city.".8684.cn/"."line".$i);

		if (!$html) {
			continue;
		}

		$main = $html->find('div[id=con_site_1]',0);

		foreach($main->find('a') as $element){
	 	   echo $element->plaintext . '<br>'; 
   			array_push($result, '<string>'.$element->plaintext.'</string>');
		}
	}

	 foreach ($result as $url) {
           	fwrite($myfile, $url);
     }
	$plistTou = @'</array>
					</plist>';
	fwrite($myfile, $plistTou);
	
	fclose($myfile);
	
}

