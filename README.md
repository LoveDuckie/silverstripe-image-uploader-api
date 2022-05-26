# SilverStripe supported module skeleton

This module enables you to expose a secure and RESTful API for remotely uploading images, and storing them as files (with their records) in Silverstripe. Refer to documentaiton below about usage.

## Requirements

* SilverStripe ^4.0

## Installation

Add some installation instructions here, having a 1 line composer copy and paste is useful.
Here is a composer command to create a new module project. Ensure you read the
['publishing a module'](https://docs.silverstripe.org/en/developer_guides/extending/how_tos/publish_a_module/) guide
and update your module's composer.json to designate your code as a SilverStripe module.

```bash
#!/bin/bash
composer require loveduckie/silverstripe-image-uploader-api 4.x-dev
```

**Note:** When you have completed your module, submit it to Packagist or add it as a VCS repository to your
project's composer.json, pointing to the private repository URL.

## License

See [License](license.md)

## Documentation

* [Documentation readme](docs/en/readme.md)

## Configuration

If your module makes use of the config API in SilverStripe it's a good idea to provide an example config
 here that will get the module working out of the box and expose the user to the possible configuration options.

Provide a yaml code example where possible.

```yaml
--
name: imageuploaderapi-configuration
--
LoveDuckie\SilverStripe\ImageUploaderAPI:
  api_token: kslutdeigujieeseloyyylquyzakullg
  
```

## Maintainers

* Luc Shelton <lucshelton@gmail.com>

## Bugtracker

Bugs are tracked in the issues section of this repository. Before submitting an issue please read over
existing issues to ensure yours is unique.

If the issue does look like a new bug:

* Create a new issue
* Describe the steps required to reproduce your issue, and the expected outcome. Unit tests, screenshots
 and screencasts can help here.
* Describe your environment as detailed as possible: SilverStripe version, Browser, PHP version,
 Operating System, any installed SilverStripe modules.

Please report security issues to the module maintainers directly. Please don't file security issues in the bugtracker.

## Development and contribution

If you would like to make contributions to the module please ensure you raise a pull request and discuss with the module maintainers.
