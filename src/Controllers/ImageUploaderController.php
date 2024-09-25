<?php

namespace LoveDuckie\SilverStripe\ImageUploaderApi\Controllers;

use SilverStripe\AssetAdmin\Controller\AssetAdmin;
use SilverStripe\Control\Controller;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Control\HTTPResponse;
use SilverStripe\Control\HTTPResponse_Exception;
use SilverStripe\Forms\FileUploadReceiver;

use SilverStripe\Assets\File;
use SilverStripe\ORM\ValidationException;

class ImageUploaderController extends Controller
{
    use FileUploadReceiver;


    /**
     * @param HTTPRequest $request
     * @return HTTPResponse
     * @throws HTTPResponse_Exception
     * @throws ValidationException
     */
    public function index(HTTPRequest $request): HTTPResponse
    {
        // CSRF check
        $token = $this->getForm()->getSecurityToken();
        if (!$token->checkRequest($request)) {
            return $this->httpError(400);
        }

        $tmpFile = $request->postVar('Upload');
        /** @var File $file */
        $file = $this->saveTemporaryFile($tmpFile, $error);

        // Prepare result
        if ($error) {
            $result = [
                'message' => [
                    'type' => 'error',
                    'value' => $error,
                ]
            ];
            $this->getUpload()->clearErrors();
            return (new HTTPResponse(json_encode($result), 400))
                ->addHeader('Content-Type', 'application/json');
        }

        // We need an ID for getObjectFromData
        if (!$file->isInDB()) {
            $file->write();
        }

        // Return success response
        $result = [
            AssetAdmin::singleton()->getObjectFromData($file)
        ];

        // Don't discard pre-generated client side canvas thumbnail
        if ($result[0]['category'] === 'image') {
            unset($result[0]['thumbnail']);
        }
        $this->getUpload()->clearErrors();
        return (new HTTPResponse(json_encode($result)))
            ->addHeader('Content-Type', 'application/json');
    }
}
