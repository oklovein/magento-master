<?php
/**
 * Copyright (c) 2017 BrainActs OÜ, All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace BrainActs\RewardPoints\Ui\Component\Listing\Column\Website;

use Magento\Framework\Escaper;
use Magento\Framework\Data\OptionSourceInterface;
use Magento\Store\Model\System\Store as SystemStore;

class Options implements OptionSourceInterface
{

    /**
     * All Store Views value
     */
    const ALL_WEBSITES = '0';

    /**
     * Escaper
     *
     * @var Escaper
     */
    private $escaper;

    /**
     * System store
     *
     * @var SystemStore
     */
    private $systemStore;

    /**
     * Constructor
     *
     * @param SystemStore $systemStore
     * @param Escaper     $escaper
     */
    public function __construct(SystemStore $systemStore, Escaper $escaper)
    {
        $this->systemStore = $systemStore;
        $this->escaper = $escaper;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $currentOptions['']['label'] = '--';
        $currentOptions['']['value'] = '--';

        $currentOptions['All Store Views']['label'] = __('All Websites');
        $currentOptions['All Store Views']['value'] = self::ALL_WEBSITES;

        $websiteCollection = $this->systemStore->getWebsiteCollection();

        foreach ($websiteCollection as $website) {
            $name = $this->escaper->escapeHtml($website->getName());
            $currentOptions[$name]['label'] = $name;
            $currentOptions[$name]['value'] = $website->getId();
        }

        $this->options = array_values($currentOptions);

        return $currentOptions;
    }
}
