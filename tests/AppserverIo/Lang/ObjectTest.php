<?php

/**
 * \AppserverIo\Lang\ObjectTest
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
 * This is the test for the Object class.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/lang
 * @link      http://www.appserver.io
 */
class ObjectTest extends \PHPUnit_Framework_TestCase
{

    /**
     * This test multiplies the Integer with an
     * integer value.
     *
     * @return void
     */
    public function testGetClass()
    {
        $this->assertEquals('AppserverIo\Lang\Objct', Objct::__getClass());
    }

    /**
     * This method checks, that the equal method
     * does return FALSE for not equal objects.
     *
     * @return void
     */
    public function testEqualFails()
    {
        $object1 = $this->getMockForAbstractClass('\AppserverIo\Lang\Objct');
        $object2 = $this->getMockForAbstractClass('\AppserverIo\Lang\Objct');
        $this->assertFalse($object1->equals($object2));
    }

    /**
     * This method checks that the equal method
     * equals itself.
     *
     * @return void
     */
    public function testEqualSuccess()
    {
        $object1 = $this->getMockForAbstractClass('\AppserverIo\Lang\Objct');
        $this->assertTrue($object1->equals($object1));
    }

    /**
     * This method tests the __toString() and the toString()
     * methods.
     *
     * @return void
     */
    public function testToString()
    {
        $object = $this->getMockForAbstractClass('\AppserverIo\Lang\Objct');
        $this->assertEquals(get_class($object) . '@' . sha1(serialize($object)), $object->__toString());
    }
}
