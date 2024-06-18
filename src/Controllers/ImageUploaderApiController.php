<?php

namespace LoveDuckie\SilverStripe\ImageUploaderApi\Controllers;

use Exception;
use SilverStripe\Assets\Upload;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Control\HTTPResponse;

class ImageUploaderApiController extends Upload
{
    /**
     * @var array|string[]
     */
    private static array $allowed_actions = [
        "upload"
    ];

    /**
     * @var array|string[]
     */
    private static array $url_handlers = [
        'POST /' => 'upload',
    ];

    /**
     * Determines whether the specified API token is considered valid.
     * @param string $apiToken
     * @return false
     * @throws Exception
     */
    public function isValidApiToken(string $apiToken): false
    {
        if (empty($apiToken)) {
            throw new Exception("The API token specified is invalid or null");
        }

        return false;
    }


    /**
     * Generate the JSON response
     *
     * @param string $message
     * @param int $code
     * @return false|string
     */
    private static function generateJsonResponse(string $message, int $code): false|string
    {
        $response = [
            "id" =>  uniqid(),
            "message" => $message,
            "code" => $code
        ];

        return json_encode($response, JSON_PRETTY_PRINT);
    }


    /**
     * Instantiate the HTTP response object based on the JSON encoded message and status code.
     *
     * @param string $message
     * @param int $code
     * @return HTTPResponse
     */
    private static function generateHttpResponse(string $message, int $code): HTTPResponse
    {
        return new HTTPResponse(self::generateJsonResponse($message,$code));
    }


    /**
     * @param HTTPRequest $request
     * @return void|null
     * @throws Exception
     */
    public function upload(HTTPRequest $request)
    {
        if (!$request->isPOST()) {
            if (!array_key_exists("Content-Type", $request->getHeaders())) {
                $this->getResponse()->setStatusCode(400);
                return null;
            }
            if ($request->getHeaders()['Content-Type'] != "application/json") {
                return null;
            }
        }
        $this->setResponse(self::generateHttpResponse("Test",200));
        $requestBody = $request->getBody();
        if (!isset($requestBody)) {
            throw new Exception("The request body is invalid or null.");
        }
    }
}
