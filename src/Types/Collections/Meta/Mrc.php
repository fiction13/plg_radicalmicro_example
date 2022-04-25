<?php
/*
 * @package   plg_radicalmicro_example
 * @version   1.0.0
 * @author    Dmitriy Vasyukov - https://fictionlabs.ru
 * @copyright Copyright (c) 2022 Fictionlabs. All rights reserved.
 * @license   GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link      https://fictionlabs.ru/
 */

namespace RadicalMicro\Types\Collections\Meta;

defined('_JEXEC') or die;

use RadicalMicro\Helpers\UtilityHelper;
use RadicalMicro\Types\InterfaceTypes;

class Mrc implements InterfaceTypes
{
    /**
     * @var string
     * @since 1.0.0
     */
    private $uid = 'radicalmicro.meta.mrc';

    /**
     * @param $item
     * @param $priority
     *
     * @return array
     *
     * @since 1.0.0
     */
    public function execute($item, $priority)
    {
        $item = (object) array_merge($this->getConfig(), (array) $item);

        $data['uid']                    = $this->uid;
        $data['mrc__share_title']       = $item->title;
        $data['mrc__share_description'] = $item->description ? UtilityHelper::prepareText($item->description, 200) : '';

        return $data;
    }

    /**
     * Get config for JForm and YOOtheme Pro elements
     *
     * @param   bool  $addUid
     *
     * @return string[]
     *
     * @since 1.0.0
     */
    public function getConfig($addUid = true)
    {
        $config = [
            'title'       => '',
            'description' => '',
        ];

        if ($addUid)
        {
            $config['uid'] = $this->uid;
        }

        return $config;
    }

}