<?php
namespace OFFLINE\OldBackend\Skins;

use Backend\Skins\Standard;
use October\Rain\Router\Helper as RouterHelper;

class V1 extends Standard
{
    protected $basePath;

    /**
     * @inheritDoc
     */
    public function __construct()
    {
        parent::__construct();
        $this->basePath = plugins_path('offline/oldbackend');
    }

    /**
     * @inheritDoc
     */
    public function skinDetails()
    {
        return [
            'name' => 'October V1 Skin',
        ];
    }

    /**
     * @inheritDoc
     */
    public function getPath($path = null, $isPublic = false)
    {
        $path = RouterHelper::normalizeUrl($path);


        if (file_exists($this->basePath . $path)) {
            return '/plugins/offline/oldbackend' . $path;
        }

        return $isPublic
            ? $this->defaultPublicSkinPath . $path
            : $this->defaultSkinPath . $path;
    }

    /**
     * @inheritDoc
     */
    public function getLayoutPaths()
    {
        return [$this->basePath . '/layouts', $this->skinPath . '/layouts'];
    }

}

