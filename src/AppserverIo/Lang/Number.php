<?php

/**
 * \AppserverIo\Lang\Number
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @category  Library
 * @package   Lang
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2014 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/lang
 * @link      http://www.appserver.io
 */

namespace AppserverIo\Lang;

/**
 * This class is the abstract class of all numbers.
 *
 * @category  Library
 * @package   Lang
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2014 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/lang
 * @link      http://www.appserver.io
 */
abstract class Number extends Object
{

    /**
     * Returns the value of the specified number as an <code>int</code>.
     * This may involve rounding or truncation.
     *
     * @return integer The numeric value represented by this object after conversion to type <code>int</code>
     */
    abstract public function intValue();

    /**
     * Returns the value of the specified number as a <code>float</code>.
     * This may involve rounding.
     *
     * @return float The numeric value represented by this object after conversion to type <code>float</code>
     */
    abstract public function floatValue();

    /**
     * Returns the value of the specified number as a <code>double</code>.
     * This may involve rounding.
     *
     * @return double The numeric value represented by this object after conversion to type <code>double</code>
     */
     abstract public function doubleValue();
}
