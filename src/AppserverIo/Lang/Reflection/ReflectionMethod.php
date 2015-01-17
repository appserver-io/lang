<?php

/**
 * AppserverIo\Lang\Reflection\ReflectionMethod
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
 * A wrapper instance for a reflection method.
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
class ReflectionMethod extends Object implements MethodInterface, \Serializable
{

    /**
     * Default filter for loading reflection methods from a reflection class.
     *
     * @var integer
     */
    const ALL_MODIFIERS= -1;

    /**
     * The class name to invoke the method on.
     *
     * @var string
     */
    protected $className = '';

    /**
     * The method name to invoke on the class.
     *
     * @var string
     */
    protected $methodName = '';

    /**
     * The method parameters.
     *
     * @var string
     */
    protected $parameters = null;

    /**
     * The method annotations.
     *
     * @var array
     */
    protected $annotations = null;

    /**
     * Array with annotations names we want to ignore when loaded.
     *
     * @var array
     */
    protected $annotationsToIgnore = array();

    /**
     * Array with annotation aliases used when create annotation instances.
     *
     * @var array
     */
    protected $annotationAliases = array();

    /**
     * Initializes the timeout method with the passed data.
     *
     * @param string $className           The class name to invoke the method on
     * @param string $methodName          The method name to invoke on the class
     * @param array  $annotationsToIgnore An array with annotations names we want to ignore when loaded
     * @param array  $annotationAliases   An array with annotation aliases used when create annotation instances
     */
    public function __construct($className, $methodName, array $annotationsToIgnore = array(), array $annotationAliases = array())
    {
        $this->className = $className;
        $this->methodName = $methodName;
        $this->annotationsToIgnore = $annotationsToIgnore;
        $this->annotationAliases = $annotationAliases;
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
     * Returns the class name to invoke the method on.
     *
     * @return string The class name
     * @see \AppserverIo\Lang\Reflection\MethodInterface::getClassName()
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * Returns the method name to invoke on the class.
     *
     * @return string The method name
     * @see \AppserverIo\Lang\Reflection\MethodInterface::getMethodName()
     */
    public function getMethodName()
    {
        return $this->methodName;
    }

    /**
     * Returns an array with annotation names we want to ignore when loaded.
     *
     * @return array The annotation names we want to ignore
     * @see \AppserverIo\Lang\Reflection\MethodInterface::getAnnotationsToIgnore()
     */
    public function getAnnotationsToIgnore()
    {
        return $this->annotationsToIgnore;
    }

    /**
     * Returns an array with annotation aliases used when create annotation instances.
     *
     * @return array The annotation aliases used when create annotation instances
     * @see \AppserverIo\Lang\Reflection\MethodInterface::getAnnotationAliases()
     */
    public function getAnnotationAliases()
    {
        return $this->annotationAliases;
    }

    /**
     * Registers the annotation alias for the passed class name.
     *
     * @param string $annotationName      The alias
     * @param string $annotationClassName The resolving class name
     *
     * @return void
     * @see \AppserverIo\Lang\Reflection\MethodInterface::addAnnotationAlias()
     */
    public function addAnnotationAlias($annotationName, $annotationClassName)
    {
        $this->annotationAliases[$annotationName] = $annotationClassName;
    }

    /**
     * Returns the method parameters.
     *
     * @return array The method parameters
     * @see \AppserverIo\Lang\Reflection\MethodInterface::getParameters()
     */
    public function getParameters()
    {

        // check if the parameters has been loaded
        if (isset($this->parameters) === false) {
            $this->parameters = ReflectionParameter::fromReflectionMethod($this);
        }

        // return the parameters
        return $this->parameters;
    }

    /**
     * Returns the method annotations.
     *
     * @return array The method annotations
     * @see \AppserverIo\Lang\Reflection\MethodInterface::getAnnotations()
     */
    public function getAnnotations()
    {

        // check if the annotations has been loaded
        if (isset($this->annotations) === false) {
            $this->annotations = ReflectionAnnotation::fromReflectionMethod($this);
        }

        // return the annotations
        return $this->annotations;
    }

    /**
     * Queries whether the reflection method has an annotation with the passed name or not.
     *
     * @param string $annotationName The annotation we want to query
     *
     * @return boolean TRUE if the reflection method has the annotation, else FALSE
     * @see \AppserverIo\Lang\Reflection\MethodInterface::hasAnnotation()
     */
    public function hasAnnotation($annotationName)
    {
        $annotations = $this->getAnnotations();
        return isset($annotations[$annotationName]);
    }

    /**
     * Returns the annotation instance with the passed name.
     *
     * @param string $annotationName The name of the requested annotation instance
     *
     * @return \AppserverIo\Lang\Reflection\AnnotationInterface|null The requested annotation instance
     * @throws \AppserverIo\Lang\Reflection\ReflectionException Is thrown if the requested annotation is not available
     * @see \AppserverIo\Lang\Reflection\MethodInterface::hasAnnotation()
     */
    public function getAnnotation($annotationName)
    {

        // first check if the method is available
        $annotations = $this->getAnnotations();
        if (isset($annotations[$annotationName])) { // if yes, return it
            return $annotations[$annotationName];
        }

        // if not, throw an exception
        throw new ReflectionException(sprintf('The requested reflection annotation %s is not available', $annotationName));
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
     * @param string $data The serialized method representation
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
     * Invokes a reflected method. You cann pass a random number of additional
     * parameters that'll be passed to the method as parameters.
     *
     * @param object $object The object to invoke the method on
     *
     * @return mixed Returns the method result
     * @see \AppserverIo\Lang\Reflection\ReflectionMethod::invokeArgs()
     * @link http://php.net/manual/en/reflectionmethod.invoke.php
     */
    public function invoke($object)
    {
        $args = func_get_args(); // load the arguments, drop the first one (because this is always the instance itself)
        return $this->invokeArgs($object, array_splice($args, 1, 1));
    }

    /**
     * Invokes the reflected method and pass its arguments as array.
     *
     * @param object $object The object to invoke the method on
     * @param array  $args   The parameters to be passed to the function, as an array
     *
     * @return mixed Returns the method result
     * @link http://php.net/manual/en/reflectionmethod.invokeargs.php
     */
    public function invokeArgs($object, array $args = array())
    {
        return $this->toPhpReflectionMethod()->invokeArgs($object, $args);
    }

    /**
     * Returns a PHP reflection method representation of this instance.
     *
     * @return \ReflectionMethod The PHP reflection method instance
     * @see \AppserverIo\Lang\Reflection\MethodInterface::toPhpReflectionMethod()
     */
    public function toPhpReflectionMethod()
    {
        return new \ReflectionMethod($this->getClassName(), $this->getMethodName());
    }

    /**
     * Returns an array of reflection method instances from the passed reflection class.
     *
     * @param \AppserverIo\Lang\Reflection\ReflectionClass $reflectionClass     The reflection class to return the methods for
     * @param interger                                     $filter              The filter used for loading the methods
     * @param array                                        $annotationsToIgnore An array with annotations names we want to ignore when loaded
     * @param array                                        $annotationAliases   An array with annotation aliases used when create annotation instances
     *
     * @return array An array with ReflectionMethod instances
     */
    public static function fromReflectionClass(ReflectionClass $reflectionClass, $filter = -1, array $annotationsToIgnore = array(), array $annotationAliases = array())
    {

        // initialize the array for the reflection methods
        $reflectionMethods = array();

        // load the reflection methods and initialize the array with the reflection methods
        $phpReflectionClass = $reflectionClass->toPhpReflectionClass();
        foreach ($phpReflectionClass->getMethods($filter) as $phpReflectionMethod) {
            $reflectionMethods[$phpReflectionMethod->getName()] = ReflectionMethod::fromPhpReflectionMethod($phpReflectionMethod, $annotationsToIgnore, $annotationAliases);
        }

        // return the array with the initialized reflection methods
        return $reflectionMethods;
    }

    /**
     * Creates a new reflection method instance from the passed PHP reflection method.
     *
     * @param \ReflectionMethod $reflectionMethod    The reflection method to load the data from
     * @param array             $annotationsToIgnore An array with annotations names we want to ignore when loaded
     * @param array             $annotationAliases   An array with annotation aliases used when create annotation instances
     *
     * @return \AppserverIo\Lang\Reflection\ReflectionMethod The instance
     */
    public static function fromPhpReflectionMethod(\ReflectionMethod $reflectionMethod, array $annotationsToIgnore = array(), array $annotationAliases = array())
    {

        // load class and method name from the reflection class
        $className = $reflectionMethod->getDeclaringClass()->getName();
        $methodName = $reflectionMethod->getName();

        // initialize and return the timeout method instance
        return new ReflectionMethod($className, $methodName, $annotationsToIgnore, $annotationAliases);
    }
}
