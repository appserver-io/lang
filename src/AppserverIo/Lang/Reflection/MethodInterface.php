<?php

/**
 * AppserverIo\Lang\Reflection\MethodInterface
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

/**
 * A reflection method interface.
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
interface MethodInterface
{

    /**
     * Returns the class name to invoke the method on.
     *
     * @return string The class name
     */
    public function getClassName();

    /**
     * Returns the method name to invoke on the class.
     *
     * @return string The method name
     */
    public function getMethodName();

    /**
     * Returns the method parameters.
     *
     * @return array The method parameters
     */
    public function getParameters();

    /**
     * Returns an array with annotation names we want to ignore when loaded.
     *
     * @return array The annotation names we want to ignore
     */
    public function getAnnotationsToIgnore();

    /**
     * Returns an array with annotation aliases used when create annotation instances.
     *
     * @return array The annotation aliases used when create annotation instances
     */
    public function getAnnotationAliases();

    /**
     * Returns the method annotations.
     *
     * @return array The method annotations
     */
    public function getAnnotations();

    /**
     * Queries whether the reflection method has an annotation with the passed name or not.
     *
     * @param string $annotationName The annotation we want to query
     *
     * @return boolean TRUE if the reflection method has the annotation, else FALSE
     */
    public function hasAnnotation($annotationName);

    /**
     * Returns the annotation instance with the passed name.
     *
     * @param string $annotationName The name of the requested annotation instance
     *
     * @return \AppserverIo\Lang\Reflection\AnnotationInterface|null The requested annotation instance
     */
    public function getAnnotation($annotationName);

    /**
     * Returns a PHP reflection method representation of this instance.
     *
     * @return \ReflectionMethod The PHP reflection method instance
     */
    public function toPhpReflectionMethod();
}
