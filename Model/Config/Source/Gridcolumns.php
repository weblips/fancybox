<?php
/* Wise fancy box designer */
namespace Wise\Fancy\Model\Config\Source;

class Gridcolumns implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 1, 'label' => 1],
            ['value' => 2, 'label' => 2],
            ['value' => 3, 'label' => 3],
            ['value' => 4, 'label' => 4],
            ['value' => 5, 'label' => 5],
            ['value' => 6, 'label' => 6]
        ];
    }
}
