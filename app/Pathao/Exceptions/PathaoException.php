<?php

namespace App\Pathao\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Throwable;

class PathaoException extends Exception
{
    /**
     * @var array
     */
    private $errors;

    public function __construct($message = '', $code = 0, array $errors = [], ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->errors = $errors;
    }

    /**
     * Json return
     * @return array
     */
    public function render(): array
    {
        return [
            'error' => true,
            'code' => $this->code,
            'message' => $this->getMessage(),
            'errors' => $this->errors,
        ];
    }

    /**
     * Get validation errors
     *
     * @return JsonResponse
     */
    public function getErrors()
    {
        return response()->json($this->errors, $this->code);
    }
}
