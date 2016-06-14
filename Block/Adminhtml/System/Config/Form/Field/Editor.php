<?php
/* Wise fancy box designer */
namespace Wise\Fancy\Block\Adminhtml\System\Config\Form\Field;

class Editor extends \Magento\Config\Block\System\Config\Form\Field
{
	/**
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $_wysiwygConfig;

	/**
     * @param \Magento\Backend\Block\Template\Context $context       
     * @param \Magento\Cms\Model\Wysiwyg\Config       $wysiwygConfig 
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig
        ) {
    	$this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context);
    }

    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
    	$config = $this->_wysiwygConfig->getConfig();
        $element->setWysiwyg(true);
        $element->setConfig($config);
        return parent::_getElementHtml($element);
    }
}