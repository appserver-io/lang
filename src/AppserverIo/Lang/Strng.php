<?php

/**
 * \AppserverIo\Lang\Strng
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
 * a string value as object.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/lang
 * @link      http://www.appserver.io
 */
class Strng extends Object implements \Serializable
{

    /**
     * Holds the chars the String contains of.
     *
     * @var array
     */
    protected $value;

    /**
     * The length of the String.
     *
     * @var integer
     */
    protected $length;

    /**
     * The cached hash of the String itself.
     *
     * @var integer
     */
    protected $hash;

    /**
     * Initializes a newly created <code>String</code> object so that it
     * represents the same sequence of characters as the argument; in other
     * words, the newly created string is a copy of the argument string.
     * Unless
     * an explicit copy of <code>value</code> is needed, use of this
     * constructor is unnecessary since Strings are immutable.
     *
     * @param mixed $value Holds the value to initialize the String instance with
     */
    public function __construct($value = null)
    {
        // initialize property default values here, as declarative default values may break thread safety,
        // when utilizing static and non-static access on class methods within same thread context!
        $this->value = '';
        $this->length = 0;
        $this->hash = 0;

        $this->init($value);
    }

    /**
     * Initializes the string and returns the
     * instance.
     *
     * @param mixed $value The value to initialize the instance with
     *
     * @return \AppserverIo\Lang\Strng The initialized instance
     */
    protected function init($value)
    {
        // check if a value was passed
        if (! is_null($value)) {
            // if yes, cast and set it
            $this->value = (string) $value;
            $this->length = strlen($this->value);
        }
        // return the instance
        return $this;
    }

