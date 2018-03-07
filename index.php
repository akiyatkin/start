<?php
namespace akiyatkin\start;
use infrajs\rest\Rest;

Rest::get( function () {
	$html = Rest::parse('-start/layout.tpl',Start::$conf);
	echo $html;
});