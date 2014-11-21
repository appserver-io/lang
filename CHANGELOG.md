# Version 0.1.9

## Bugfixes

* Bugfix ReflectionMethod::invoke() method to correctly pass args to method invocation

## Features

* None

# Version 0.1.8

## Bugfixes

* Activate ReflectionClass::getMethods() $filter parameter with -1 to ignore filter by default

## Features

* Add ReflectionProperty functionality

# Version 0.1.7

## Bugfixes

* Bugfix to return real class name when invoking ReflectionClass:getName() instead of the one passed to the constructor

## Features

* Add method ReflectionClass::getShortName()

# Version 0.1.6

## Bugfixes

* None

## Features

* Add ReflectionObject implementation
* Add ReflectionClass::newInstance() and ReflectionClass::newInstanceArgs() methods
* Rename method ReflectionClass::getClassName() to ReflectionClass::getName()

# Version 0.1.5

## Bugfixes

* None

## Features

* Add generic userland implementations for reflection annotation, class and method
* Add dependency to herrera-io/annotations to parse and initialized Doctrine style annotations

# Version 0.1.4

## Bugfixes

* None

## Features

* Add userland interfaces for reflection annotation, class and method

# Version 0.1.3

## Bugfixes

* None

## Features

* String, Integer, Float and Boolean class now implements \Serializable interface

# Version 0.1.2

## Bugfixes

* None

## Features

* Add new IllegalStateException

# Version 0.1.1

## Bugfixes

* None

## Features

* Refactoring ANT PHPUnit execution process
* Composer integration by optimizing folder structure (move bootstrap.php + phpunit.xml.dist => phpunit.xml)
* Switch to new appserver-io/build build- and deployment environment