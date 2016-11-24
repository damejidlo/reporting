<?php

namespace Damejidlo\Reporting\Query;

class SyntaxErrorException extends \Exception
{

}



class InvalidParameterTypeException extends SyntaxErrorException
{

}



class ParameterNotSetException extends \Exception
{

}



class InvalidParameterValueException extends \Exception
{

}
