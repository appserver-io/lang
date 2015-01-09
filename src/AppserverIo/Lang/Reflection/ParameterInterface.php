<?php

/**
 * AppserverIo\Lang\Reflection\ParameterInterface
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
 * A reflection parameter interface.
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
interface ParameterInterface
{

    /**
     * Returns name of the class the parameter belongs to.
     *
     * @return string The class name
     */
    public function getClassName();

    /**
     * Returns name of the method the parameter belongs to.
     *
     * @return string The method name
     */
    public function getMethodName();

    /**
     * Returns the parameter name.
     *
     * @return string The parameter name
     */
    public function getParameterName();

    /**
     * Returns the parameters position.
     *
     * @return string The parameters position
     */
    public function getPosition();

    /**
     * Returns a PHP reflection parameter representation of this instance.
     *
     * @return \ReflectionParameter The PHP reflection parameter instance
     */
    public function toPhpReflectionParameter();
}
