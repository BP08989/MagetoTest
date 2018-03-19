<?php
namespace BPashkevich\CategoriesContainingA\Block;

class CategoriesContainingA extends \Magento\Framework\View\Element\Template
{
    protected $_categoryHelper;

    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Catalog\Helper\Category $categoryHelper,
        array $data = []
    ) {
        $this->_categoryHelper = $categoryHelper;
        parent::__construct(
            $context,
            $data
        );
    }

    /**
     * Retrieve current store level 2 category
     *
     * @param bool|string $sorted (if true display collection sorted as name otherwise sorted as based on id asc)
     * @param bool $asCollection (if true display all category otherwise display second level category menu visible category for current store)
     * @param bool $toLoad
     */

    public function getStoreCategoriesContainingA($sorted = false, $asCollection = false, $toLoad = true)
    {
        $categoriesA = [];

        $categories = $this->_categoryHelper->getStoreCategories($sorted , $asCollection, $toLoad);
        foreach ($categories as $category){
            if(stristr($category->getName(), 'a') != FALSE) {
                $categoriesA[] = $category->getName();
            }
        }
        return $categoriesA;
    }
}