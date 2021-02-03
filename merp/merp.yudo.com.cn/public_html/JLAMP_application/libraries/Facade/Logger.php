<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @method static array info(string $query)
 * @method static array error(string $query)
 * @method static array debug(string $query)
 * @method static array main(string $query)
 */
class Logger extends Facade {

    protected static function getFacadeAccessor(){
        return 'Log';
    }
}