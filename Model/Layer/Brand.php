<?php
/* Wise fancy box designer */
namespace Wise\Fancy\Model\Layer;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Model\Resource;

class Brand extends \Magento\Catalog\Model\Layer
{
    /**
     * Retrieve current layer product collection
     *
     * @return \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    public function getProductCollection()
    {
    	$brand = $this->getCurrentBrand();
    	if(isset($this->_productCollections[$brand->getId()])){
    		$collection = $this->_productCollections;
    	}else{
    		$collection = $brand->getProductCollection();
    		$this->prepareProductCollection($collection);
            $this->_productCollections[$brand->getId()] = $collection;
    	} 
    	return $collection;
    }

    /**
     * Retrieve current category model
     * If no category found in registry, the root will be taken
     *
     * @return \Magento\Catalog\Model\Category
     */
    public function getCurrentBrand()
    {
    	$brand = $this->getData('current_brand');
    	if ($brand === null) {
    		$brand = $this->registry->registry('current_brand');
    		if ($brand) {
    			$this->setData('current_brand', $brand);
    		}
    	}
    	return $brand;
    }
}