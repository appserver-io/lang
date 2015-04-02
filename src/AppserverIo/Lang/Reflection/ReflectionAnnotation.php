<?php

/**
 * AppserverIo\Lang\Reflection\ReflectionAnnotation
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
use Herrera\Annotations\Tokens;
use Herrera\Annotations\Tokenizer;
use Herrera\Annotations\Convert\ToArray;

/**
 * A generic and serializable annotation implementation.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/lang
 * @link      http://www.appserver.io
 */
class ReflectionAnnotation extends Object implements AnnotationInterface, \Serializable
{

    /**
     * The annotation name.
     *
     * @var string
     */
    protected $annotationName;

    /**
     * The array with the annotation values.
     *
     * @var array
     */
    protected $values;

    /**
     * The constructor the initializes the instance with the
     * data passed with the token.
     *
     * @param string $annotationName The annotation name
     * @param array  $values         The annotation values
     */
    public function __construct($annotationName, array $values = array())
    {
        // initialize property default values here, as declarative default values may break thread safety,
        // when utilizing static and non-static access on class methods within same thread context!
        $this->annotationName = '';
        $this->values = array();

        // set the annotation name
        $this->annotationName = $annotationName;

        // ATTENTION: We need to copy the values, because if not, it would not be
        //            possible to pre-initialize them in an annotation implements
        //            constructor!
        foreach ($values as $key => $value) {
            $this->values[$key] = $value;
        }
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
     * Returns the annation name.
     *
     * @return string The annotation name
     */
    public function getAnnotationName()
    {
        return $this->annotationName;
    }

    /**
     * Returns the annotation values.
     *
     * @return array The annotation values
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * Queries whether this annotation instance has a value with the passed key or not.
     *
     * @param string $key The key we want to query
     *
     * @return boolean TRUE if the value is available, else FALSE
     */
    public function hasValue($key)
    {
        return isset($this->values[$key]);
    }

    /**
     * Returns the value for the passed key, if available.
     *
     * @param string|null $key The key of the value to return
     *
     * @return mixed|null The requested value
     */
    public function getValue($key)
    {
        if ($this->hasValue($key)) {
            return $this->values[$key];
        }
    }

    /**
     * Sets the value with the passed key, existing values
     * are overwritten.
     *
     * @param string $key   The key of the value
     * @param string $value The value to set
     *
     * @return void
     */
    public function setValue($key, $value)
    {
        $this->values[$key] = $value;
    }

    /**
     * String representation of object.
     *
     * @return string the string representation of the object or null
     * @link http://php.net/manual/en/serializable.serialize.php
     */
    public function serialize()
    {
        return serialize(get_object_vars($this));
    }

    /**
     * Constructs the object
     *
     * @param string $data The string representation of the object
     *
     * @return void
     * @link http://php.net/manual/en/serializable.unserialize.php
     */
    public function unserialize($data)
    {
        foreach (unserialize($data) as $propertyName => $propertyValue) {
            $this->$propertyName = $propertyValue;
        }
    }

    /**
     * Returns a PHP reflection class representation of this instance.
     *
     * @return \ReflectionClass The PHP reflection class instance
     * @see \AppserverIo\Lang\Reflection\ClassInterface::toPhpReflectionClass()
     */
    public function toPhpReflectionClass()
    {
        return new \ReflectionClass($this->getAnnotationName());
    }

    /**
     * Returns a new annotation instance.
     *
     * You can pass a random number of arguments to this function. These
     * arguments will be passed to the constructor of the new instance.
     *
     * @return object A new annotation instance initialized with the passed arguments
     * @link http://de2.php.net/func_get_args
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
     */
    public function newInstanceArgs(array $args = array())
    {
        // create a reflection instance of the found annotation name
        $reflectionClass = $this->toPhpReflectionClass();

        // create a new instance passing the found arguements to the constructor
        return $reflectionClass->newInstanceArgs($args);
    }

    /**
     * Initializes and returns an array with annotation instances from the
     * passed doc comment.
     *
     * @param string $docComment The doc comment to initialize the annotations from
     * @param array  $ignore     Array with annotations we want to ignore
     * @param array  $aliases    Array with aliases to create annotation instances with
     *
     * @return array The array with the ReflectionAnnotation instances loaded from the passed doc comment
     */
    public static function fromDocComment($docComment, array $ignore = array(), array $aliases = array())
    {

        // initialize the array for the annotations
        $annotations = array();

        // initialize the annotation tokenizer
        $tokenizer = new Tokenizer();
        $tokenizer->ignore($ignore);

        // parse the doc block
        $parsed = $tokenizer->parse($docComment, $aliases);

        // convert tokens and return one
        $tokens = new Tokens($parsed);
        $toArray = new ToArray();

        // register annotations with the real annotation name (not the alias)
        foreach ($toArray->convert($tokens) as $token) {
            // check if we've an annotation that matched an alias
            if (array_key_exists($token->name, $flipped = array_flip($aliases))) {
                $annotationName = $flipped[$token->name];
            } else {
                $annotationName = $token->name;
            }

            // register the annotation with the real annotation name (not the alias)
            $annotations[$annotationName] = ReflectionAnnotation::fromStdClass($token, $aliases);
        }

        // return the list with the annotation instances
        return $annotations;
    }

    /**
     * Initializes and returns a ReflectionAnnotation instance from the passed token.
     *
     * @param \stdClass $token   The token to initialize and return the ReflectionAnnotation instance from
     * @param array     $aliases The class aliases to use
     *
     * @return \AppserverIo\Lang\Reflection\ReflectionAnnotation The initialized ReflectionAnnotation instance
     */
    private static function fromStdClass(\stdClass $token, array $aliases = array())
    {

        // iterate over the tokens values to process them recursively
        foreach ($token->values as $name => $value) {
            // query whether we've an array
            if (is_array($value)) {
                // iterate over all values of the array an process them recursively
                foreach ($value as $key => $val) {
                    // query whether we've a nested annotation
                    if (is_object($val)) {
                        $token->values[$name][$key] = ReflectionAnnotation::fromStdClass($val, $aliases);
                    }
                }
            }

            // query whether we've a nested annotation
            if (is_object($value)) {
                $token->values[$name] = ReflectionAnnotation::fromStdClass($value, $aliases);
            }
        }

        // initialize and return the reflection annotation
        return new ReflectionAnnotation($token->name, $token->values);
    }

    /**
     * Initializes and returns an array with annotation instances from the doc comment
     * found in the passed reflection property instance.
     *
     * @param \AppserverIo\Lang\Reflection\PropertyInterface $reflectionProperty The reflection property to load the doc comment from
     *
     * @return array The array with the ReflectionAnnotation instances loaded from the passed reflection property
     * @see \AppserverIo\Lang\Reflection\ReflectionAnnotation::fromDocComment()
     */
    public static function fromReflectionProperty(PropertyInterface $reflectionProperty)
    {

        // load the reflection method data we need to initialize the annotations
        $aliases = $reflectionProperty->getAnnotationAliases();
        $ignore = $reflectionProperty->getAnnotationsToIgnore();
        $docComment = $reflectionProperty->toPhpReflectionProperty()->getDocComment();

        // load and return the annotations found in the doc comment
        return ReflectionAnnotation::fromDocComment($docComment, $ignore, $aliases);
    }

    /**
     * Initializes and returns an array with annotation instances from the doc comment
     * found in the passed reflection method instance.
     *
     * @param \AppserverIo\Lang\Reflection\MethodInterface $reflectionMethod The reflection method to load the doc comment from
     *
     * @return array The array with the ReflectionAnnotation instances loaded from the passed reflection method
     * @see \AppserverIo\Lang\Reflection\ReflectionAnnotation::fromDocComment()
     */
    public static function fromReflectionMethod(MethodInterface $reflectionMethod)
    {

        // load the reflection method data we need to initialize the annotations
        $aliases = $reflectionMethod->getAnnotationAliases();
        $ignore = $reflectionMethod->getAnnotationsToIgnore();
        $docComment = $reflectionMethod->toPhpReflectionMethod()->getDocComment();

        // load and return the annotations found in the doc comment
        return ReflectionAnnotation::fromDocComment($docComment, $ignore, $aliases);
    }

    /**
     * Initializes and returns an array with annotation instances from the doc comment
     * found in the passed reflection class instance.
     *
     * @param \AppserverIo\Lang\Reflection\ClassInterface $reflectionClass The reflection class to load the doc comment from
     *
     * @return array The array with the ReflectionAnnotation instances loaded from the passed reflection class
     * @see \AppserverIo\Lang\Reflection\ReflectionAnnotation::fromDocComment()
     */
    public static function fromReflectionClass(ClassInterface $reflectionClass)
    {

        // load the reflection method data we need to initialize the annotations
        $aliases = $reflectionClass->getAnnotationAliases();
        $ignore = $reflectionClass->getAnnotationsToIgnore();
        $docComment = $reflectionClass->toPhpReflectionClass()->getDocComment();

        // load and return the annotations found in the doc comment
        return ReflectionAnnotation::fromDocComment($docComment, $ignore, $aliases);
    }
}
