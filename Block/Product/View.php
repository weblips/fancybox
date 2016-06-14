<?php
/* Wise fancy box designer */
namespace Wise\Fancy\Block\Product;
use Magento\Customer\Model\Context as CustomerContext;

class View extends \Magento\Framework\View\Element\Template
{
	/**
     * Group Collection
     */
    protected $_brandCollection;

	/**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @var \Magento\Catalog\Helper\Category
     */
    protected $_brandHelper;

    /**
     * @var \Magento\Framework\App\ResourceConnection
     */
    protected $_resource;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context         
     * @param \Magento\Framework\Registry                      $registry        
     * @param \Wise\Fancy\Helper\Data                           $brandHelper     
     * @param \Wise\Fancy\Model\Brand                           $brandCollection 
     * @param array                                            $data            
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Wise\Fancy\Helper\Data $brandHelper,
        \Wise\Fancy\Model\Brand $brandCollection,
        \Magento\Framework\App\ResourceConnection $resource,
        array $data = []
        ) {
        $this->_brandCollection = $brandCollection;
        $this->_brandHelper = $brandHelper;
        $this->_coreRegistry = $registry;
        $this->_resource = $resource;
        parent::__construct($context, $data); 
    }

    /**
     * Retrieve current product model
     *
     * @return \Magento\Catalog\Model\Product
     */
    public function getProduct()
    {
        return $this->_coreRegistry->registry('current_product');
    }

    public function getBrandCollection(){
    	$product = $this->getProduct();
    	$connection = $this->_resource->getConnection();
        $table_name = $this->_resource->getTableName('Wise_Fancy_product');
        $brandIds = $connection->fetchCol(" SELECT brand_id FROM ".$table_name." WHERE product_id = ".$product->getId());
    	$collection = $this->_brandCollection->getCollection()
        ->setOrder('position','ASC')
        ->addFieldToFilter('status',1);
        //$collection->getSelect()->where('brand_id IN (?)', $brandIds);
        return $collection;
    }

}