# PHP language extension

[![Latest Stable Version](https://img.shields.io/packagist/v/appserver-io/lang.svg?style=flat-square)](https://packagist.org/packages/appserver-io/lang) 
 [![Total Downloads](https://img.shields.io/packagist/dt/appserver-io/lang.svg?style=flat-square)](https://packagist.org/packages/appserver-io/lang)
 [![License](https://img.shields.io/packagist/l/appserver-io/lang.svg?style=flat-square)](https://packagist.org/packages/appserver-io/lang)
 [![Build Status](https://img.shields.io/travis/appserver-io/lang/master.svg?style=flat-square)](http://travis-ci.org/appserver-io/lang)
 [![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/appserver-io/lang/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/appserver-io/lang/?branch=master)
 [![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/appserver-io/lang/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/appserver-io/lang/?branch=master)

## Introduction

This package provides implementation of basic PHP datatypes.

## Issues

In order to bundle our efforts we would like to collect all issues regarding this package in [the main project repository's issue tracker](https://github.com/appserver-io/appserver/issues).
Please reference the originating repository as the first element of the issue title e.g.:
`[appserver-io/<ORIGINATING_REPO>] A issue I am having`

## Usage

This package provides classes representing an object oriented implementation for some basic datatypes. 

As there has been (and still are) many discussions about PHP and type safety i decided to implement a small, really
basic library that will offer the most basic datatype needed in nearly every project. To be honest, i really like
almost all of those nice possibilities languages like Java provides, but as PHP is not Java, you always have to find a
neat way for implementing similar things in a way it makes sense in a PHP environment.

The intention for implementing that classes was the possibility to make your critical functions and methods type safe,
by using them for type hints on the one hand and the possibility to have an quick and easy to use kind of data
validation mechanism on the other.

As you may know, using type hints will probably slow down your code a bit, so take care when you use them and
always have an eye on possible performance impacts by running performance tests regularly.

The data type implementations this library will provide, are

* Object
* Boolean
* Integer
* Float
* String

The following examples wil give you a short introduction about the functionality each class will provide and
how you can use it in your code. Please be aware, that the examples are not intended to make any sense, they
should only give you an idea what is possible.

### Object

The abstract class `Object` implements a low level presentation of a class. All other classes of this library use it
as superclass.

### Boolean

Using a `Boolean` instance to compare against another one or try to instantiate it with a not boolean value.

```php
// initialize a new Integer instance
$bool = new Boolean(true);
$bool->equals(new Boolean(false)); // false

// throws a ClassCastException
$invalid = new Boolean('aValue');
```

### Integer

Here are some examples how you can use the `Integer` class

```php
// initialize a new Integer instance
$int = new Integer(17);
	    
// get the float value of the Integer
echo $int->floatValue() . PHP_EOL; // 17.0
echo $int->stringValue() . PHP_EOL; // '17'

// check that the two Integer instances are equal
$int->equals(Integer::valueOf(new String('17'))); // true
```

### Flt (Float before version 3.0)

The example for using a `Flt` shows you how to add to instances
and print the float value

```php
// initialize a new Float instance
$float = new Flt(10.005);
$float->add(new Flt(10.105));
        
// check the value
echo $float->floatValue() . PHP_EOL; // 20.11
```

### Strng (String before version 3.0)

To show you how you can use the `Strng` class we'll simple concatenate
to instances

```php
// initialize a new String instance
$string = new Strng('value to');
		
// check that String was successfully concatenated
echo $string->concat(new Strng(' search')) . PHP_EOL; // 'value to search'
```

Yeah, this are really simple examples, and as i told you before in most cases
i'll use that classes for simple things like type hints and so on.

If you like to use that stuff also, feel free to implement your own types and
send me a pull request :)

## External Links

* Documentation at [appserver.io](http://docs.appserver.io)
