<?php

namespace I95dev\FinalProject\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{

    protected $storeManager;

    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory
    ) {
        $this->storeManager = $storeManager;
        $this->categoryFactory = $categoryFactory;
    }

    /**
     * Installs data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $this->createCategory();
    }

    public function createCategory()
    {
        // Setting the Category Name
        $categoryName = 'I95Category';
        
        //Getting the root category
        $parentId = $this->storeManager->getStore()->getRootCategoryId();
        $parentCategory = $this->categoryFactory->create()->load($parentId);
    

        $category = $this->categoryFactory->create();

        // $parentCategory = $category->getParentCategory();

        //Getting the category if the category is already exits
        $getcategory = $category->getCollection()
            ->addAttributeToFilter('name', $categoryName)
            ->getFirstItem();

        //Checking wheather the category is already exits or not
        //If it not exists add it
        if (!$getcategory->getId()) {
            $category->setPath($parentCategory->getPath())
                ->setParentId($parentId)
                ->setName($categoryName)
                ->setIsActive(true);
            $category->save();
        }
        
    }
}