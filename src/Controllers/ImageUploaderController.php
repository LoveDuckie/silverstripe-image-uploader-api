<?php

namespace LoveDuckie\SilverStripe\ImageUploaderApi\Controllers;

use SilverStripe\AssetAdmin\Controller\AssetAdmin;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Control\HTTPResponse;
use SilverStripe\Forms\FileUploadReceiver;

use SilverStripe\Assets\File;

class ImageUploaderController
{
    use FileUploadReceiver;

    public function authenticate() {

    }

    /**
     * Creates a single file based on a form-urlencoded upload.
     *
     * @param HTTPRequest $request
     * @return HTTPResponse
     */
    public function index(HTTPRequest $request)
    {
//        if ($this->isDisabled() || $this->isReadonly()) {
//            return $this->httpError(403);
//        }

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
