<?php
/*
 * @package   plg_radicalmicro_example
 * @version   1.0.0
 * @author    Dmitriy Vasyukov - https://fictionlabs.ru
 * @copyright Copyright (c) 2022 Fictionlabs. All rights reserved.
 * @license   GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link      https://fictionlabs.ru/
 */

namespace RadicalMicro\Types\Collections\Schema\Extra;

defined('_JEXEC') or die;

use RadicalMicro\Types\InterfaceTypes;

class Person implements InterfaceTypes
{
    /**
     * @var string
     * @since 1.0.0
     */
    private $uid = 'radicalmicro.schema.person';

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
        if (is_array($item))
        {
            $item = (object) $item;
        }

        $data = [
            'uid'      => $this->uid,
            '@context' => 'https://schema.org',
            '@type'    => 'Person',
            'name'     => $item->name ?? ''
        ];

        return $data;
    }

    /**
     * Get config for JForm and Yootheme Pro elements
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
            'name' => ''
        ];

        if ($addUid)
        {
            $config['uid'] = $this->uid;
        }

        return array();
    }

}