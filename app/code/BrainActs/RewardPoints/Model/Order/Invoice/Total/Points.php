<?php
/**
 * Copyright (c) 2017 BrainActs OÜ, All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace BrainActs\RewardPoints\Model\Order\Invoice\Total;

class Points extends \Magento\Sales\Model\Order\Invoice\Total\AbstractTotal
{
    public function collect(\Magento\Sales\Model\Order\Invoice $invoice)
    {
        $points = $invoice->getOrder()->getRewardPointsAmount();
        $invoice->setGrandTotal($invoice->getGrandTotal() - $points);
        $invoice->setBaseGrandTotal($invoice->getBaseGrandTotal() - $points);
        return $this;
    }
}
