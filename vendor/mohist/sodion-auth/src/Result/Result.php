<?php


namespace Mohist\SodionAuth\Result;


abstract class Result
{
    public $data=[];
    public function __construct($parms=[])
    {
        foreach ($parms as $key=>$value){
            $this->$key=$value;
        }
    }
    public function __get($name)
    {
        return $this->data[$name];
    }
    public function __set($name, $value)
    {
        $this->data[$name]=$value;
    }
}
