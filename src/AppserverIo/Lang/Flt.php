<?php

/**
 * \AppserverIo\Lang\Flt
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
 * a float value as object.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/lang
 * @link      http://www.appserver.io
 */
class Flt extends Number implements \Serializable
{

    /**
     * The value of the Float.
     *
     * @var float
     */
    protected $value;

    /**
     * Constructs a newly allocated <code>Float</code> object that
     * represents the primitive <code>float</code> argument.
     *
     * @param float $value The value to be represented by the <code>Float</code>
     */
    public function __construct($value)
    {
        // initialize property default values here, as declarative default values may break thread safety,
        // when utilizing static and non-static access on class methods within same thread context!
        $this->value = null;

        if (!is_float($value)) {
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
     * Returns a <code>Float</code> object holding the
     * <code>float</code> value represented by the argument string
     * <code>s</code>.
     * <p>
     * If <code>s</code> is <code>null</code>, then a
     * <code>NullPointerException</code> is thrown.
     * <p>
     * Leading and trailing whitespace characters in <code>s</code>
     * are ignored. The rest of <code>s</code> should constitute a
     * <i>Float</i> as described by the lexical syntax rules:
     * <blockquote><i>
     * <dl>
     * <dt>Float:
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
     * form of a <i>Float</i>, then a
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
     * </code><br>results in the <code>float</code> value
     * <code>1.0000002f</code>; if the string is converted directly to
     * <code>float</code>, <code>1.000000<b>1</b>f</code> results.
     *
     * @param \AppserverIo\Lang\Strng $string The string to be parsed
     *
     * @return \AppserverIo\Lang\Flt A <code>Float</code> object holding the value represented by the <code>Strng</code> argument
     * @exception \AppserverIo\Lang\NumberFormatException If the string does not contain a parsable number
     */
    public static function valueOf(Strng $string)
    {
        if (! preg_match("/([0-9\.-]+)/", $string->stringValue())) {
            NumberFormatException::forInputString($string->stringValue());
        }
        if (! is_numeric($string->stringValue())) {
            NumberFormatException::forInputString($string->stringValue());
        }
        return new Flt((float) $string->stringValue());
    }

    /**
     * Returns a new <code>float</code> initialized to the value
     * represented by the specified <code>Strng</code>, as performed
     * by the <code>valueOf</code> method of class <code>Float</code>.
     *
     * @param \AppserverIo\Lang\Strng $string She string to be parsed
     *
     * @return float The <code>float</code> value represented by the string argument
     * @exception \AppserverIo\Lang\NumberFormatException If the string does not contain a parsable <code>float</code>.
     * @see \AppserverIo\Lang\Flt::valueOf($string)
     */
    public static function parseFloat(Strng $string)
    {
        return Flt::valueOf($string)->floatValue();
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
        return $this->value;
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
        return (int) $this->value;
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
     * This method has to be called to serialize the Float.
     *
     * @return string Returns a serialized version of the Float
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize($this->value);
    }

    /**
     * This method unserializes the passed string and initializes the Float
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
        if ($val instanceof Flt) {
            return $this->floatValue() == $val->floatValue();
        }
        return false;
    }

    /**
     * Adds the value of the passed Float.
     *
     * @param \AppserverIo\Lang\Flt $toAdd The Float to add
     *
     * @return \AppserverIo\Lang\Flt The instance
     */
    public function add(Flt $toAdd)
    {
        $this->value += $toAdd->floatValue();
        return $this;
    }

    /**
     * Subtracts the value of the passed Float.
     *
     * @param \AppserverIo\Lang\Flt $toSubtract The Float to subtract
     *
     * @return \AppserverIo\Lang\Flt The instance
     */
    public function subtract(Flt $toSubtract)
    {
        $this->value -= $toSubtract->floatValue();
        return $this;
    }

    /**
     * Multiplies the Float with the passed one.
     *
     * @param \AppserverIo\Lang\Flt $toMultiply The Float to multiply
     *
     * @return \AppserverIo\Lang\Flt The instance
     */
    public function multiply(Flt $toMultiply)
    {
        $this->value *= $toMultiply->intValue();
        return $this;
    }

    /**
     * Divides the Float by the passed one.
     *
     * @param \AppserverIo\Lang\Flt $dividyBy The Float to dividy by
     *
     * @return \AppserverIo\Lang\Flt The instance
     */
    public function divide(Flt $dividyBy)
    {
        $this->value = $this->value / $dividyBy->floatValue();
        return $this;
    }
}
