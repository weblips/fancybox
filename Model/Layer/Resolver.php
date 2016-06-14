<?php
/* Wise fancy box designer */
namespace Wise\Fancy\Model\Layer;

class Resolver extends \Magento\Catalog\Model\Layer\Resolver
{
	/**
     * Get current Catalog Layer
     *
     * @return \Magento\Catalog\Model\Layer
     */
    public function get()
    {
        if (!isset($this->layer)) {
            $this->layer = $this->objectManager->create($this->layersPool['category']);
        }
        return $this->layer;
    }
}