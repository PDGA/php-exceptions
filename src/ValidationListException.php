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
     * Each error contains a string $message and a nullable int $code.
     *
     * @param string   $message
     * @param string   $field
     * @param int|null $code
     *
     * @return void
     */
    public function addError(
        string $message,
        string $field,
        ?int   $code = null
    )
    {
        // Instantiate a validation error list for the given $field if needed.
        if (!isset($this->validation_errors[$field]))
        {
            $this->validation_errors[$field] = [];
        }

        $this->validation_errors[$field][] = [
            'code'    => $code,
            'message' => $message
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
