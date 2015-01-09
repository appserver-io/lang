<?php

/**
 * AppserverIo\Lang\Reflection\ReflectionParameter
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @category   Library
 * @package    Lang
 * @subpackage Reflection
 * @author     Tim Wagner <tw@appserver.io>
 * @copyright  2014 TechDivision GmbH <info@appserver.io>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       https://github.com/appserver-io/lang
 * @link       http://www.appserver.io
 */

namespace AppserverIo\Lang\Reflection;

use AppserverIo\Lang\Object;

/**
 * A wrapper instance for a reflection parameter.
 *
 * @category   Library
 * @package    Lang
 * @subpackage Reflection
 * @author     Tim Wagner <tw@appserver.io>
 * @copyright  2014 TechDivision GmbH <info@appserver.io>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       https://github.com/appserver-io/lang
 * @link       http://www.appserver.io
 */
class ReflectionParameter extends Object implements ParameterInterface, \Serializable
{

    /**
     * The name of the class the parameter belongs to.
     *
     * @var string
     */
    protected $className = '';

    /**
     * The name of the method the parameter belongs to.
     *
     * @var string
     */
    protected $methodName = '';

    /**
     * The parameter name.
     *
     * @var string
     */
    protected $parameterName = '';

    /**
     * Initializes the reflection parameter with the passed data.
     *
     * @param string $className     The name of the class the parameter belongs to
     * @param string $methodName    The name of the method the parameter belongs to
     * @param string $parameterName The parameter name
     */
    public function __construct($className, $methodName, $parameterName)
    {
        $this->className = $className;
        $this->methodName = $methodName;
        $this->parameterName = $parameterName;
    }

    /**
     * This method returns the class name as
     * a string.
     *
     * @return string
     */
    public static function __getClass()
    {
        return __CLASS__;
    }

    /**
     * Returns name of the class the parameter belongs to.
     *
     * @return string The class name
     * @see \AppserverIo\Lang\Reflection\ParameterInterface::getClassName()
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * Returns name of the method the parameter belongs to.
     *
     * @return string The method name
     * @see \AppserverIo\Lang\Reflection\ParameterInterface::getMethodName()
     */
    public function getMethodName()
    {
        return $this->methodName;
    }

    /**
     * Returns the parameter position.
     *
     * @return string The parameter position
     * @see \AppserverIo\Lang\Reflection\ParameterInterface::getParameterName()
     */
    public function getParameterName()
    {
        return $this->parameterName;
    }

    /**
     * Returns the parameters position.
     *
     * @return string The parameters position
     * @see \AppserverIo\Lang\Reflection\ParameterInterface::getPosition()
     */
    public function getPosition()
    {
        return $this->toPhpReflectionParameter()->getPosition();
    }

    /**
     * Serializes the timeout method and returns a string representation.
     *
     * @return string The serialized string representation of the instance
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(get_object_vars($this));
    }

    /**
     * Restores the instance with the serialized data of the passed string.
     *
     * @param string $data The serialized property representation
     *
     * @return void
     * @see \Serializable::unserialize()
     */
    public function unserialize($data)
    {
        foreach (unserialize($data) as $propertyName => $propertyValue) {
            $this->$propertyName = $propertyValue;
        }
    }

    /**
     * Returns a PHP reflection parameter representation of this instance.
     *
     * @return \ReflectionProperty The PHP reflection parameter instance
     * @see \AppserverIo\Lang\Reflection\ParameterInterface::toPhpReflectionParameter()
     */
    public function toPhpReflectionParameter()
    {
        return new \ReflectionParameter(array($this->getClassName(), $this->getMethodName()), $this->getParameterName());
    }

    /**
     * Returns an array of reflection parameter instances from the passed reflection method.
     *
     * @param \AppserverIo\Lang\Reflection\ReflectionMethod $reflectionMethod The reflection method to return the parameters for
     *
     * @return array An array with ReflectionParameter instances
     */
    public static function fromReflectionMethod(ReflectionMethod $reflectionMethod)
    {

        // initialize the array for the reflection parameters
        $reflectionParameters = array();

        // load the reflection parameters and initialize the array with the reflection parameters
        $phpReflectionMethod = $reflectionMethod->toPhpReflectionClass();
        foreach ($phpReflectionMethod->getParameters() as $phpReflectionParameter) {
            $reflectionParameters[$phpReflectionParameter->getName()] = ReflectionParameter::fromPhpReflectionParameter($phpReflectionParameter);
        }

        // return the array with the initialized reflection parameters
        return $reflectionParameters;
    }

    /**
     * Creates a new reflection parameter instance from the passed PHP reflection parameter.
     *
     * @param \ReflectionParameter $reflectionParameter The reflection parameter to load the data from
     *
     * @return \AppserverIo\Lang\Reflection\ReflectionParameter The instance
     */
    public static function fromPhpReflectionParameter(\ReflectionParameter $reflectionParameter)
    {

        // load class, method and parameter name from the reflection parameter
        $className = $reflectionParameter->getDeclaringClass()->getName();
        $methodName = $reflectionParameter->getDeclaringFunction()->getName();
        $parameterName = $reflectionParameter->getName();

        // initialize and return the parameter instance
        return new ReflectionParameter($className, $methodName, $parameterName);
    }
}
