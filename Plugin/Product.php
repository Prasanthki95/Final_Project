<?php

namespace I95dev\FinalProject\Plugin;

class Product{

    /**
     * @param \Magento\Framework\Registry $registry
     */

    protected $_registry;

    public function __construct(
        \Magento\Framework\Registry $registry
    ) {
        $this->_registry = $registry;
    }

    public function afterGetName(
        \Magento\Catalog\Model\Product $subject,
        $result
    )
    {
        $category = $this->_registry->registry('current_category');//get current category
        return $category->getName(). " - ".$result;
    }

}