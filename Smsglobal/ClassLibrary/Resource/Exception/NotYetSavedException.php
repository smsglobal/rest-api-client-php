<?php
namespace Smsglobal\ClassLibrary\Resource\Exception;

/**
 * An exception thrown when trying to do get the request URI of a resource when
 * it hasn't been saved yet (and hence no resource URI is available)
 *
 * @package Smsglobal\ClassLibrary\Resource\Exception
 */
class NotYetSavedException extends \Exception
{
}
