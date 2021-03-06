<?php
namespace BPashkevich\CategoriesContainingA\Block;

class CategoriesContainingA extends \Magento\Framework\View\Element\Template
{
    private $categoryCollection;
    private $storeManager;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollection,
        array $data = []
    )
    {
        $this->categoryCollection = $categoryCollection;
        $this->storeManager = $storeManager;
        parent::__construct($context, $data);
    }

    public function getCategoryCollection($letter)
    {
        $collection = $this->categoryCollection->create()
            ->addNameToResult()
            ->setStore($this->storeManager->getStore())
            ->addAttributeToFilter('is_active','1')
            ->addAttributeToFilter('name', ['like' => '%' . $letter . '%']);

        return $collection;
    }
}