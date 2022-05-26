<?php

namespace LoveDuckie\Extensions;

use SilverStripe\ORM\DataExtension;

use SilverStripe\Forms\Tab;

use SilverStripe\Forms\FieldList;

class ImageUploaderApiConfigurationExtension extends DataExtension
{
    public function updateCMSFields(FieldList $fields)
    {
        $tabsToAdd = [];
        $tabsToAdd[] = Tab::create();

        return parent::updateCMSFields($fields);
    }
}