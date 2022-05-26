<?php

namespace LoveDuckie\SilverStripe\ImageUploaderApi;

use SilverStripe\ORM\DataObject;

class ImageUploaderApiToken extends DataObject
{
    private static $table_name = "ImageUploaderApiToken";
 
    private static $singular_name ="Image Uploader API Token";

    private static $plural_name ="Image Uploader API Tokens";

    private static $db = [
        'Name' => 'Varchar',
        'Description' => 'Varchar',
        'Expires' => 'Date',
        'Token' => 'Varchar'
    ];
}