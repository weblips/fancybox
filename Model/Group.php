<?php
/* Wise fancy box designer */
namespace Wise\Fancy\Model;

use Magento\Framework\DataObject\IdentityInterface;

/**
 * Brand Model
 */
class Group extends \Magento\Framework\Model\AbstractModel
{	
	/**
	 * Brand's Statuses
	 */
	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 0;

    /**
     * Product collection factory
     *
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     */
    protected $_productCollectionFactory;

    /** @var \Magento\Store\Model\StoreManagerInterface */
    protected $_storeManager;

    /**
     * URL Model instance
     *
     * @var \Magento\Framework\UrlInterface
     */
    protected $_url;

    protected $_scopeConfig;

    /**
     * @var \Magento\Catalog\Helper\Category
     */
    protected $_brandHelper;

    /**
     * @param \Magento\Framework\Model\Context                          $context                  
     * @param \Magento\Framework\Registry                               $registry                 
     * @param \Magento\Store\Model\StoreManagerInterface                $storeManager             
     * @param \Wise\Fancy\Model\ResourceModel\Group|null                      $resource                 
     * @param \Wise\Fancy\Model\ResourceModel\Group\Collection|null           $resourceCollection       
     * @param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory 
     * @param \Magento\Store\Model\StoreManagerInterface                $storeManager             
     * @param \Magento\Framework\UrlInterface                           $url                      
     * @param \Magento\Framework\App\Config\ScopeConfigInterface        $scopeConfig              
     * @param array                                                     $data                     
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Wise\Fancy\Model\ResourceModel\Group $resource = null,
        \Wise\Fancy\Model\ResourceModel\Group\Collection $resourceCollection = null,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\UrlInterface $url,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        array $data = []
        ) {
        $this->_storeManager = $storeManager;
        $this->_url = $url;
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_scopeConfig = $scopeConfig;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

	/**
     * Initialize customer model
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('Wise\Fancy\Model\ResourceModel\Group');
    }

    /**
     * Prepare page's statuses.
     * Available event cms_page_get_available_statuses to customize statuses.
     *
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }

    public function getUrl()
    {
        $url = $this->_storeManager->getStore()->getBaseUrl();
        $store = $this->_storeManager->getStore();
        $route = $this->_scopeConfig->getValue(
            'wisefancy/general_settings/route',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store);
        $url_prefix = $this->_scopeConfig->getValue(
            'wisefancy/general_settings/url_prefix',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store);
        $url_suffix = $this->_scopeConfig->getValue(
            'wisefancy/general_settings/url_suffix',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store);
        $urlPrefix = '';
        if($url_prefix){
            $urlPrefix = $url_prefix.'/';
        }
        return $url.$urlPrefix.$this->getUrlKey().$url_suffix;
    }
}