<?php
namespace akiyatkin\start;
use infrajs\path\Path;
use infrajs\config\Config;
use infrajs\template\Template;
use infrajs\each\Each;

class Start
{
    public static $conf = array();
    public static $adds = array();
    public static function add(&$startsteps, $name){
        $ext = Config::get($name);
        if (!isset($ext['startsteps'])) return;
        if (isset(Start::$adds[$name])) return;
        Start::$adds[$name] = true; 

        Each::exec($ext['dependencies'], function &($dep) use (&$startsteps) {
            Start::add($startsteps, $dep);
            $r = null;
            return $r;
        });

        $startsteps = array_merge($startsteps, $ext['startsteps']);
    }
    public static function getStartList() {
        $conf = Config::get();
        $startsteps = $conf['start']['startsteps'];
        foreach ($conf as $name => $ext) {
            Start::add($startsteps, $name);  
        }
        return $startsteps;
    }
}