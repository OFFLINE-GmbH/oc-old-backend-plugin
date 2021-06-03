# Old Backend Plugin for October CMS

This plugin restores the October V1 backend for October V2 installations.

It enables you to upgrade a project to the latest version of October CMS
without introducing a major visual change for the end-user.

The plugin restores the following components:

* General color scheme
* List widget
* File upload widget
* Form input styles
* Tabs
* Breadcrumbs
* Backend settings

It does not revert the following components:

* Main menu
* Icon set
* Editor

## Installation

You can install the plugin via composer. Your backend skin will be
updated without any further configuration.

```
composer require offline/oc-oldbackend-plugin
```

To revert your skin back to the original October V2 skin, disable or remove this plugin.
