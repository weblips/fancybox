<?php
/* Wise fancy box designer */
namespace Wise\Fancy\Model\Source;
use Magento\Framework\Data\OptionSourceInterface;

class IsActive implements OptionSourceInterface
{
	/**
	 * @var \Wise\Fancy\Model\Brand
	 */
	protected $brandModel;

	/**
     * Constructor
     *
     * @param \Wise\Fancy\Model\Brand $brandModel
     */
	public function __construct(\Wise\Fancy\Model\Brand $brandModel)
	{
		$this->brandModel = $brandModel;
	}

	/**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options[] = ['label' => '', 'value' => ''];
        $availableOptions = $this->brandModel->getAvailableStatuses();

        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
 
        return $options;
    }
}