<?php

/**
 * AppserverIo\Lang\Reflection\ReflectionObject
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
 * A wrapper instance for a reflection object.
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
class ReflectionObject extends ReflectionClass
{

    /**
     * Initializes the timed object with the passed data.
     *
     * @param object $object              The object to create the reflection object for
     * @param array  $annotationsToIgnore An array with annotations names we want to ignore when loaded
     * @param array  $annotationAliases   An array with annotation aliases used when create annotation instances
     */
    public function __construct($object, array $annotationsToIgnore = array(), array $annotationAliases = array())
    {
        parent::__construct(get_class($object), $annotationsToIgnore, $annotationAliases);
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
}
