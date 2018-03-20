<?php
namespace BPashkevich\ReviewsCount\Block;

class ReviewsCount extends \Magento\Framework\View\Element\Template
{
    private $registry;
    private $reviewFactory;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Review\Model\ReviewFactory $reviewFactory,
        array $data = []
    )
    {
        $this->reviewFactory = $reviewFactory;
        $this->registry = $registry;
        parent::__construct($context, $data);
    }

    private function getCurrentProduct()
    {
        return $this->registry->registry('current_product');
    }


    public function getReviewsCount()
    {
        $product = $this->getCurrentProduct();
        if (!$product->getRatingSummary()) {
            $this->reviewFactory->create()->getEntitySummary($product, $this->_storeManager->getStore()->getId());
        }

        return $product->getRatingSummary()->getReviewsCount();
    }
}