<?php
abstract class Facade{

    protected static $app;
    /**
     * The resolved object instances.
     *
     * @var array
     */
    protected static $resolvedInstance;

    /**
     * Get the root object behind the facade.
     *
     * @return mixed
     */
    protected static function getFacadeRoot(){
        static::resolveFacadeInstance();
        return static::$resolvedInstance[static::getFacadeAccessor()];
    }

    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor(){
        return 'multi facade';
    }

    protected static function resolveFacadeInstance(){
        $resolvedInstance = &static::$resolvedInstance[static::getFacadeAccessor()];
        if(isset($resolvedInstance)){
            return;
        }
        $resolvedInstance = static::$app[static::getFacadeAccessor()];
    }

    public static function setFacadeApplication($app)
    {
        static::$app = $app;
    }

    /**
     * @return mixed 容器
     */
    public static function getFacadeApplication()
    {
        return static::$app;
    }

    public static function __callStatic($method, $args)
    {
        $instance = static::getFacadeRoot();
        if (! $instance) {
            print_r('A facade root has not been set.');
        }

        return $instance->$method(...$args);
    }
}