<?php
/* Wise fancy box designer */
namespace Wise\Fancy\Block;

class GroupList extends \Magento\Framework\View\Element\Template
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @var \Wise\Fancy\Helper\Data
     */
    protected $_brandHelper;

    /**
     * @var \Wise\Fancy\Model\Brand
     */
    protected $_group;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context      
     * @param \Magento\Framework\Registry                      $registry     
     * @param \Wise\Fancy\Helper\Data                           $brandHelper  
     * @param \Wise\Fancy\Model\Group                           $group        
     * @param \Magento\Store\Model\StoreManagerInterface       $storeManager 
     * @param \Wise\Fancy\Helper\Data                           $brandHelper  
     * @param array                                            $data         
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Wise\Fancy\Helper\Data $brandHelper,
        \Wise\Fancy\Model\Group $group,
        \Wise\Fancy\Helper\Data $brandHelper,
        array $data = []
        ) {
        $this->_group = $group;
        $this->_coreRegistry = $registry;
        $this->_brandHelper = $brandHelper;
        parent::__construct($context, $data);
    }

    public function _construct()
    {
        if(!$this->getConfig('general_settings/enable')) return;
        parent::_construct();
    }

    public function getGroupList(){
        $collection = $this->_group->getCollection()
        ->addFieldToFilter('status',1)
        ->addFieldToFilter('shown_in_sidebar',1)
        ->setOrder('position','ASC');
        return $collection;
    }
}