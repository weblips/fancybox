<?php
/* Wise fancy box designer */
namespace Wise\Fancy\Block\Adminhtml;

/**
 * Adminhtml cms pages content block
 */
class Brand extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Block constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_brand';
        $this->_blockGroup = 'Wise_Fancy';
        $this->_headerText = __('Manage Box');

        parent::_construct();

        if ($this->_isAllowedAction('Wise_Fancy::brand_save')) {
            $this->buttonList->update('add', 'label', __('Add New Fancy Box Designer'));
        } else {
            $this->buttonList->remove('add');
        }
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
