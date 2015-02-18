<?php

/**
 * AppserverIo\Lang\Reflection\ReflectionClass
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/lang
 * @link      http://www.appserver.io
 */

namespace AppserverIo\Lang\Reflection;

use AppserverIo\Lang\Object;

/**
 * A wrapper instance for a reflection class.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/lang
 * @link      http://www.appserver.io
 */
class ReflectionClass extends Object implements ClassInterface, \Serializable
{

    /**
     * The passed class name to invoke the method on.
     *
     * @var string
     */
    protected $passedName;

    /**
     * The class annotations.
     *
     * @var array|null
     */
    protected $annotations;

    /**
     * The class methods in an associative, three dimensional array with modifiers and method names as keys.
     *
     * @var array
     */
    protected $methods;

    /**
     * The class properties in an associative, three dimensional array with modifiers and property names as keys.
     *
     * @var array
     */
    protected $properties;

    /**
     * Array with annotations names we want to ignore when loaded.
     *
     * @var array
     */
    protected $annotationsToIgnore;

    /**
     * Array with annotation aliases used when create annotation instances.
     *
     * @var array
     */
    protected $annotationAliases;

    /**
     * Initializes the timed object with the passed data.
     *
     * @param string $name                The class name to invoke the method on
     * @param array  $annotationsToIgnore An array with annotations names we want to ignore when loaded
     * @param array  $annotationAliases   An array with annotation aliases used when create annotation instances
     */
    public function __construct($name, array $annotationsToIgnore = array(), array $annotationAliases = array())
    {
        // initialize property default values here, as declarative default values may break thread safety,
        // when utilizing static and non-static access on class methods within same thread context!
        $this->passedName = '';
        $this->annotations = null;
        $this->methods = array();
        $this->properties = array();
        $this->annotationsToIgnore = array();
        $this->annotationAliases = array();

        $this->passedName = $name;
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
     * Returns the class name passed to the constructor.
     *
     * @return string The class name passed to the constructor
     */
    protected function getPassedName()
    {
        return $this->passedName;
    }

    /**
     * Returns the class name.
     *
     * @return string The class name
     * @see \AppserverIo\Lang\Reflection\ClassInterface::getClassName()
     */
    public function getName()
    {
        return $this->toPhpReflectionClass()->getName();
    }

    /**
     * Returns the short class name (without namespace).
     *
     * @return string The short class name
     * @see \AppserverIo\Lang\Reflection\ClassInterface::getClassName()
     */
    public function getShortName()
    {
        return $this->toPhpReflectionClass()->getShortName();
    }

    /**
     * Returns an array with annotation names we want to ignore when loaded.
     *
     * @return array The annotation names we want to ignore
     * @see \AppserverIo\Lang\Reflection\ClassInterface::getAnnotationsToIgnore()
     */
    public function getAnnotationsToIgnore()
    {
        return $this->annotationsToIgnore;
    }

    /**
     * Returns an array with annotation aliases used when create annotation instances.
     *
     * @return array The annotation aliases used when create annotation instances
     * @see \AppserverIo\Lang\Reflection\ClassInterface::getAnnotationAliases()
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
     * @see \AppserverIo\Lang\Reflection\ClassInterface::addAnnotationAlias()
     */
    public function addAnnotationAlias($annotationName, $annotationClassName)
    {
        $this->annotationAliases[$annotationName] = $annotationClassName;
    }

    /**
     * Returns the class annotations.
     *
     * @return array The class annotations
     * @see \AppserverIo\Lang\Reflection\ClassInterface::getAnnotations()
     */
    public function getAnnotations()
    {

        // check if the annotations has been loaded
        if (isset($this->annotations) === false) {
            $this->annotations = ReflectionAnnotation::fromReflectionClass($this);
        }

        // return the annotations
        return $this->annotations;
    }

    /**
     * Queries whether the reflection class has an annotation with the passed name or not.
     *
     * @param string $annotationName The annotation we want to query
     *
     * @return boolean TRUE if the reflection class has the annotation, else FALSE
     * @see \AppserverIo\Lang\Reflection\ClassInterface::hasAnnotation()
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
     * @see \AppserverIo\Lang\Reflection\ClassInterface::getAnnotation()
     */
    public function getAnnotation($annotationName)
    {

        // first check if the method is available
        $annotations = $this->getAnnotations();
        if (isset($annotations[$annotationName])) {
            // if yes, return it
            return $annotations[$annotationName];
        }

        // if not, throw an exception
        throw new ReflectionException(sprintf('The requested reflection annotation %s is not available', $annotationName));
    }

    /**
     * Returns the class methods.
     *
     * @param integer $filter Filter the results to include only methods with certain attributes
     *
     * @return array The class methods
     * @see \AppserverIo\Lang\Reflection\ClassInterface::getMethods()
     * @link http://php.net/manual/en/reflectionclass.getmethods.php
     */
    public function getMethods($filter = ReflectionProperty::ALL_MODIFIERS)
    {

        // check if the methods for the requested filter has been loaded
        if (isset($this->methods[$filter]) === false) {
            $this->methods[$filter] = ReflectionMethod::fromReflectionClass($this, $filter, $this->getAnnotationsToIgnore(), $this->getAnnotationAliases());
        }

        // return the requested method
        return $this->methods[$filter];
    }

    /**
     * Queries whether the reflection class has an method with the passed name or not.
     *
     * @param string $name The method we want to query
     *
     * @return boolean TRUE if the reflection class has the method, else FALSE
     * @see \AppserverIo\Lang\Reflection\ClassInterface::hasMethod()
     */
    public function hasMethod($name)
    {
        $methods = $this->getMethods();
        return isset($methods[$name]);
    }

    /**
     * Returns the requested reflection method.
     *
     * @param string $name The name of the reflection method to return
     *
     * @return \AppserverIo\Lang\Reflection\ReflectionMethod The requested reflection method
     * @throws \AppserverIo\Lang\Reflection\ReflectionException Is thrown if the requested method is not available
     * @see \AppserverIo\Lang\Reflection\ClassInterface::getMethod()
     * @link http://php.net/manual/en/reflectionclass.getmethod.php
     */
    public function getMethod($name)
    {

        // first check if the method is available
        $methods = $this->getMethods();
        if (isset($methods[$name])) {
            // if yes, return it
            return $methods[$name];
        }

        // if not, throw an exception
        throw new ReflectionException(sprintf('The requested reflection method %s is not available', $name));
    }

    /**
     * Returns the class properties.
     *
     * @param integer $filter Filter the results to include only properties with certain attributes
     *
     * @return array The class properties
     * @see \AppserverIo\Lang\Reflection\ClassInterface::getProperties()
     * @link http://php.net/manual/en/reflectionclass.getproperties.php
     */
    public function getProperties($filter = ReflectionProperty::ALL_MODIFIERS)
    {

        // check if the properties for the requested filter has been loaded
        if (isset($this->properties[$filter]) === false) {
            $this->properties[$filter] = ReflectionProperty::fromReflectionClass($this, $filter, $this->getAnnotationsToIgnore(), $this->getAnnotationAliases());
        }

        // return the requested properties
        return $this->properties[$filter];
    }

    /**
     * Queries whether the reflection class has an property with the passed name or not.
     *
     * @param string $name The property we want to query
     *
     * @return boolean TRUE if the reflection class has the property, else FALSE
     * @see \AppserverIo\Lang\Reflection\ClassInterface::hasProperty()
     */
    public function hasProperty($name)
    {
        $properties = $this->getProperties();
        return isset($properties[$name]);
    }

    /**
     * Returns the requested reflection property.
     *
     * @param string $name The name of the reflection property to return
     *
     * @return \AppserverIo\Lang\Reflection\ReflectionProperty The requested reflection property
     * @throws \AppserverIo\Lang\Reflection\ReflectionException Is thrown if the requested property is not available
     * @see \AppserverIo\Lang\Reflection\ClassInterface::getProperty()
     * @link http://php.net/manual/en/reflectionclass.getproperty.php
     */
    public function getProperty($name)
    {

        // first check if the property is available
        $properties = $this->getProperties();
        if (isset($properties[$name])) {
            // if yes, return it
            return $properties[$name];
        }

        // if not, throw an exception
        throw new ReflectionException(sprintf('The requested reflection property %s is not available', $name));
    }

    /**
     * Returns a new annotation instance.
     *
     * You can pass a random number of arguments to this function. These
     * arguments will be passed to the constructor of the new instance.
     *
     * @return object A new annotation instance initialized with the passed arguments
     * @see \AppserverIo\Lang\Reflection\ClassInterface::newInstance()
     */
    public function newInstance()
    {
        return $this->newInstanceArgs(func_get_args());
    }

    /**
     * Returns a new annotation instance.
     *
     * @param array $args The arguments that will be passed to the instance constructor
     *
     * @return object A new annotation instance initialized with the passed arguments
     * @see \AppserverIo\Lang\Reflection\ClassInterface::newInstanceArgs()
     */
    public function newInstanceArgs(array $args = array())
    {
        // create a reflection instance of the found annotation name
        $reflectionClass = $this->toPhpReflectionClass();

        // create a new instance passing the found arguements to the constructor
        return $reflectionClass->newInstanceArgs($args);
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
     * Checks whether it implements the passed interface or not.
     *
     * @param string $interface The interface name
     *
     * @return boolean Returns TRUE on success or FALSE on failure
     * @see \AppserverIo\Lang\Reflection\ClassInterface::implementsInterface()
     */
    public function implementsInterface($interface)
    {
        return $this->toPhpReflectionClass()->implementsInterface($interface);
    }

    /**
     * Checks whether the class is an interface.
     *
     * @return boolean Returns TRUE on success or FALSE on failure
     * @see \AppserverIo\Lang\Reflection\ClassInterface::isInterface()
     */
    public function isInterface()
    {
        return $this->toPhpReflectionClass()->isInterface();
    }

    /**
     * Checks if the class is abstract.
     *
     * @return boolean Rturns TRUE on success or FALSE on failure
     * @see \AppserverIo\Lang\Reflection\ClassInterface::isAbstract()
     */
    public function isAbstract()
    {
        return $this->toPhpReflectionClass()->isInterface();
    }

    /**
     * Returns a PHP reflection class representation of this instance.
     *
     * @return \ReflectionClass The PHP reflection class instance
     * @see \AppserverIo\Lang\Reflection\ClassInterface::toPhpReflectionClass()
     */
    public function toPhpReflectionClass()
    {
        return new \ReflectionClass($this->getPassedName());
    }

    /**
     * Creates a new reflection class instance from the passed PHP reflection class.
     *
     * @param \ReflectionClass $reflectionClass     The PHP reflection class to load the data from
     * @param array            $annotationsToIgnore An array with annotations names we want to ignore when loaded
     * @param array            $annotationAliases   An array with annotation aliases used when create annotation instances
     *
     * @return \AppserverIo\Lang\Reflection\ReflectionClass The instance
     */
    public static function fromPhpReflectionClass(\ReflectionClass $reflectionClass, array $annotationsToIgnore = array(), array $annotationAliases = array())
    {
        return new ReflectionClass($reflectionClass->getName(), $annotationsToIgnore, $annotationAliases);
    }
}
