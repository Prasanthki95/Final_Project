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
        //Getting the value from function and returning with result
        return $this->getParentCategory(). " - ".$result;
    }

    public function getParentCategory()
    {
        $category = $this->_registry->registry('current_category');//get current category
        $parentcategories = $category -> getParentCategories(); //get parent categories of current category

        foreach ($parentcategories as $parent) {
            //Getting category in Level 2 
            if ($parent->getLevel() == 2) {
                // returns the level 2 category Name;
                return $parent->getName();
            }
        }
        return NULL;
    }

}