<?php
/* Wise fancy box designer */
namespace Wise\Fancy\Model\Config\Source;

class Brandlistlayout implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [['value' => 'list', 'label' => __('List')], ['value' => 'grid', 'label' => __('Grid')]];
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return [0 => __('No'), 1 => __('Yes')];
    }
}
