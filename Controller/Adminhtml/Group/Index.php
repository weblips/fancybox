<?php
/* Wise fancy box designer */
namespace Wise\Fancy\Controller\Adminhtml\Group;

class Index extends \Wise\Fancy\Controller\Adminhtml\Group
{
	/**
     * Check the permission to run it
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Wise_Fancy::group');
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
		$resultPage->setActiveMenu("Wise_Fancy::grop");
		$resultPage->getConfig()->getTitle()->prepend(__('Fancy Box Groups'));

		/**
		 * Add breadcrumb item
		 */
		$resultPage->addBreadcrumb(__('Fancy Box'),__('Fancy Box'));
		$resultPage->addBreadcrumb(__('Manage Fancy Box'),__('Manage Fancy Box Groups'));

		return $resultPage;
	}
}