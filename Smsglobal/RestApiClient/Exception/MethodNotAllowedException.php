<?php
namespace Smsglobal\RestApiClient\Exception;

/**
 * An exception thrown when attempting to do an operation that is not allowed,
 * e.g. saving a read-only object
 *
 * @package Smsglobal\RestApiClient\Exception
 */
class MethodNotAllowedException extends \Exception
{
}
