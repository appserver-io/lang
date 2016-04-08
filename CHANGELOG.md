# Version 3.0.0

## Bugfixes

* None

## Features

* Refactoring to work with PHP 7

# Version 2.0.0

## Bugfixes

* None

## Features

* Add implementsInterface(), isAbstract() and isInterface() methods to ClassInterface
* Implement ReflectionClass::isAbstract() and ReflectionClass::isInterface() methods

# Version 1.0.1

## Bugfixes

* None

## Features

* Add private static ReflectionAnnotation::fromStdClass() method to initialize a ReflectionAnnotation from a \stdClass instance


# Version 1.0.0

## Bugfixes

* None

## Features

* Updated to new stable dependencies

# Version 0.1.18

## Bugfixes

* Declarative property default values may break thread safety

## Features

* None

# Version 0.1.17

## Bugfixes

* None

## Features

* Applied new coding conventions

# Version 0.1.16

## Bugfixes

* None

## Features

* Added a NotImplementedException class

# Version 0.1.15

## Bugfixes

* None

## Features

* Implement ReflectionClass::addAnnotationAlias(), ReflectionMethod::addAnnotationAlias() and ReflectionProperty::addAnnotationAlias()

# Version 0.1.14

## Bugfixes

* None

## Features

* Implement ReflectionMethod::getParameters() method

# Version 0.1.13

## Bugfixes

* None

## Features

* Add ParameterInterface interface and ReflectionParameter class

# Version 0.1.12

## Bugfixes

* None

## Features

* Do not overwrite annotation values when passing them to constructor, instead copy each key value pair

# Version 0.1.11

## Bugfixes

* Use isset() to check for initialized instances instead of == null comparison

## Features

* None

# Version 0.1.10

## Bugfixes

* Performance optimizations

## Features

* None

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
