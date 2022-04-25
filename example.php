<?php
/*
 * @package   plg_radicalmicro_example
 * @version   1.0.0
 * @author    Dmitriy Vasyukov - https://fictionlabs.ru
 * @copyright Copyright (c) 2022 Fictionlabs. All rights reserved.
 * @license   GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link      https://fictionlabs.ru/
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\CMSPlugin;
use RadicalMicro\Helpers\Tree\SchemaHelper;
use RadicalMicro\Helpers\Tree\OGHelper;
use RadicalMicro\Helpers\TypesHelper;
use RadicalMicro\Helpers\PathHelper;

/**
 * Radicalmicro
 *
 * @package   plgRadicalmicroContent
 * @since     1.0.0
 */
class plgRadicalMicroExample extends CMSPlugin
{
    /**
     * Application object
     *
     * @var    CMSApplication
     * @since  1.0.0
     */
    protected $app;

    /**
     * Affects constructor behavior. If true, language files will be loaded automatically.
     *
     * @var    boolean
     *
     * @since  1.0.0
     */
    protected $autoloadLanguage = true;

    /**
     * @param          $subject
     * @param   array  $config
     *
     * @throws Exception
     */
    public function __construct(&$subject, $config = array())
    {
        parent::__construct($subject, $config);

        // Include helper
        JLoader::register('plgRadicalMicroContentHelper', __DIR__ . '/src/Helpers/Helper.php');

        // Helper
        $this->helper = new plgRadicalMicroContentHelper($this->params);
    }


    /**
     * OnRadicalmicroRegisterTypes for init your types for each collection
     *
     * @since 1.0.0
     */
    public function onRadicalMicroRegisterTypes()
    {
        // Add plugin schema and meta to parent RadicalMicro plugin
        // Добавляем классы добавляемых коллекций

        PathHelper::getInstance()->register(__DIR__ . '/src/Types/Collections/Schema', 'schema');
        PathHelper::getInstance()->register(__DIR__ . '/src/Types/Collections/Schema/Extra', 'schema_extra');
        PathHelper::getInstance()->register(__DIR__ . '/src/Types/Collections/Meta', 'meta');
    }

    /**
     * OnRadicalmicroProvider event
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function onRadicalmicroProvider($params)
    {
        // Get and set schema data
        // Получаем данные из хелпера
        $schemaObject = $this->helper->getSchemaObject();

        // Add Schema.org Extra scheme
        // Добавляем дополнительные данные Schema.org
        SchemaHelper::getInstance()->addChild('root', 'person', ['name' => 'John']);

        // Check anything for execute plugin for certain conditions
        // Проверяем какое-либо условие, потому что следующий код исполнится и добавит указанный тип schema.org и все типы Meta в соответствии с переданными данными
        if ($this->app->input->get('option') != 'com_example')
        {
            return;
        }

        if ($schemaObject)
        {
            // Добавляем тип SoftwareApplication в соответствии с переданными в объекте данными
            $schemaData = TypesHelper::execute('schema', 'SoftwareApplication', $schemaObject);
            SchemaHelper::getInstance()->addChild('root', $schemaData);
        }

        // Get and set opengraph data
        $metaObject  = $this->helper->getMetaObject();

        if ($metaObject)
        {
            // Получаем все коллекции Meta
            $collections = PathHelper::getInstance()->getTypes('meta');

            // Добавляем все коллекции Meta в соответствии с переданными в объекте данными
            foreach ($collections as $collection)
            {
                $ogData = TypesHelper::execute('meta', $collection, $metaObject);
                OGHelper::getInstance()->addChild('root', $ogData);
            }
        }

        return;
    }
}
