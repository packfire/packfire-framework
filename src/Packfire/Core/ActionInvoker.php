<?php
namespace Packfire\Core;

use Packfire\Collection\Map;
use Packfire\Exception\MissingDependencyException;

if(!class_exists('ReflectionMethod')){
    throw new MissingDependencyException('pActionInvoker requires Reflection to be enabled in order to work');
}

/**
 * ActionInvoker class
 * 
 * Invokes a callback with an associative argument array
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) 2010-2012, Sam-Mauris Yong
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package Packfire\Core
 * @since 1.1-sofia
 */
class ActionInvoker {
    
    /**
     * The callback to be invoked
     * @var Closure|callback
     * @since 1.1-sofia
     */
    protected $callback;
    
    /**
     * Create a new pActionInvoker object
     * @param Closure|callback $callback The callback to be invoked
     * @since 1.1-sofia
     */
    public function __construct($callback){
        if(is_string($callback)){
            // detect if callback is 
            $pos = strpos($callback, '::');
            if($pos !== false){
                $callback = array(
                    substr($callback, 0, $pos),
                    substr($callback, $pos + 2)
                );
            }
        }
        $this->callback = $callback;
    }
    
    /**
     * Invoke the action with associative array of arguments
     * @param Map|array $args The arguments to be passed in.
     * @return mixed Returns whatever the callback returns
     * @since 1.1-sofia
     */
    public function invoke($params){
        if($params instanceof Map){
            $params = $params->toArray();
        }
        $invokeParams = array();
        if(is_array($this->callback)){
            $reflection = new ReflectionMethod($this->callback[0], $this->callback[1]);
            if($reflection->isStatic()){
                $invokeParams[] = null;
            }else{
                $invokeParams[] = $this->callback[0];
            }
        }else{
            $reflection = new ReflectionFunction($this->callback);
        }

        $pass = array();
        foreach($reflection->getParameters() as $param){
            /* @var $param ReflectionParameter */
            if(array_key_exists($param->getName(), $params)){
                $pass[] = $params[$param->getName()];
            }elseif($param->isOptional()){
                try{
                    $pass[] = $param->getDefaultValue();
                }catch(ReflectionException $ex){
                    
                }
            }
        }
        $invokeParams[] = $pass;

        return call_user_func_array(array($reflection, 'invokeArgs'), $invokeParams);
    }
    
}