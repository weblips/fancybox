<?php
/* Wise fancy box designer */
namespace Wise\Fancy\Controller\Adminhtml\Brand;

class Products extends \Magento\Catalog\Controller\Adminhtml\Product
{
    /**
     * @var \Magento\Framework\View\Result\LayoutFactory
     */
    protected $resultLayoutFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Catalog\Controller\Adminhtml\Product\Builder $productBuilder
     * @param \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Catalog\Controller\Adminhtml\Product\Builder $productBuilder,
        \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory
    ) {
        parent::__construct($context, $productBuilder);
        $this->resultLayoutFactory = $resultLayoutFactory;
    }

    /**
     * @return \Magento\Framework\View\Result\Layout
     */
    public function execute()
    {
        $id = $this->getRequest()->getparam('brand_id');
        $brand = $this->_objectManager->create('Wise\Fancy\Model\Brand');
        $brand->load($id);
        $registry = $this->_objectManager->get('Magento\Framework\Registry');
        $registry->register("current_brand", $brand);

        $this->productBuilder->build($this->getRequest());
        $resultLayout = $this->resultLayoutFactory->create();
        $resultLayout->getLayout()->getBlock('brand.edit.tab.products')->setProductsRelated($this->getRequest()->getPost('products', null));
        return $resultLayout;
    }
}
