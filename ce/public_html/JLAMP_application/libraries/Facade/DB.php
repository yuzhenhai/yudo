<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @method static array queryRow(string $query, array $bindings = [])
 * @method static array queryRows(string $query, array $bindings = [])
 * @method static array connect(string $dbName)
 * @method static array toSql(string $query, array $bindings = [])
 * @method static array call(string $DB,string $spName,array $input,array $output)
 */
class DB extends Facade {

    protected static function getFacadeAccessor(){
        return 'DB';
    }
}