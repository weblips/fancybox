<?php
/* Wise fancy box designer */
namespace Wise\Fancy\Model\ResourceModel\Group;

use \Wise\Fancy\Model\ResourceModel\AbstractCollection;
/**
 * Brand collection
 */
class Collection extends AbstractCollection
{

	/**
     * @var string
     */
	protected $_idFieldName = 'group_id';

	/**
     * Define resource model
     *
     * @return void
     */
	protected function _construct()
	{
		$this->_init('Wise\Fancy\Model\Group', 'Wise\Fancy\Model\ResourceModel\Group');
		$this->_map['fields']['group_id'] = 'main_table.group_id';
	}

    /**
     * Add filter by store
     *
     * @param int|array|\Magento\Store\Model\Store $store
     * @param bool $withAdmin
     * @return $this
     */
    public function addStoreFilter($store, $withAdmin = true)
    {
        if (!$this->getFlag('store_filter_added')) {
            $this->performAddStoreFilter($store, $withAdmin);
        }
        return $this;
    }
}