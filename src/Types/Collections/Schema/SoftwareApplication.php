<?php
/*
 * @package   plg_radicalmicro_example
 * @version   1.0.0
 * @author    Dmitriy Vasyukov - https://fictionlabs.ru
 * @copyright Copyright (c) 2022 Fictionlabs. All rights reserved.
 * @license   GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link      https://fictionlabs.ru/
 */

namespace RadicalMicro\Types\Collections\Schema;

defined('_JEXEC') or die;

use Joomla\CMS\Uri\Uri;
use RadicalMicro\Helpers\UtilityHelper;
use RadicalMicro\Types\InterfaceTypes;

/**
 * @package     RadicalMicro\Types\Collections\Schema
 *
 * @source      https://developers.google.com/search/docs/advanced/structured-data/article
 *
 * @since       1.0.0
 */
class SoftwareApplication implements InterfaceTypes
{
    /**
     * @var string
     * @since 1.0.0
     */
    private $uid = 'radicalmicro.schema.page';

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

        $data = [
            'uid'              => $this->uid,
            '@context'         => 'https://schema.org',
            '@type'            => 'SoftwareApplication',
            'name'             => $item->title,
            'operatingSystem'  => $item->operatingSystem ?? '',
            'aggregateRating' => [
                '@type'       => 'AggregateRating',
                'ratingValue' => $item->ratingValue,
                'ratingCount' => $item->ratingCount
            ],
            'offers' => [
                '@type'         => 'Offer',
                'price'         => $item->price,
                'priceCurrency' => $item->priceCurrency
            ]
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
            'title'           => '',
            'operatingSystem' => '',
            'ratingValue'     => '',
            'ratingCount'     => '',
            'price'           => '',
            'priceCurrency'   => ''
        ];

        if ($addUid)
        {
            $config['uid'] = $this->uid;
        }

        return $config;
    }

}