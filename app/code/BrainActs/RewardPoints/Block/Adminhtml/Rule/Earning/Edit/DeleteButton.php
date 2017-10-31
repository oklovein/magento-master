<?php
/**
 * Copyright (c) 2017 BrainActs OÜ, All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace BrainActs\RewardPoints\Block\Adminhtml\Rule\Earning\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class DeleteButton
 */
class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        $ruleId = $this->getRuleId();
        if ($ruleId && $this->canRender('delete')) {
            $data = [
                'label' => __('Delete'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                    'Are you sure you want to delete this?'
                ) . '\', \'' . $this->urlBuilder->getUrl('*/rule_earning/delete', ['id' => $ruleId]) . '\')',
                'sort_order' => 20,
            ];
        }
        return $data;
    }
}
