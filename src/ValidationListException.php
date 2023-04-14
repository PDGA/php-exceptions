<?php

namespace PDGA\Exception;

/**
 * Exception class for one or more validation errors.
 */
class ValidationListException extends \Exception
{
    private array $validation_errors = [];

    /**
     * Adds a single validation error to the exception.
     * Errors are stored as an array keyed on $field to allow multiple error messages for the same field.
     * Each error contains a string $message, a nullable int $code and an optional input $value representing
     * the input value that produced the error.
     *
     * @param string   $message
     * @param string   $field
     * @param int|null $code
     * @param mixed    $value
     *
     * @return void
     */
    public function addError(
        string $message,
        string $field,
        ?int   $code = null,
        mixed  $value = null,
    )
    {
        // Instantiate a validation error list for the given $field if needed.
        if (!isset($this->validation_errors[$field]))
        {
            $this->validation_errors[$field] = [];
        }

        $this->validation_errors[$field][] = [
            'code'       => $code,
            'message'    => $message,
            'inputValue' => $value,
        ];
    }

    /**
     * Returns all errors that have been added to the exception.
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->validation_errors;
    }
}
