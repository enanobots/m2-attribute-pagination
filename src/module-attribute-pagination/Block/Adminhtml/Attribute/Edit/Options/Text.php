<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Nanobots\AttributeOptionPager\Block\Adminhtml\Attribute\Edit\Options;

use Magento\Eav\Model\Entity\Attribute\AbstractAttribute;
use Magento\Eav\Model\ResourceModel\Entity\Attribute\Option\Collection;
use Magento\Swatches\Block\Adminhtml\Attribute\Edit\Options\Text as BaseText;
/**
 * Block Class for Text Swatch
 *
 * @api
 * @since 100.0.2
 */
class Text extends BaseText
{
    /** @var int  */
    public const DEFAULT_PAGE = 1;

    /** @var int  */
    public const DEFAULT_LIMIT = 20;

    /** @var int[]  */
    public const LIMIT = [20, 30, 50, 100, 200];

    /** @var string  */
    protected $_template = 'Nanobots_AttributeOptionPager::catalog/product/attribute/text.phtml';

    /**
     * Retrieve option values collection
     *
     * It is represented by an array in case of system attribute
     *
     * @param AbstractAttribute $attribute
     * @return array|Collection
     */
    protected function _getOptionValuesCollection(AbstractAttribute $attribute)
    {
        if ($this->canManageOptionDefaultOnly()) {
            return $this->_universalFactory->create(
                $attribute->getSourceModel()
            )->setAttribute(
                $attribute
            )->getAllOptions();
        } else {
            return $this->_attrOptionCollectionFactory->create()->setAttributeFilter(
                $attribute->getId()
            )->setPositionOrder(
                'asc',
                true
            )->setPageSize($this->getRequest()->getParam('limit') ?? self::DEFAULT_LIMIT)
                ->setCurPage($this->getRequest()->getParam('page') ?? self::DEFAULT_PAGE)
                ->load();
        }
    }

    /**
     * Preparing values of attribute options
     *
     * @param AbstractAttribute $attribute
     * @param array|Collection $optionCollection
     * @return array
     */
    protected function _prepareOptionValues(
        AbstractAttribute $attribute,
        $optionCollection
    ): array
    {
        $type = $attribute->getFrontendInput();
        if ($type === 'select' || $type === 'multiselect') {
            $defaultValues = explode(',', $attribute->getDefaultValue() ?? '');
            $inputType = $type === 'select' ? 'radio' : 'checkbox';
        } else {
            $defaultValues = [];
            $inputType = '';
        }

        $values = [];
        $isSystemAttribute = is_array($optionCollection);
        if ($isSystemAttribute) {
            $values = $this->getPreparedValues($optionCollection, $isSystemAttribute, $inputType, $defaultValues);
        } else {
            $optionCollection->setPageSize($this->getRequest()->getParam('limit'));
            $values = array_merge(
                $values,
                $this->getPreparedValues($optionCollection, $isSystemAttribute, $inputType, $defaultValues)
            );
        }

        return $values;
    }


    /**
     * @param array|Collection $optionCollection
     * @param bool $isSystemAttribute
     * @param string $inputType
     * @param array $defaultValues
     * @return array
     */
    private function getPreparedValues(
        $optionCollection,
        bool $isSystemAttribute,
        string $inputType,
        array $defaultValues
    ): array
    {
        $values = [];
        foreach ($optionCollection as $option) {
            $bunch = $isSystemAttribute ? $this->_prepareSystemAttributeOptionValues(
                $option,
                $inputType,
                $defaultValues
            ) : $this->_prepareUserDefinedAttributeOptionValues(
                $option,
                $inputType,
                $defaultValues
            );
            foreach ($bunch as $value) {
                $values[] = new \Magento\Framework\DataObject($value);
            }
        }

        return $values;
    }

    /**
     * @return array|mixed|null
     */
    public function getOptionValues()
    {
        $values = $this->_getData('option_values');
        if ($values === null) {
            $values = [];

            $attribute = $this->getAttributeObject();
            $optionCollection = $this->_getOptionValuesCollection($attribute);
            if ($optionCollection) {
                $values = $this->_prepareOptionValues($attribute, $optionCollection);
            }

            $this->setData('option_values', $values);
        }

        return $values;
    }

    /**
     * @return int
     */
    public function getCurrentPageNumber(): int
    {
        if ($this->getRequest()->getParam('page')) {
            return (int)$this->getRequest()->getParam('page');
        }
        return self::DEFAULT_PAGE;
    }

    /**
     * @return int
     */
    public function getCurrentPageSize(): int
    {
        if ($this->getRequest()->getParam('limit')) {
            return (int)$this->getRequest()->getParam('limit');
        }
        return self::DEFAULT_LIMIT;
    }

    /**
     * @return int[]
     */
    public function getLimits(): array
    {
        return self::LIMIT;
    }

    /**
     * @return int
     */
    public function getMaxPageCount(): int
    {
        $attribute = $this->getAttributeObject();
        return $this->_attrOptionCollectionFactory->create()->setAttributeFilter(
            $attribute->getId()
        )->setPageSize($this->getRequest()->getParam('limit') ?? self::DEFAULT_LIMIT)
            ->getLastPageNumber();

    }

    /**
     * @param int $limit
     * @param int $pageNumber
     * @return string
     */
    public function getNextUrl(int $limit, int $pageNumber): string
    {
        $requestParams = $this->getRequest()->getParams();
        $requestParams['page'] = $pageNumber;
        $requestParams['limit'] = $limit;
        return $this->getUrl('*/*/*', $requestParams);
    }
}
