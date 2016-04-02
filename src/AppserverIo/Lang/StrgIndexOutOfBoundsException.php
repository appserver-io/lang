<?php

/**
 * \AppserverIo\Lang\StrgIndexOutOfBoundsException
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
 * Thrown to indicate that the application has attempted to convert
 * a string to one of the numeric types, but that the string does not
 * have the appropriate format.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/lang
 * @link      http://www.appserver.io
 */
class StrgIndexOutOfBoundsException extends \Exception
{

    /**
     * Constructs a new <code>StrgIndexOutOfBoundsException</code>
     * class with an argument indicating the illegal index.
     *
     * @param integer $index The illegal index
     *
     * @return void
     * @throws StrgIndexOutOfBoundsException
     */
    public static function forIndex($index)
    {
        throw new StrgIndexOutOfBoundsException('String index out of range: ' . $index);
    }
}
