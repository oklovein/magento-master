/*
 * Copyright (c) 2017 BrainActs OÜ, All rights reserved.
 * See LICENSE.txt for license details.
 */
define(
    [
        'jquery',
        'ko',
        'uiComponent',
        'Magento_Checkout/js/model/quote',
        'BrainActs_RewardPoints/js/action/set-reward-points',
        'Magento_Checkout/js/model/totals',
        'jquery/ui'
    ],
    function ($, ko, Component, quote, setRewardPointsAction, totals) {
        'use strict';

        var totals = quote.getTotals(),
            rewardPoints = ko.observable(null),
            isApplied = ko.observable(rewardPoints() != null),
            isVisible  = ko.observable(null);
        if (totals()) {
            var value = parseInt(window.checkoutConfig.reward.selected_points);
            rewardPoints(value);
            isVisible(window.checkoutConfig.reward.is_visible);
        }

        return Component.extend(
            {
                defaults: {
                    template: 'BrainActs_RewardPoints/checkout/payment/reward-points'
                },

                rewardPoints: rewardPoints,

                /**
                 * Applied flag
                 */
                isApplied: isApplied,

                isVisible: isVisible,

                /**
                 * RP application procedure
                 */
                apply: function () {
                    if (this.validate()) {
                        setRewardPointsAction(rewardPoints(), isApplied);
                    }
                },

                /**
                 * Points form validation
                 *
                 * @returns {Boolean}
                 */
                validate: function () {
                    var form = '#reward-points-form';

                    return $(form).validation() && $(form).validation('isValid');
                },

                initSlider: function () {
                    var maxValue = parseInt(window.checkoutConfig.reward.available_points),
                    value = parseInt(window.checkoutConfig.reward.selected_points);

                    $("#reward-slider").slider(
                        {
                            classes: {
                                "ui-slider": "highlight"
                            },
                            range: "max",
                            min: 0,
                            max: maxValue,
                            value: value,
                            slide: function (event, ui) {
                                $("#reward-points").val(ui.value);
                                rewardPoints(ui.value);
                            },
                            stop: function (event, ui) {

                            }
                        }
                    );
                    $("#reward-points").val(value);
                }
            }
        );
    }
);
