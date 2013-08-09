<?php
namespace Smsglobal\RestApiClient\Exception;

/**
 * An exception thrown when attempting to save with invalid data
 *
 * @package Smsglobal\RestApiClient\Exception
 */
class InvalidDataException extends \Exception
{
    /**
     * Array of errors
     * @var array
     */
    protected $errors;

    /**
     * Constructor
     *
     * @param array           $errors   Array of errors
     * @param int             $code     Status code
     * @param \Exception|null $previous Previous exception
     */
    public function __construct(array $errors, $code = 0, \Exception $previous = null)
    {
        $this->errors = $errors;
        parent::__construct('Invalid Data', $code, $previous);
    }

    /**
     * Gets the errors array. Keys are field names and values are descriptions
     * of the errors
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
