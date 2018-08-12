<?php

/**
 * AppserverIo\Lang\Reflection\MockAnnotation
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

use AppserverIo\Lang\Objct;

/**
 * A mock annotation implementation.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/lang
 * @link      http://www.appserver.io
 */
class MockAnnotation extends Objct
{

    /**
     * Initializes the mock instance with dummy args.
     *
     * @param array $values The args to pass to the instance
     */
    public function __construct(array $values = array())
    {
        $this->values = $values;
    }

    /**
     * Returns the requested value if available.
     *
     * @param string $key The key of the value to return
     *
     * @return mixed The requested value
     */
    public function getValue($key)
    {
        if (isset($this->values[$key])) {
            return $this->values[$key];
        }
    }
}
