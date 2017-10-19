<?php
/**
 * @package   yii2-widget-flatpickr
 * @author    Ishengge <ishengge@gmail.com>
 * @version   1.0.0
 */

namespace lintion\flatpickr;

use yii\web\AssetBundle;

/**
 * This declares the asset files required by flatpickr.
 *
 * @author Ishengge <ishengge@gmail.com>
 * @since 2.0
 */

class FlatpickrAsset extends AssetBundle
{

    /**
     * @var string To use a theme of your choice, Specific @see <https://chmln.github.io/flatpickr/themes/ no set is default>
     */
    public $theme;

    /**
     *
     * @var array flatpickr plugins by config object use. loading diff file.
     * ```php
     * 'plugins' => [
     *      'confirmDate' => [
     *           "enableTime": true,
     *           .......
     *      ],
     *      'weekSelect' => []
     * ]
     *
     * ```
     */
    public $plugins = [];

    /**
     * @var array Load the plugins needed for the css files.
     */
    protected $pluginsCss = ['confirmDate'];

    /**
     * @inheritdoc
     * @var string
     */
    public $sourcePath = '@bower/flatpickr/dist';

    public $depends = [
        'yii\web\YiiAsset',
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        $locale = explode('-', \Yii::$app->language);
        $locale = $locale[0];
        $css = [
            'flatpickr.min.css'
        ];
        if (!empty($this->theme)){
            $css[] = "themes/{$this->theme}.css";
        }
        $this->css = $css;

        $js = [
            'flatpickr.js',
            "l10n/{$locale}.js",
        ];

        $this->js = $js;

        parent::init();
    }

    /**
     * Handles the files that the plugin introduces.
     */
    protected function setPluginsJs()
    {
        $plugins = $this->plugins;
        if (!is_array($this->plugins)){
            $plugins = [];
        }

        foreach ($plugins as $plugin){
            if (in_array($plugin, $this->pluginsCss)){
                $this->css[] = "plugins/{$plugin}/{$plugin}.css";
            }
            $this->js[] = "plugins/{$plugin}/{$plugin}.js";
        }

    }


}