<?php
/**
 * Copyright © Q-Solutions Studio: eCommerce Nanobots. All rights reserved.
 * @author      Jakub Winkler <jwinkler@qsolutionsstudio.com>
 *
 * @category    Nanobots
 * @package     Nanobots_AttributeOptionPager
 */

declare(strict_types=1);

namespace Nanobots\AttributeOptionPager\Block\Adminhtml\Attribute\Edit\Options;

class Options extends \Magento\Eav\Block\Adminhtml\Attribute\Edit\Options\Options
{
    use PaginationTrait;

    /** @var string  */
    protected $_template = 'Nanobots_AttributeOptionPager::catalog/product/attribute/options.phtml';
}
