<?php

namespace LoveDuckie\SilverStripe\ImageUploaderApi\Middlewares;

use SilverStripe\Control\Middleware\HTTPMiddleware;
use SilverStripe\Control\HTTPRequest;

class ImageUploaderApiMiddleware implements HTTPMiddleware
{
    public function process(HTTPRequest $request, callable $delegate)
    {


        return $delegate($request);
    }
}
