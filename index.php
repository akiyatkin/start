<?php
namespace akiyatkin\start;
use infrajs\rest\Rest;
use infrajs\access\Access;
use infrajs\config\Config;
use akiyatkin\boo\Cache;


Access::debug(true);

Rest::get( function () {
	$data = array();
	$data['list'] = Start::getStartList();
	$html = Rest::parse('-start/layout.tpl', $data);
	echo $html;
},'start', function(){
	Cache::setStartTime(); //Тестировщик будет обновлять кэш на сайте
	echo 'Установлено новое начало времён<br>';
	echo Cache::getStartTime();
});