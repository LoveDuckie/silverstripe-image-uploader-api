<?php

namespace LoveDuckie\SilverStripe\ImageUploaderApi\Controllers;

use Exception;
use SilverStripe\Assets\Upload;
use SilverStripe\Control\HTTPRequest;

class ImageUploaderApiController extends Upload
{
    private static $allowed_actions = [
        "upload"
    ];

    private static $url_handlers = [
        'POST /' => 'upload',
    ];

    public function isValidApiToken(string $apiToken)
    {
        if (empty($apiToken)) {
            throw new Exception("The API token specified is invalid or null");
        }

        return false;
    }

    private static function generateResponse(string $message, int $code)
    {
        $response = [
            "id" =>  uniqid(),
            "message" => $message,
            "code" => $code
        ];

        return json_encode($response, JSON_PRETTY_PRINT);
    }

    public function upload(HTTPRequest $request)
    {
        if (!$request) {
            throw new Exception("The request is invalid or null");
        }
        if (!$request->isPOST()) {
            if (!array_key_exists("Content-Type", $this->getHeaders())) {
                return $this->httpError(400, static::generateResponse("The content-type was not defined.", 403));
            }
            if ($this->getHeaders()['Content-Type'] != "application/json") {
                return $this->httpError(400, static::generateResponse("Invalid request.", 403));
            }
        }

        $requestBody = $request->getBody();
        if (!isset($requestBody)) {
            throw new Exception("The request body is invalid or null.")
        }
    }
}
