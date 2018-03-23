<?php
namespace akiyatkin\start;
use infrajs\rest\Rest;
use infrajs\access\Access;
use akiyatkin\boo\Cache;
use infrajs\update\Update;
use infrajs\nostore\Nostore;

Access::test(true);
Nostore::on();

Rest::get( function () {
	$data = array();
	$data['list'] = Start::getStartList();
	$html = Rest::parse('-start/layout.tpl', $data);
	echo $html;
},'start', function(){
	Update::exec();
	Cache::setStartTime(); //Тестировщик будет обновлять кэш на сайте
	echo 'Обновление выполнено и установлено новое начало времён &mdash; кэш для тестировщика устарел.<br>';
	echo Cache::getStartTime();
});
