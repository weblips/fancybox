<?php
/* Wise fancy box designer */
namespace Wise\Fancy\Observer;

use Magento\Framework\Event\ObserverInterface;

class SaveProductBrand implements ObserverInterface
{
    /**
     * Catalog data
     *
     * @var \Magento\Catalog\Helper\Data
     */
    protected $catalogData;

    /**
     * @var \Magento\Framework\App\ResourceConnection
     */
    protected $_resource;

    /**
     * @param \Magento\Catalog\Helper\Data $catalogData
     */
    public function __construct(
        \Magento\Framework\App\ResourceConnection $resource
        )
    {
        $this->_resource = $resource;
    }

    /**
     * Checking whether the using static urls in WYSIWYG allowed event
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $connection = $this->_resource->getConnection();
        $table_name = $this->_resource->getTableName('Wise_Fancy_product');
        $productController = $observer->getController();
        $productId = $productController->getRequest()->getParam('id');
        $data = $productController->getRequest()->getPostValue();

        if(isset($data['product']['product_brand'])){
        $connection->query('DELETE FROM ' . $table_name . ' WHERE product_id =  ' . $productId . ' ');
        $productBrands = $data['product']['product_brand'];
        foreach ($productBrands as $k => $v) {
            $connection->query('INSERT INTO ' . $table_name . ' VALUES ( ' . $v . ', ' . $productId . ',0)');
        }
        $product = $observer->getProduct();
        $connection = $this->_resource->getConnection();
        $table_name = $this->_resource->getTableName('Wise_Fancy_product');
        }
    }
}
