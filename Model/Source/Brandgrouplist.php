<?php
/* Wise fancy box designer */
namespace Wise\Fancy\Model\Source;

class Brandgrouplist implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var \Wise\Fancy\Model\Group
     */
    protected  $_group;
    
    /**
     * 
     * @param \Wise\Fancy\Model\Group $group
     */
    public function __construct(
        \Wise\Fancy\Model\Group $group
        ) {
        $this->_group = $group;
    }

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $groups = $this->_group->getCollection()
        ->addFieldToFilter('status', '1');
        $groupList = array();
        foreach ($groups as $group) {
            $groupList[] = array('label' => $group->getName(),
                'value' => $group->getId());
        }
        return $groupList;
    }
}
