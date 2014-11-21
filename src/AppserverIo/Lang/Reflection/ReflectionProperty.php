<?php

/**
 * AppserverIo\Lang\Reflection\ReflectionProperty
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
 * A wrapper instance for a reflection property.
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
class ReflectionProperty extends Object implements PropertyInterface, \Serializable
{

    /**
     * The properties class name.
     *
     * @var string
     */
    protected $className = '';

    /**
     * The property name.
     *
     * @var string
     */
    protected $propertyName = '';

    /**
     * The method annotations.
     *
     * @var array|null
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
     * Initializes the reflection property with the passed data.
     *
     * @param string $className           The properties class name
     * @param string $propertyName        The property name
     * @param array  $annotationsToIgnore An array with annotations names we want to ignore when loaded
     * @param array  $annotationAliases   An array with annotation aliases used when create annotation instances
     */
    public function __construct($className, $propertyName, array $annotationsToIgnore = array(), array $annotationAliases = array())
    {
        $this->className = $className;
        $this->propertyName = $propertyName;
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
     * Returns the properties class name.
     *
     * @return string The class name
     * @see \AppserverIo\Lang\Reflection\PropertyInterface::getClassName()
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * Returns the property name.
     *
     * @return string The property name
     * @see \AppserverIo\Lang\Reflection\PropertyInterface::getPropertyName()
     */
    public function getPropertyName()
    {
        return $this->propertyName;
    }

    /**
     * Returns an array with annotation names we want to ignore when loaded.
     *
     * @return array The annotation names we want to ignore
     * @see \AppserverIo\Lang\Reflection\PropertyInterface::getAnnotationsToIgnore()
     */
    public function getAnnotationsToIgnore()
    {
        return $this->annotationsToIgnore;
    }

    /**
     * Returns an array with annotation aliases used when create annotation instances.
     *
     * @return array The annotation aliases used when create annotation instances
     * @see \AppserverIo\Lang\Reflection\PropertyInterface::getAnnotationAliases()
     */
    public function getAnnotationAliases()
    {
        return $this->annotationAliases;
    }

    /**
     * Returns the method annotations.
     *
     * @return array The method annotations
     * @see \AppserverIo\Lang\Reflection\PropertyInterface::getAnnotations()
     */
    public function getAnnotations()
    {
        return ReflectionAnnotation::fromReflectionProperty($this);
    }

    /**
     * Queries whether the reflection method has an annotation with the passed name or not.
     *
     * @param string $annotationName The annotation we want to query
     *
     * @return boolean TRUE if the reflection method has the annotation, else FALSE
     * @see \AppserverIo\Lang\Reflection\PropertyInterface::hasAnnotation()
     */
    public function hasAnnotation($annotationName)
    {
        return array_key_exists($annotationName, $this->getAnnotations());
    }

    /**
     * Returns the annotation instance with the passed name.
     *
     * @param string $annotationName The name of the requested annotation instance
     *
     * @return \AppserverIo\Lang\Reflection\AnnotationInterface|null The requested annotation instance
     * @throws \AppserverIo\Lang\Reflection\ReflectionException Is thrown if the requested annotation is not available
     * @see \AppserverIo\Lang\Reflection\PropertyInterface::hasAnnotation()
     */
    public function getAnnotation($annotationName)
    {

        // first check if the method is available
        if (array_key_exists($annotationName, $annotations = $this->getAnnotations())) { // if yes, return it
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
     * Returns a PHP reflection property representation of this instance.
     *
     * @return \ReflectionProperty The PHP reflection property instance
     * @see \AppserverIo\Lang\Reflection\PropertyInterface::toPhpReflectionProperty()
     */
    public function toPhpReflectionProperty()
    {
        return new \ReflectionProperty($this->getClassName(), $this->getPropertyName());
    }

    /**
     * Returns an array of reflection property instances from the passed reflection class.
     *
     * @param \AppserverIo\Lang\Reflection\ReflectionClass $reflectionClass     The reflection class to return the properties for
     * @param interger                                     $filter              The filter used for loading the properties
     * @param array                                        $annotationsToIgnore An array with annotations names we want to ignore when loaded
     * @param array                                        $annotationAliases   An array with annotation aliases used when create annotation instances
     *
     * @return array An array with ReflectionProperty instances
     */
    public static function fromReflectionClass(ReflectionClass $reflectionClass, $filter = 0, array $annotationsToIgnore = array(), array $annotationAliases = array())
    {

        // initialize the array for the reflection properties
        $reflectionProperties = array();

        // load the reflection properties and initialize the array with the reflection properties
        $phpReflectionClass = $reflectionClass->toPhpReflectionClass();
        foreach ($phpReflectionClass->getProperties($filter) as $phpReflectionProperty) {
            $reflectionProperties[$phpReflectionProperty->getName()] = ReflectionProperty::fromPhpReflectionProperty($phpReflectionProperty, $annotationsToIgnore, $annotationAliases);
        }

        // return the array with the initialized reflection properties
        return $reflectionProperties;
    }

    /**
     * Creates a new reflection property instance from the passed PHP reflection property.
     *
     * @param \ReflectionProperty $reflectionProperty  The reflection property to load the data from
     * @param array               $annotationsToIgnore An array with annotations names we want to ignore when loaded
     * @param array               $annotationAliases   An array with annotation aliases used when create annotation instances
     *
     * @return \AppserverIo\Lang\Reflection\ReflectionProperty The instance
     */
    public static function fromPhpReflectionProperty(\ReflectionProperty $reflectionProperty, array $annotationsToIgnore = array(), array $annotationAliases = array())
    {

        // load class and method name from the reflection class
        $className = $reflectionProperty->getDeclaringClass()->getName();
        $propertyName = $reflectionProperty->getName();

        // initialize and return the timeout method instance
        return new ReflectionProperty($className, $propertyName, $annotationsToIgnore, $annotationAliases);
    }
}
