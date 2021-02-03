<?php defined('BASEPATH') || exit('No direct script access allowed');
class Container
{
    public $binds;

    public $instances;

    public function bind($abstract, $concrete)
    {
        if ($concrete instanceof Closure) {
            //匿名函数
            $this->binds[$abstract] = $concrete;
        } else {
            //类名
            $this->instances[$abstract] = $concrete;
        }
    }

    public function make($abstract, $parameters = [])
    {
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }
        array_unshift($parameters, $this);
        return call_user_func_array($this->binds[$abstract], $parameters);
    }
}