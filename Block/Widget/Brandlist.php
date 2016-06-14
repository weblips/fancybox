<?php
/* Wise fancy box designer */
namespace Wise\Fancy\Block\Widget;

class Brandlist extends AbstractWidget
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
     * @var \Magento\Cms\Model\Block
     */
    protected $_blockModel;

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
        \Magento\Cms\Model\Block $blockModel,
        array $data = []
        ) {
        $this->_brandCollection = $brandCollection;
        $this->_brandHelper = $brandHelper;
        $this->_coreRegistry = $registry;
        $this->_blockModel = $blockModel;
        parent::__construct($context, $brandHelper);
    }

    public function getCmsBlockModel(){
        return $this->_blockModel;
    }

    public function _toHtml()
    {
        if(!$this->_brandHelper->getConfig('general_settings/enable')) return;
        $carousel_layout = $this->getConfig('carousel_layout');
        if($carousel_layout == 'owl_carousel'){
            $this->setTemplate('widget/brand_list_owl.phtml');
        }else{
            $this->setTemplate('widget/brand_list_bootstrap.phtml');
        }
        if(($template = $this->getConfig('template')) != ''){
            $this->setTemplate($template);
        }
        return parent::_toHtml();
    }

    public function getBrandCollection()
    {
        $number_item = $this->getConfig('number_item',12);
        $brandGroups = $this->getConfig('brand_groups');
        $collection = $this->_brandCollection->getCollection()
        ->addFieldToFilter('status',1);
        $brandGroups = explode(',', $brandGroups);
        if(is_array($brandGroups))
        {
            $collection->addFieldToFilter('group_id',array('in' => $brandGroups));
        }
        $collection->setPageSize($number_item)
        ->setCurPage(1)
        ->setOrder('position','ASC');
        return $collection;
    }
}