<?php

namespace common\extensions;

use Yii;
use yii\base\BootstrapInterface;

/**
 * Class ModuleBootstrap
 *
 * @package common\extensions
 */
class ModuleBootstrap implements BootstrapInterface
{
    const DS = DIRECTORY_SEPARATOR;

    /**
     * @param \yii\base\Application $application
     */
    public function bootstrap($application)
    {
        $moduleList = $application->getModules();

        foreach ($moduleList as $key => $module) {
            if (is_array($module) && array_key_exists('class', $module)) {
                $filePathConfig = Yii::getAlias('@app').self::DS.'modules'.self::DS.$key.self::DS.'config'.self::DS.'routes.php';

                if (file_exists($filePathConfig)) {
                    /** @noinspection PhpIncludeInspection */
                    $application->getUrlManager()->addRules(require($filePathConfig));
                }
            }
        }
    }
}