<?php

/**
 * AppserverIo\Lang\Reflection\AnnotationInterface
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

/**
 * A reflection annotation interface.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/lang
 * @link      http://www.appserver.io
 */
interface AnnotationInterface
{

    /**
     * Returns the annotation name.
     *
     * @return string The annotation name
     */
    public function getAnnotationName();

    /**
     * Returns the annotation values.
     *
     * @return array The annotation values
     */
    public function getValues();

    /**
     * Queries whether this annotation instance has a value with the passed key or not.
     *
     * @param string $key The key we want to query
     *
     * @return boolean TRUE if the value is available, else FALSE
     */
    public function hasValue($key);

    /**
     * Returns the value for the passed key, if available.
     *
     * @param string $key The key of the value to return
     *
     * @return mixed|null The requested value
     */
    public function getValue($key);

    /**
     * Sets the value with the passed key, existing values
     * are overwritten.
     *
     * @param string $key   The key of the value
     * @param string $value The value to set
     *
     * @return void
     */
    public function setValue($key, $value);

    /**
     * Returns a PHP reflection class representation of this instance.
     *
     * @return \ReflectionClass The PHP reflection class instance
     * @see \AppserverIo\Lang\Reflection\ClassInterface::toPhpReflectionClass()
     */
    public function toPhpReflectionClass();
}
