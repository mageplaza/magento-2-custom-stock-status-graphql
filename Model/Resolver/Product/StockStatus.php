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

namespace Mageplaza\StockStatusGraphQl\Model\Resolver\Product;

use Magento\Catalog\Model\Product;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Mageplaza\StockStatus\Helper\Data;
use Mageplaza\StockStatus\Model\Config\Source\StatusFormat;

/**
 * Class StockStatus
 * @package Mageplaza\StockStatusGraphQl\Model\Resolver\Product
 */
class StockStatus implements ResolverInterface
{

    /**
     * @var Data
     */
    protected $helperData;

    /**
     * QuoteRepository constructor.
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
    ): array {

        if (!$this->helperData->isEnabled()) {
            return [];
        }

        if (!isset($value['model'])) {
            throw new LocalizedException(__('"model" value should be specified'));
        }

        $result = [];

        /** @var Product $product */
        $product   = $this->helperData->getProductData($value['model']);

        $stockStatus         = $this->helperData->getStatus($product, false);
        if ($product->getTypeId() === Configurable::TYPE_CODE) {
            $result['is_apply_child'] = $this->helperData->isDisplayChildProduct();
        }

        $format = (int)$this->helperData->getStatusFormat();
        $status = [StatusFormat::LABEL_IMAGE, StatusFormat::IMAGE_LABEL];
        if ($stockStatus['image'] && in_array($format, array_merge($status, [StatusFormat::ONLY_IMAGE]), true)) {
            $result['image'] = $stockStatus['image'];
        }

        if ($stockStatus['label'] && in_array($format, array_merge($status, [StatusFormat::ONLY_LABEL]), true)) {
            $result['label'] = $stockStatus['label'];
        }

        return $result;
    }
}
