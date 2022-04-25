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
use Joomla\Registry\Registry;


/**
 * @package     pkg_radicalmicro
 *
 * @since       1.0.0
 */
class plgRadicalMicroExampleHelper
{
    /**
     * @var array
     *
     * @since 1.0.0
     */
    protected $params = [];

    /**
     * @var array
     *
     * @since 1.0.0
     */
    protected $fields = array();

    /**
     * @var
     * @since 1.0.0
     */
    protected $item;

    /**
     * @param   Registry  $params
     *
     * @throws Exception
     */
    public function __construct(Registry $params)
    {
        $this->params = $params;
        $this->app    = Factory::getApplication();
    }

    /**
     * Method get provider data
     *
     * @return void|object
     *
     * @since 1.0.0
     */
    public function getSchemaObject()
    {
        // Data object
        // Создаем объект с данными
        $object                  = new stdClass();
        $object->title           = 'Angry Birds';
        $object->operatingSystem = 'ANDROID';
        $object->ratingValue     = '4.6';
        $object->ratingCount     = '8864';
        $object->price           = '1.00';
        $object->priceCurrency   = 'USD';

        return $object;
    }

    /**
     * Method get provider data
     *
     * @return void|object
     *
     * @since 1.0.0
     */
    public function getMetaObject()
    {
        // Data object
        // Создаем объект с данными
        $object              = new stdClass();
        $object->title       = 'Angry Birds';
        $object->description = 'Angry Birds application';

        return $object;
    }
}