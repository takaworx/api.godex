<?php namespace App\Entities;

class ApiResponse
{
    const STATUS_SUCCESS = 200;
    const STATUS_BAD_REQUEST = 400;
    const STATUS_UNAUTHORIZED = 401;
    const STATUS_FORBIDDEN = 403;
    const STATUS_UNEXPECTED_ERROR = 500;

    public function success($data = null, $message = null)
    {
        if (is_null($message)) {
            $message = __('response.success');
        }

        return $this->make($data, $message, self::STATUS_SUCCESS);
    }

    public function badRequest($data = null, $message = null)
    {
        if (is_null($message)) {
            $message = __('response.bad_request');
        }

        return $this->make($data, $message, self::STATUS_BAD_REQUEST);
    }

    public function unauthorized($data = null, $message = null)
    {
        if (is_null($message)) {
            $message = __('response.unauthorized');
        }

        return $this->make($data, $message, self::STATUS_UNAUTHORIZED);
    }

    public function forbidden($data = null, $message = null)
    {
        if (is_null($message)) {
            $message = __('response.forbidden');
        }

        return $this->make($data, $message, self::STATUS_FORBIDDEN);
    }

    public function unexpectedError($data = null, $message = null)
    {
        if (is_null($message)) {
            $message = __('response.unexpected_error');
        }

        return $this->make($data, $message, self::STATUS_UNEXPECTED_ERROR);
    }

    private function make($data = null, $message = null, $status = null)
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $status);
    }
}