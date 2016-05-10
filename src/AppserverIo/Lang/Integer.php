<?php

/**
 * \AppserverIo\Lang\Integer
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
 * This class implements functionality to handle
 * a integer value as object.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/lang
 * @link      http://www.appserver.io
 */
class Integer extends Number implements \Serializable
{

    /**
     * The value of the Integer.
     *
     * @var integer
     */
    protected $value;

    /**
     * Constructs a newly allocated <code>Integer</code> object that
     * represents the primitive <code>integer</code> argument.
     *
     * @param integer $value The value to be represented by the <code>Integer</code>.
     *
     * @throws \AppserverIo\Lang\NumberFormatException Is thrown if the passed value is not an integer
     */
    public function __construct($value)
    {
        // initialize property default values here, as declarative default values may break thread safety,
        // when utilizing static and non-static access on class methods within same thread context!
        $this->value = null;

        if (!is_int($value)) {
            NumberFormatException::forInputString($value);
        }
        $this->value = $value;
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
     * Returns a <code>Integer</code> object holding the
     * <code>float</code> value represented by the argument string
     * <code>s</code>.
     * <p>
     * If <code>s</code> is <code>null</code>, then a
     * <code>NullPointerException</code> is thrown.
     * <p>
     * Leading and trailing whitespace characters in <code>s</code>
     * are ignored. The rest of <code>s</code> should constitute a
     * <i>Integer</i> as described by the lexical syntax rules:
     * <blockquote><i>
     * <dl>
     * <dt>Integer:
     * <dd><i>Sign<sub>opt</sub></i> <code>NaN</code>
     * <dd><i>Sign<sub>opt</sub></i> <code>Infinity</code>
     * <dd>Sign<sub>opt</sub> FloatingPointLiteral
     * </dl>
     * </i></blockquote>
     * where <i>Sign</i> and <i>FloatingPointLiteral</i> are as
     * defined in <a href="http://java.sun.com/docs/books/jls/second_edition/
     * html/lexical.doc.html#230798">&sect;3.10.2</a>
     * of the <a href="http://java.sun.com/docs/books/jls/html/">Java
     * Language Specification</a>. If <code>s</code> does not have the
     * form of a <i>Integer</i>, then a
     * <code>NumberFormatException</code> is thrown. Otherwise,
     * <code>s</code> is regarded as representing an exact decimal
     * value in the usual "computerized scientific notation"; this
     * exact decimal value is then conceptually converted to an
     * "infinitely precise" binary value that is then rounded to type
     * <code>float</code> by the usual round-to-nearest rule of IEEE
     * 754 floating-point arithmetic, which includes preserving the
     * sign of a zero value. Finally, a <code>Float</code> object
     * representing this <code>float</code> value is returned.
     * <p>
     * To interpret localized string representations of a
     * floating-point value, use subclasses of {@link
     * java.text.NumberFormat}.
     *
     * <p>Note that trailing format specifiers, specifiers that
     * determine the type of a floating-point literal
     * (<code>1.0f</code> is a <code>float</code> value;
     * <code>1.0d</code> is a <code>double</code> value), do
     * <em>not</em> influence the results of this method. In other
     * words, the numerical value of the input string is converted
     * directly to the target floating-point type. In general, the
     * two-step sequence of conversions, string to <code>double</code>
     * followed by <code>double</code> to <code>float</code>, is
     * <em>not</em> equivalent to converting a string directly to
     * <code>float</code>. For example, if first converted to an
     * intermediate <code>double</code> and then to
     * <code>float</code>, the string<br>
     * <code>"1.00000017881393421514957253748434595763683319091796875001d"
     * </code><br> results in the <code>float</code> value
     * <code>1.0000002f</code>; if the string is converted directly to
     * <code>float</code>, <code>1.000000<b>1</b>f</code> results.
     *
     * @param \AppserverIo\Lang\Strng $string The string to be parsed
     *
     * @return \AppserverIo\Lang\Integer A <code>Integer</code> object holding the value represented by the <code>Strng</code> argument
     * @exception \AppserverIo\Lang\NumberFormatException If the string does not contain a parsable number
     */
    public static function valueOf(Strng $string)
    {
        if (! preg_match("/([0-9-]+)/", $string->stringValue())) {
            NumberFormatException::forInputString($string->stringValue());
        }
        if (! is_numeric($string->stringValue())) {
            NumberFormatException::forInputString($string->stringValue());
        }
        return new Integer((integer) $string->stringValue());
    }

    /**
     * Returns a new <code>Integer</code> initialized to the value
     * represented by the specified <code>Strng</code>, as performed
     * by the <code>valueOf</code> method of class <code>Integer</code>.
     *
     * @param Strng $string The string to be parsed.
     *
     * @return \AppserverIo\Lang\Integer The <code>Integer</code> value represented by the string argument.
     * @exception \AppserverIo\Lang\NumberFormatException If the string does not contain a parsable <code>Integer</code>.
     * @see \AppserverIo\Lang\Integer::valueOf($string)
     */
    public static function parseInteger(Strng $string)
    {
        return Integer::valueOf($string)->intValue();
    }

    /**
     * Returns the value of the specified number as a <code>float</code>.
     * This may involve rounding.
     *
     * @return float The numeric value represented by this object after conversion to type <code>float</code>
     * @see \AppserverIo\Lang\Number::floatValue()
     */
    public function floatValue()
    {
        return (float) $this->value;
    }

    /**
     * Returns the value of the specified number as an <code>int</code>.
     * This may involve rounding or truncation.
     *
     * @return integer The numeric value represented by this object after conversion to type <code>int</code>
     * @see \AppserverIo\Lang\Number::intValue()
     */
    public function intValue()
    {
        return $this->value;
    }

    /**
     * Returns the value of the specified number as a <code>double</code>.
     * This may involve rounding.
     *
     * @return double The numeric value represented by this object after conversion to type <code>double</code>
     * @see \AppserverIo\Lang\Number::doubleValue()
     */
    public function doubleValue()
    {
        return (double) $this->value;
    }

    /**
     * This method has to be called to serialize the Integer.
     *
     * @return string Returns a serialized version of the Integer
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize($this->value);
    }

    /**
     * This method unserializes the passed string and initializes the Integer
     * itself with the data.
     *
     * @param string $data Holds the data of the instance as serialized string
     *
     * @return void
     * @see \Serializable::unserialize($data)
     */
    public function unserialize($data)
    {
        $this->value = unserialize($data);
    }

    /**
     * This object as String returned.
     *
     * @return \AppserverIo\Lang\Strng The value as String.
     */
    public function toString()
    {
        return new Strng($this->value);
    }

    /**
     * This method returns the class as
     * a string representation.
     *
     * @return string The objects string representation
     * @see \AppserverIo\Lang\Object::__toString()
     */
    public function __toString()
    {
        $string = new Strng($this->value);
        return $string->stringValue();
    }

    /**
     * Returns true if the passed value is equal.
     *
     * @param \AppserverIo\Lang\Object $val The value to check
     *
     * @return boolean
     */
    public function equals(Object $val)
    {
        if ($val instanceof Integer) {
            return $this->intValue() == $val->intValue();
        }
        return false;
    }

    /**
     * Adds the value of the passed Integer.
     *
     * @param \AppserverIo\Lang\Integer $toAdd The Integer to add
     *
     * @return \AppserverIo\Lang\Integer The instance
     */
    public function add(Integer $toAdd)
    {
        $this->value += $toAdd->intValue();
        return $this;
    }

    /**
     * Subtracts the value of the passed Integer.
     *
     * @param \AppserverIo\Lang\Integer $toSubtract The integer to subtract
     *
     * @return \AppserverIo\Lang\Integer The instance
     */
    public function subtract(Integer $toSubtract)
    {
        $this->value -= $toSubtract->intValue();
        return $this;
    }

    /**
     * Multiplies the Integer with the passed one.
     *
     * @param \AppserverIo\Lang\Integer $toMultiply The Integer to multiply
     *
     * @return \AppserverIo\Lang\Integer The instance
     */
    public function multiply(Integer $toMultiply)
    {
        $this->value *= $toMultiply->intValue();
        return $this;
    }

    /**
     * Divides the Integer by the passed one.
     * As this is an Integer
     * the result will ALWAYS be casted to an Integer agains, what
     * means that everything after the decimal point will be cutted
     * of!
     *
     * @param \AppserverIo\Lang\Integer $dividyBy The Integer to dividy by
     *
     * @return \AppserverIo\Lang\Integer The instance
     */
    public function divide(Integer $dividyBy)
    {
        $this->value = intval(($this->value / $dividyBy->intValue()));
        return $this;
    }

    /**
     * The methods returns the remainder of division of objects value
     * by the passed divisor.
     *
     * @param \AppserverIo\Lang\Integer $divisor The divisor for the modulo operation
     *
     * @return \AppserverIo\Lang\Integer The remainder of the modulo operation
     */
    public function modulo(Integer $divisor)
    {
        return new Integer($this->value % $divisor->intValue());
    }

    /**
     * Returns TRUE if the object's value is greater than the passed one.
     *
     * @param \AppserverIo\Lang\Integer $val The value to test the object's value against
     *
     * @return boolean TRUE if the object's value is greater
     */
    public function greaterThan(Integer $val)
    {
        return $this->value > $val->intValue();
    }

    /**
     * Returns TRUE if the object's value is greater or equal than
     * the passed one.
     *
     * @param \AppserverIo\Lang\Integer $val The value to test the object's value against
     *
     * @return boolean TRUE if the object's value is greater or equal
     */
    public function greaterThanOrEqual(Integer $val)
    {
        return $this->value >= $val->intValue();
    }

    /**
     * Returns TRUE if the objects value is lower than the passed one.
     *
     * @param \AppserverIo\Lang\Integer $val The value to test the object's value against
     *
     * @return boolean TRUE if the objects value is lower
     */
    public function lowerThan(Integer $val)
    {
        return $this->value < $val->intValue();
    }

    /**
     * Returns TRUE if the objects value is lower or equal than
     * the passed one.
     *
     * @param \AppserverIo\Lang\Integer $val The value to test the objects value against
     *
     * @return boolean TRUE if the objects value is lower or equal
     */
    public function lowerThanOrEqual(Integer $val)
    {
        return $this->value <= $val->intValue();
    }
}
