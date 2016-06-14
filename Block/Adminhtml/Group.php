<?php
/* Wise fancy box designer */
namespace Wise\Fancy\Block\Adminhtml;

/**
 * Adminhtml cms pages content block
 */
class Group extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Block constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_brandgroup';
        $this->_blockGroup = 'Wise_Fancy';
        $this->_headerText = __('Manage Fancy Box Groups');

        parent::_construct();

        if ($this->_isAllowedAction('Wise_Fancy::group_edit')) {
            $this->buttonList->update('add', 'label', __('Add New Group'));
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
