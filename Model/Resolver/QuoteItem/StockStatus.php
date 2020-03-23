<?php
/**
 * Mageplaza
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Mageplaza.com license that is
 * available through the world-wide-web at this URL:
 * https://www.mageplaza.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Mageplaza
 * @package     Mageplaza_StockStatusGraphQl
 * @copyright   Copyright (c) Mageplaza (https://www.mageplaza.com/)
 * @license     https://www.mageplaza.com/LICENSE.txt
 */

declare(strict_types=1);

namespace Mageplaza\StockStatusGraphQl\Model\Resolver\QuoteItem;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Mageplaza\StockStatus\Helper\Data;
use Mageplaza\StockStatus\Model\Config\Source\PageType;
use Mageplaza\StockStatus\Model\Config\Source\StatusFormat;
use Magento\Quote\Model\Quote\Item as QuoteItem;

/**
 * Class StockStatus
 * @package Mageplaza\StockStatusGraphQl\Model\Resolver\QuoteItem
 */
class StockStatus implements ResolverInterface
{
    /**
     * @var Data
     */
    protected $helperData;

    /**
     * StockStatus constructor.
     * @param Data $helperData
     */
    public function __construct(Data $helperData)
    {
        $this->helperData = $helperData;
    }

    /**
     * @inheritdoc
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        if (!$this->helperData->isEnabled()) {
            return [];
        }

        if (!isset($value['model'])) {
            throw new LocalizedException(__('"model" value should be specified'));
        }

        /** @var QuoteItem $quoteItem */
        $quoteItem = $value['model'];

        $status         = [StatusFormat::LABEL_IMAGE, StatusFormat::IMAGE_LABEL];
        $imageAvailable = array_merge($status, [StatusFormat::ONLY_IMAGE]);
        $textAvailable  = array_merge($status, [StatusFormat::ONLY_LABEL]);
        $format         = (int)$this->helperData->getStatusFormat();

        $product   = $this->helperData->getProductData($quoteItem->getProduct());
        $isDisplay = $this->helperData->isDisplayStatus(
            $product->isAvailable(),
            PageType::SHOPPING_CART
        );
        $result    = [];
        if ($isDisplay) {
            $stockStatus = $this->helperData->getStatus($product, false);

            if ($stockStatus['image'] && in_array($format, $imageAvailable, true)) {
                $result['image'] = $stockStatus['image'];
            }

            if ($stockStatus['label'] && in_array($format, $textAvailable, true)) {
                $result['label'] = $stockStatus['label'];
            }
        }

        return $result;
    }
}
