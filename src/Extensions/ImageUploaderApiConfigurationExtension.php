<?php

namespace LoveDuckie\SilverStripe\ImageUploaderApi\Extensions;

use SilverStripe\ORM\DataExtension;

use SilverStripe\Forms\FieldList;

class ImageUploaderApiConfigurationExtension extends DataExtension
{
    /**
     * @param FieldList $fields
     * @return void
     */
    public function updateCMSFields(FieldList $fields)
    {
        return parent::updateCMSFields($fields);
    }
}
