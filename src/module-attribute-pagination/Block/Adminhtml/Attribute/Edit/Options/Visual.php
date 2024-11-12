<?php
/**
 * Copyright © Q-Solutions Studio: eCommerce Nanobots. All rights reserved.
 * @author      Jakub Winkler <jwinkler@qsolutionsstudio.com>
 *
 * @category    Nanobots
 * @package     Nanobots_AttributeOptionPager
 */
namespace Nanobots\AttributeOptionPager\Block\Adminhtml\Attribute\Edit\Options;

class Visual extends \Magento\Swatches\Block\Adminhtml\Attribute\Edit\Options\Visual
{
    use PaginationTrait;

    /** @var string  */
    protected $_template = 'Nanobots_AttributeOptionPager::catalog/product/attribute/visual.phtml';
}
