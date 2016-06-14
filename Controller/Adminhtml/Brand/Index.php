<?php
/* Wise fancy box designer */
namespace Wise\Fancy\Controller\Adminhtml\Brand;

class Index extends \Wise\Fancy\Controller\Adminhtml\Brand
{
	/**
     * Check the permission to run it
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Wise_Fancy::brand');
    }

	/**
	 * Brand list action
	 *
	 * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Forward
	 */
	public function execute()
	{

		$resultPage = $this->resultPageFactory->create();

		/**
		 * Set active menu item
		 */
		$resultPage->setActiveMenu("Wise_Fancy::brand");
		$resultPage->getConfig()->getTitle()->prepend(__('Fancy Box Designer'));

		/**
		 * Add breadcrumb item
		 */
		$resultPage->addBreadcrumb(__('Fancy Box Designer'),__('Fancy Box Designer'));
		$resultPage->addBreadcrumb(__('Manage Fancy Box Designer'),__('Manage Fancy Box Designer'));

		return $resultPage;
	}
	
}