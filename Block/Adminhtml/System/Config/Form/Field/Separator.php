<?php
/* Wise fancy box designer */
namespace Wise\Fancy\Block\Adminhtml\System\Widget\Form\Renderer;

use Magento\Framework\Data\Form\Element\AbstractElement;

/**
 * Form element default renderer
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Separator extends \Magento\Backend\Block\Template implements \Magento\Framework\Data\Form\Element\Renderer\RendererInterface
{
    public function render(AbstractElement $element)
    {
        $this->_element = $element;
        return $this->toHtml();
    }
}