    /**
     * Initializes a new String instance with the passed value
     * and returns it.
     *
     * @param mixed $value The value to initialize the String with
     *
     * @return \AppserverIo\Lang\Strng The initialized String instance
     */
    public static function valueOf($value)
    {
        return new Strng($value);
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
     * A copy of this object is returned.
     *
     * @return \AppserverIo\Lang\Strng A copy of the String itself.
     */
    public function toString()
    {
        return new Strng($this->stringValue());
    }

    /**
     * This returns the string value of
     * the String itself.
     *
     * @return string Returns the string value of itself
     */
    public function __toString()
    {
        return $this->stringValue();
    }

    /**
     * Returns a new String, containing the concatenated value
     * of the this string with the passed one.
     *
     * @param \AppserverIo\Lang\Strng $string The String to concatenate
     *
     * @return \AppserverIo\Lang\Strng The concatenated String
     */
    public function concat(Strng $string)
    {
        return new Strng($this->stringValue() . $string->stringValue());
    }

    /**
     * Returns the length of this string.
     * The length is equal to the number of 16-bit
     * Unicode characters in the string.
     *
     * @return integer The length of the sequence of characters represented by this object.
     */
    public function length()
    {
        return $this->length;
    }

    /**
     * Returns the value as string.
     *
     * @return string The string value represented by this object
     */
    public function stringValue()
    {
        return $this->value;
    }

    /**
     * Returns a new string resulting from replacing all occurrences of
     * <code>oldChar</code> in this string with <code>newChar</code>.
     * <p>
     * If the character <code>oldChar</code> does not occur in the
     * character sequence represented by this <code>String</code> object,
     * then a reference to this <code>String</code> object is returned.
     * Otherwise, a new <code>String</code> object is created that
     * represents a character sequence identical to the character sequence
     * represented by this <code>String</code> object, except that every
     * occurrence of <code>oldChar</code> is replaced by an occurrence
     * of <code>newChar</code>.
     * <p>
     * Examples:
     * <blockquote><pre>
     * "mesquite in your cellar".replace('e', 'o')
     * returns "mosquito in your collar"
     * "the war of baronets".replace('r', 'y')
     * returns "the way of bayonets"
     * "sparring with a purple porpoise".replace('p', 't')
     * returns "starring with a turtle tortoise"
     * "JonL".replace('q', 'x') returns "JonL" (no change)
     * </pre></blockquote>
     *
     * @param string $oldChar The old character
     * @param string $newChar The new character
     *
     * @return \AppserverIo\Lang\Strng A string derived from this string by replacing every occurrence of <code>oldChar</code> with <code>newChar</code>
     */
    public function replace($oldChar, $newChar)
    {
        return new Strng(str_replace($oldChar, $newChar, $this->stringValue()));
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
        return $this->stringValue() == $val->stringValue();
    }

    /**
     * Returns a new String that is a substring of this String.
     * The
     * substring begins at the specified <code>beginIndex</code> and
     * extends to the character at index <code>endIndex - 1</code>.
     * Thus the length of the substring is <code>endIndex-beginIndex</code>.
     * <p>
     * Examples:
     * <blockquote><pre>
     * $hamburger = new String("hamburger");
     * $hamburger->substring(4, 8) returns "urge"
     * </pre></blockquote>
     *
     * @param integer $beginIndex The beginning index, inclusive
     * @param integer $endIndex   The ending index, exclusive
     *
     * @return \AppserverIo\Lang\Strng The specified substring
     * @exception \AppserverIo\Lang\StrngIndexOutOfBoundsException if the <code>beginIndex</code> is negative, or <code>endIndex</code> is larger than the length of this <code>String</code> object, or <code>beginIndex</code> is larger than <code>endIndex</code>.
     */
    public function substring($beginIndex, $endIndex)
    {
        if ($beginIndex < 0) {
            StrngIndexOutOfBoundsException::forIndex($beginIndex);
        }
        if ($endIndex > $this->length()) {
            StrngIndexOutOfBoundsException::forIndex($endIndex);
        }
        if ($beginIndex > $endIndex) {
            StrngIndexOutOfBoundsException::forIndex($endIndex - $beginIndex);
        }
        if (($beginIndex == 0) && ($endIndex == $this->length())) {
            return $this;
        }
        $value = substr($this->stringValue(), $beginIndex, $endIndex);
        return new Strng($value);
    }

    /**
     * Returns a hash code for this string.
     * The hash code for a
     * <code>String</code> object is computed as
     * <blockquote><pre>
     * s[0]*31^(n-1) + s[1]*31^(n-2) + ... + s[n-1]
     * </pre></blockquote>
     * using <code>int</code> arithmetic, where <code>s[i]</code> is the
     * <i>i</i>th character of the string, <code>n</code> is the length of
     * the string, and <code>^</code> indicates exponentiation.
     * (The hash value of the empty string is zero.)
     *
     * @return string A hash code value for this object.
     */
    public function hashCode()
    {
        $h = $this->hash;
        if ($h == 0) {
            $off = 0;
            $len = $this->length();
            for ($i = 0; $i < $len; $i ++) {
                $h = 31 * $h + $off ++;
            }
            $this->hash = $h;
        }
        return $h;
    }

    /**
     * Tells whether or not this string matches the
     * given regular expression.
     *
     * @param string $regex The regular expression to which this string is to be matched
     *
     * @return boolean TRUE if, and only if, this string matches the given regular expression
     */
    public function matches($regex)
    {
        $isExisting = false;
        if (ereg($regex, $this->stringValue()) != false) {
            $isExisting = true;
        }
        return $isExisting;
    }

    /**
     * This method has to be called to serialize the String.
     *
     * @return string Returns a serialized version of the String
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(get_object_vars($this));
    }

    /**
     * This method unserializes the passed string and initializes the String
     * itself with the data.
     *
     * @param string $data Holds the data of the instance as serialized string
     *
     * @return void
     * @see \Serializable::unserialize($data)
     */
    public function unserialize($data)
    {
        foreach (unserialize($data) as $propertyName => $propertyValue) {
            $this->$propertyName = $propertyValue;
        }
    }

    /**
     * Splits this string around matches of the given regular expression.
     *
     * The array returned by this method contains each substring of this
     * string that is terminated by another substring that matches the
     * given expression or is terminated by the end of the string. The
     * substrings in the array are in the order in which they occur in
     * this string. If the expression does not match any part of the
     * input then the resulting array has just one element, namely this
     * string.
     *
     * The limit parameter controls the number of times the pattern is
     * applied and therefore affects the length of the resulting array.
     * If the limit n is greater than zero then the pattern will be applied
     * at most n - 1 times, the array's length will be no greater than n,
     * and the array's last entry will contain all input beyond the last
     * matched delimiter. If n is non-positive then the pattern will be
     * applied as many times as possible and the array can have any length.
     * If n is zero then the pattern will be applied as many times as
     * possible, the array can have any length, and trailing empty strings
     * will be discarded.
     *
     * The string "boo:and:foo", for example, yields the following results
     * with these parameters:
     *
     * Regex Limit Result
     * : 2 { "boo", "and:foo" }
     * : 5 { "boo", "and", "foo" }
     * : -2 { "boo", "and", "foo" }
     * o 5 { "b", "", ":and:f", "", "" }
     * o -2 { "b", "", ":and:f", "", "" }
     * o 0 { "b", "", ":and:f" }
     *
     * An invocation of this method of the form str.split(regex, n) yields the
     * same result as the expression.
     *
     * @param string  $regex The delimiting regular expression
     * @param integer $limit The result threshold, as described above
     *
     * @return array The array of strings computed by splitting this string around matches of the given regular expression
     */
    public function split($regex, $limit = -1)
    {
        // split the internal value into it's parts
        return preg_split($regex, $this->stringValue(), $limit, PREG_SPLIT_NO_EMPTY);
    }

    /**
     * Returns a copy of the string, with leading and trailing whitespace
     * omitted.
     * <p>
     * If this <code>String</code> object represents an empty character
     * sequence, or the first and last characters of character sequence
     * represented by this <code>String</code> object both have codes
     * greater than <code>'&#92;u0020'</code> (the space character), then a
     * reference to this <code>String</code> object is returned.
     * <p>
     * Otherwise, if there is no character with a code greater than
     * <code>'&#92;u0020'</code> in the string, then a new
     * <code>String</code> object representing an empty string is created
     * and returned.
     * <p>
     * Otherwise, let <i>k</i> be the index of the first character in the
     * string whose code is greater than <code>'&#92;u0020'</code>, and let
     * <i>m</i> be the index of the last character in the string whose code
     * is greater than <code>'&#92;u0020'</code>. A new <code>String</code>
     * object is created, representing the substring of this string that
     * begins with the character at index <i>k</i> and ends with the
     * character at index <i>m</i>-that is, the result of
     * <code>this.substring(<i>k</i>,&nbsp;<i>m</i>+1)</code>.
     * <p>
     * This method may be used to trim
     * {@link Character#isSpace(char) whitespace} from the beginning and end
     * of a string; in fact, it trims all ASCII control characters as well.
     *
     * @return \AppserverIo\Lang\Strng A reference of this string with leading and trailing white space removed, or this string if it has no leading or trailing white space.
     */
    public function trim()
    {
        return $this->init(trim($this->stringValue()));
    }

    /**
     * md5 encryptes the string and returns the
     * instance.
     *
     * @return \AppserverIo\Lang\Strng The instance md5 encrypted
     */
    public function md5()
    {
        return $this->init(md5($this->stringValue()));
    }

    /**
     * Converts the string value to upper case
     * and returns the instance.
     *
     * @return \AppserverIo\Lang\Strng The instance
     */
    public function toUpperCase()
    {
        return $this->init(strtoupper($this->stringValue()));
    }

    /**
     * Converts the string value to lower case
     * and returns the instance.
     *
     * @return \AppserverIo\Lang\Strng The instance
     */
    public function toLowerCase()
    {
        return $this->init(strtolower($this->stringValue()));
    }
}
