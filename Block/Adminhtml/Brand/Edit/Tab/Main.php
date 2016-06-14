<?php
/* Wise fancy box designer */
namespace Wise\Fancy\Block\Adminhtml\Brand\Edit\Tab;

class Main extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
	/**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $_wysiwygConfig;

    /**
     * @var \Wise\Fancy\Helper\Data
     */
    protected $_viewHelper;

    /**
     * @param \Magento\Backend\Block\Template\Context $context       
     * @param \Magento\Framework\Registry             $registry      
     * @param \Magento\Framework\Data\FormFactory     $formFactory   
     * @param \Magento\Store\Model\System\Store       $systemStore   
     * @param \Magento\Cms\Model\Wysiwyg\Config       $wysiwygConfig 
     * @param \Wise\Fancy\Helper\Data                  $viewHelper    
     * @param array                                   $data          
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Wise\Fancy\Helper\Data $viewHelper,
        array $data = []
    ) {
        $this->_viewHelper = $viewHelper;
        $this->_systemStore = $systemStore;
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }


    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm(){
    	/** @var $model \Wise\Fancy\Model\Brand */
    	$model = $this->_coreRegistry->registry('Wise_Fancy');

    	/**
    	 * Checking if user have permission to save information
    	 */
    	if($this->_isAllowedAction('Wise_Fancy::brand_edit')){
    		$isElementDisabled = false;
    	}else {
    		$isElementDisabled = true;
    	}

    	/** @var \Magento\Framework\Data\Form $form */
    	$form = $this->_formFactory->create();

    	$form->setHtmlIdPrefix('brand_');

    	$fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Fancy Box Designer Information : ')]);


    	if ($model->getId()) {
    		$fieldset->addField('brand_id', 'hidden', ['name' => 'brand_id']);
    	}

    	$fieldset->addField(
    		'name',
    		'text',
    		[
	    		'name' => 'name',
	    		'label' => __('Box Name'),
	    		'title' => __('Box Name'),
	    		'required' => true,
	    		'disabled' => $isElementDisabled
    		]
    		);

    	$fieldset->addField(
    		'url_key',
    		'text',
    		[
	    		'name' => 'url_key',
	    		'label' => __('URL Key'),
	    		'title' => __('URL Key'),
                'note' => __('Empty to auto create url key'),
	    		'disabled' => $isElementDisabled
    		]
    		);

        $fieldset->addField(
            'group_id',
            'select',
            [
                'label' => __('Box Group'),
                'title' => __('Box Group'),
                'name' => 'group_id',
                'options' => $this->_viewHelper->getGroupList(),
                'disabled' => $isElementDisabled
            ]
        );

    	$fieldset->addField(
    		'image',
    		'image',
    		[
	    		'name' => 'image',
	    		'label' => __('Image'),
	    		'title' => __('Image'),
	    		'disabled' => $isElementDisabled
    		]
    		);

    	$fieldset->addField(
    		'thumbnail',
    		'image',
    		[
	    		'name' => 'thumbnail',
	    		'label' => __('Thumbnail'),
	    		'title' => __('Thumbnail'),
	    		'disabled' => $isElementDisabled
    		]
    		);

    	$wysiwygDescriptionConfig = $this->_wysiwygConfig->getConfig(['tab_id' => $this->getTabId()]);

    	$fieldset->addField(
            'description',
            'editor',
            [
                'name' => 'description',
                'style' => 'height:200px;',
                'label' => __('Description'),
    			'title' => __('Description'),
                'disabled' => $isElementDisabled,
                'config' => $wysiwygDescriptionConfig
            ]
        );

    	/**
         * Check is single store mode
         */
        if (!$this->_storeManager->isSingleStoreMode()) {
            $field = $fieldset->addField(
                'store_id',
                'multiselect',
                [
                    'name' => 'stores[]',
                    'label' => __('Store View'),
                    'title' => __('Store View'),
                    'required' => true,
                    'values' => $this->_systemStore->getStoreValuesForForm(false, true),
                    'disabled' => $isElementDisabled
                ]
            );
            $renderer = $this->getLayout()->createBlock(
                'Magento\Backend\Block\Store\Switcher\Form\Renderer\Fieldset\Element'
            );
            $field->setRenderer($renderer);
        } else {
            $fieldset->addField(
                'store_id',
                'hidden',
                ['name' => 'stores[]', 'value' => $this->_storeManager->getStore(true)->getId()]
            );
            $model->setStoreId($this->_storeManager->getStore(true)->getId());
        }


        $fieldset->addField(
    		'position',
    		'text',
    		[
	    		'name' => 'position',
	    		'label' => __('Position'),
	    		'title' => __('Position'),
	    		'disabled' => $isElementDisabled
    		]
    		);

        $fieldset->addField(
            'status',
            'select',
            [
                'label' => __('Status'),
                'title' => __('Page Status'),
                'name' => 'status',
                'options' => $model->getAvailableStatuses(),
                'disabled' => $isElementDisabled
            ]
        );


    	$form->setValues($model->getData());
    	$this->setForm($form);

    	return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Fancy Box Designer Information');
    }

    /**
     * Prepare title for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Fancy Box Designer Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
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