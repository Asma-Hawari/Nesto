var config = {
    "map": {
        "*": {
            "Magento_Checkout/js/model/shipping-save-processor/default" : "Asma_hawari/js/shipping-save-processor-default-override"
        }},
    config: {
        mixins: {
            'Magento_Checkout/js/action/set-billing-address': {
                'Asma_Hawari/js/action/set-billing-address-mixin': true
            },
            'Magento_Checkout/js/action/set-shipping-information': {
                'Asma_Hawari/js/action/set-shipping-information-mixin': true
            },
            'Magento_Checkout/js/action/create-shipping-address': {
                'Asma_Hawari/js/action/create-shipping-address-mixin': true
            },
            'Magento_Checkout/js/action/place-order': {
                'Asma_Hawari/js/action/set-billing-address-mixin': true
            },
            'Magento_Checkout/js/action/create-billing-address': {
                'Asma_Hawari/js/action/set-billing-address-mixin': true
            }
        }
    }
};
