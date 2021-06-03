<?php

namespace OFFLINE\OldBackend;

use Backend\Classes\WidgetBase;
use Config;
use Event;
use OFFLINE\OldBackend\Skins\V1;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name' => 'Old Backend',
            'description' => 'Restores the October v1 Backend in October v2',
            'author' => 'OFFLINE',
            'icon' => 'icon-paint-brush',
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {
        // Set our custom backend skin.
        Config::set('backend.skin', V1::class);

        // Add overrides to the partials path for backend widgets.
        WidgetBase::extendableExtendCallback(function (WidgetBase $widget) {
            $origViewPath = $widget->guessViewPath();
            $newViewPath = str_replace(base_path(), '', $origViewPath);
            if (!str_starts_with($newViewPath, '/modules/backend')) {
                return;
            }
            $newViewPath = str_replace('/modules/backend', '', $newViewPath);
            $newViewPath = plugins_path('offline/oldbackend' . $newViewPath . '/partials');

            $widget->addViewPath($newViewPath);
        });

        // Override assets for form widgets.
        Event::listen('system.assets.beforeAddAsset', function (&$type, &$path, &$userAttrs) {
            //  File upload
            if (str_contains($path, '/modules/backend/formwidgets/fileupload/assets/css/fileupload.css')) {
                $path = '/plugins/offline/oldbackend/formwidgets/fileupload/assets/css/fileupload.css';
            } elseif (str_contains($path, '/modules/backend/formwidgets/fileupload/assets/js/fileupload.js')) {
                $path = '/plugins/offline/oldbackend/formwidgets/fileupload/assets/js/fileupload.js';
            }
        });
    }

}
