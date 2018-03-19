<?php
namespace BPashkevich\ReviewsCount\Block;

class ReviewsCount extends \Magento\Catalog\Block\Product\View\AbstractView
{

    protected $_reviewFactory;

    /**
     * @param \Magento\Catalog\Block\Product\Context $context
     * @param \Magento\Framework\Stdlib\ArrayUtils $arrayUtils
     * @param array $data
     */
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Framework\Stdlib\ArrayUtils $arrayUtils,
        \Magento\Review\Model\ReviewFactory $reviewFactory,
        array $data = []
    ) {
        $this->_reviewFactory = $reviewFactory;
        $this->arrayUtils = $arrayUtils;
        parent::__construct(
            $context,
            $arrayUtils,
            $data
        );
    }


    public function getReviewsCount()
    {
        if (!$this->getProduct()->getRatingSummary()) {
            $this->_reviewFactory->create()->getEntitySummary($this->getProduct(), $this->_storeManager->getStore()->getId());
        }

        return $this->getProduct()->getRatingSummary()->getReviewsCount();
    }
}