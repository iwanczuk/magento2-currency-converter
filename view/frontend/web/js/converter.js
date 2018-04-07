define([
    'jquery',
    'mage/translate',
    'jquery/ui',
    'mage/validation/validation'
], function ($, $t) {
    'use strict';

    $.widget('mage.currencyconverter', {
        _create: function () {
            this.element.validation({
                submitHandler: $.proxy(function (form) {
                    $.ajax({
                        url: this.options.url,
                        type: 'get',
                        dataType: 'json',
                        data: {
                            from_currency: $('#from_currency').val(),
                            from_amount: $('#from_amount').val(),
                            to_currency: $('#to_currency').val()
                        },
                        success: function(response) {
                            if (!response.error) {
                                $('#to_amount').val(response.to_amount);
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function () {
                            alert($t('Cannot convert currency.'));
                        }
                    });
                    return false;
                }, this)
            });
        }
    });

    return $.mage.currencyconverter;
});
