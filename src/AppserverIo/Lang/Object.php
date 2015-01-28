<?php

/**
 * \AppserverIo\Lang\Object
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

namespace AppserverIo\Lang;

/**
 * This class is the abstract class of all other classes.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/lang
 * @link      http://www.appserver.io
 */
abstract class Object
{

    /**
     * This method returns the class as
     * a string representation.
     *
     * @return string The objects string representation
     */
    public function __toString()
    {
        return get_class($this) . "@" . sha1(serialize($this));
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
     * This method checks if the passed object is equal
     * to itself.
     *
     * @param \AppserverIo\Lang\Object $obj The object to check
     *
     * @return boolean Returns TRUE if the passed object is equal
     */
    public function equals(Object $obj)
    {
        if ($obj === $this) {
            return true;
        }
        return false;
    }
}
