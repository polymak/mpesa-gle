<?php
/**
 * WHMCS Sample Payment Gateway Module
 *
 * Payment Gateway modules allow you to integrate payment solutions with the
 * WHMCS platform.
 *
 * This sample file demonstrates how a payment gateway module for WHMCS should
 * be structured and all supported functionality it can contain.
 *
 * Within the module itself, all functions must be prefixed with the module
 * filename, followed by an underscore, and then the function name. For this
 * example file, the filename is "gatewaymodule" and therefore all functions
 * begin "gatewaymodule_".
 *
 * If your module or third party API does not support a given function, you
 * should not define that function within your module. Only the _config
 * function is required.
 *
 * For more information, please refer to the online documentation.
 *
 * @see https://developers.whmcs.com/payment-gateways/
 *
 * @copyright Copyright (c) WHMCS Limited 2017
 * @license http://www.whmcs.com/license/ WHMCS Eula
 */

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

/**
 * Define module related meta data.
 *
 * Values returned here are used to determine module related capabilities and
 * settings.
 *
 * @see https://developers.whmcs.com/payment-gateways/meta-data-params/
 *
 * @return array
 */
function mpesagle_MetaData()
{
    return array(
        'DisplayName' => 'Payment Gateway MPESA-GLE ',
        'APIVersion' => '1.5', // Use API Version 1.1
        'DisableLocalCreditCardInput' => true,
        'TokenisedStorage' => false,
    );
}

/**
 * Define gateway configuration options.
 *
 * The fields you define here determine the configuration options that are
 * presented to administrator users when activating and configuring your
 * payment gateway module for use.
 *
 * Supported field types include:
 * * text
 * * password
 * * yesno
 * * dropdown
 * * radio
 * * textarea
 *
 * Examples of each field type and their possible configuration parameters are
 * provided in the sample function below.
 *
 * @return array
 */
function mpesagle_config()
{
    return array(
        // the friendly display name for a payment gateway should be
        // defined here for backwards compatibility
        'FriendlyName' => array(
            'Type' => 'System',
            'Value' => 'mpesagle',
        ),
        'websiteurl' => array(
            'FriendlyName' => 'Website URL(https://mywebsite.com)',
            'Type' => 'text',
            'Size' => '250',
            'Default' => '',
            'Description' => 'Enter Your Website Url i.e https://mywebsite.com',
        ),
        // internal IP MPESA
        'internalIp' => array(
            'FriendlyName' => 'Internal IP',
            'Type' => 'text',
            'Size' => '150',
            'Default' => '',
            'Description' => 'Enter your Internal IP Mpesa',
        ),
        // internal IP PUBLIC MPESA
        'ippPublic' => array(
            'FriendlyName' => 'Public IP',
            'Type' => 'text',
            'Size' => '150',
            'Default' => '',
            'Description' => 'Enter your Public IP Mpesa',
        ),
        // event ID Login MPESA
        'eventIdLogin' => array(
            'FriendlyName' => 'event ID Login MPESA',
            'Type' => 'text',
            'Size' => '150',
            'Default' => '',
            'Description' => 'Enter your event ID Login MPESA',
        ),
        // evenit ID C2B Payment MPESA
        'evenitIdPay' => array(
            'FriendlyName' => 'Evenit ID C2B Payment',
            'Type' => 'text',
            'Size' => '150',
            'Default' => '',
            'Description' => 'Enter your Evenit ID C2B Payment MPESA',
        ),
        // commandID MPESA
        'commandIdPay' => array(
            'FriendlyName' => 'Command ID',
            'Type' => 'text',
            'Size' => '150',
            'Default' => '',
            'Description' => 'Enter your commandID MPESA',
        ),
        // ShortCode/ServiceProviderCode MPESA
        'shortCode' => array(
            'FriendlyName' => 'ShortCode Provider',
            'Type' => 'text',
            'Size' => '150',
            'Default' => '',
            'Description' => 'Enter your ShortCode/ServiceProviderCode',
        ),
        
    );
}

/**
 * Payment link.
 *
 * Required by third party payment gateway modules only.
 *
 * Defines the HTML output displayed on an invoice. Typically consists of an
 * HTML form that will take the user to the payment gateway endpoint.
 *
 * @param array $params Payment Gateway Module Parameters
 *
 * @see https://developers.whmcs.com/payment-gateways/third-party-gateway/
 *
 * @return string
 */
function mpesagle_link($params)
{
    // Gateway Configuration Parameters
    $websiteurl = $params['websiteurl'];
    $internalIp = $params['internalIp'];
    $ippPublic = $params['ippPublic'];
    $eventIdLogin = $params['eventIdLogin'];
    $evenitIdPay = $params['evenitIdPay'];
    $commandIdPay = $params['commandIdPay'];
    $shortCode = $params['shortCode'];

    // Invoice Parameters
    $invoiceId = $params['invoiceid'];
    $description = $params["description"];
    $amount = $params['amount'];
    $currencyCode = $params['currency'];

    // Client Parameters
    $firstname = $params['clientdetails']['firstname'];
    $lastname = $params['clientdetails']['lastname'];
    $email = $params['clientdetails']['email'];
    $address1 = $params['clientdetails']['address1'];
    $address2 = $params['clientdetails']['address2'];
    $city = $params['clientdetails']['city'];
    $state = $params['clientdetails']['state'];
    $postcode = $params['clientdetails']['postcode'];
    $country = $params['clientdetails']['country'];
    $phone = $params['clientdetails']['phonenumber'];

    // System Parameters
    $companyName = $params['companyname'];
    $systemUrl = $params['systemurl'];
    $returnUrl = $params['returnurl'];
    $langPayNow = $params['langpaynow'];
    $moduleDisplayName = $params['name'];
    $moduleName = $params['paymentmethod'];
    $whmcsVersion = $params['whmcsVersion'];

    $url = 'https://cloud-goodluckevent.com/host/cart.php';

    $postfields = array();
    $postfields['username'] = $username;
    $postfields['invoice_id'] = $invoiceId;
    $postfields['description'] = $description;
    $postfields['amount'] = $amount;
    $postfields['currency'] = $currencyCode;
    $postfields['first_name'] = $firstname;
    $postfields['last_name'] = $lastname;
    $postfields['email'] = $email;
    $postfields['address1'] = $address1;
    $postfields['address2'] = $address2;
    $postfields['city'] = $city;
    $postfields['state'] = $state;
    $postfields['postcode'] = $postcode;
    $postfields['country'] = $country;
    $postfields['phone'] = $phone;
    $postfields['callback_url'] = $systemUrl . '/modules/gateways/callback/' . $moduleName . '.php';
    $postfields['return_url'] = $returnUrl;

    // Include your code for the form user of payment

    //function yourmodulename_link($params) {
    //return '<form method="post" action="https://www.example.com/checkout">
       // <input type="invoice_number" value="' . $params['invoiceid'] . '" />
        //<input type="description" value="' . $params['description'] . '" />
       // <input type="amount" value="' . $params['amount'] . '" />
        //<input type="currency" value="' . $params['currency'] . '" />
        //<input type="submit" value="' . $params['langpaynow'] . '" />
        //</form>';
    //}

    $htmlOutput = '<form method="post" action="' . $url . '">';
    foreach ($postfields as $k => $v) {
        $htmlOutput .= '<input type="hidden" name="' . $k . '" value="' . urlencode($v) . '" />';
    }
    $htmlOutput .= '<input type="submit" value="' . $langPayNow . '" />';
    $htmlOutput .= '</form>';

    return $htmlOutput;
}

/**
 * Refund transaction.
 *
 * Called when a refund is requested for a previously successful transaction.
 *
 * @param array $params Payment Gateway Module Parameters
 *
 * @see https://developers.whmcs.com/payment-gateways/refunds/
 *
 * @return array Transaction response status
 */
function mpesagle_refund($params)
{
    // Gateway Configuration Parameters
    $websiteurl = $params['websiteurl'];
    $internalIp = $params['internalIp'];
    $ippPublic = $params['ippPublic'];
    $eventIdLogin = $params['eventIdLogin'];
    $evenitIdPay = $params['evenitIdPay'];
    $commandIdPay = $params['commandIdPay'];
    $shortCode = $params['shortCode'];

    // Transaction Parameters
    $transactionIdToRefund = $params['transid'];
    $refundAmount = $params['amount'];
    $currencyCode = $params['currency'];

    // Client Parameters
    $firstname = $params['clientdetails']['firstname'];
    $lastname = $params['clientdetails']['lastname'];
    $email = $params['clientdetails']['email'];
    $address1 = $params['clientdetails']['address1'];
    $address2 = $params['clientdetails']['address2'];
    $city = $params['clientdetails']['city'];
    $state = $params['clientdetails']['state'];
    $postcode = $params['clientdetails']['postcode'];
    $country = $params['clientdetails']['country'];
    $phone = $params['clientdetails']['phonenumber'];

    // System Parameters
    $companyName = $params['companyname'];
    $systemUrl = $params['systemurl'];
    $langPayNow = $params['langpaynow'];
    $moduleDisplayName = $params['name'];
    $moduleName = $params['paymentmethod'];
    $whmcsVersion = $params['whmcsVersion'];

    // perform API call to initiate refund and interpret result

    return array(
        // 'success' if successful, otherwise 'declined', 'error' for failure
        'status' => 'success',
        // Data to be recorded in the gateway log - can be a string or array
        'rawdata' => $responseData,
        // Unique Transaction ID for the refund transaction
        'transid' => $refundTransactionId,
        // Optional fee amount for the fee value refunded
        'fees' => $feeAmount,
    );
}

/**
 * Cancel subscription.
 *
 * If the payment gateway creates subscriptions and stores the subscription
 * ID in tblhosting.subscriptionid, this function is called upon cancellation
 * or request by an admin user.
 *
 * @param array $params Payment Gateway Module Parameters
 *
 * @see https://developers.whmcs.com/payment-gateways/subscription-management/
 *
 * @return array Transaction response status
 */
function mpesagle_cancelSubscription($params)
{
    // Gateway Configuration Parameters
    $websiteurl = $params['websiteurl'];
    $internalIp = $params['internalIp'];
    $ippPublic = $params['ippPublic'];
    $eventIdLogin = $params['eventIdLogin'];
    $evenitIdPay = $params['evenitIdPay'];
    $commandIdPay = $params['commandIdPay'];
    $shortCode = $params['shortCode'];

    // Subscription Parameters
    $subscriptionIdToCancel = $params['subscriptionID'];

    // System Parameters
    $companyName = $params['companyname'];
    $systemUrl = $params['systemurl'];
    $langPayNow = $params['langpaynow'];
    $moduleDisplayName = $params['name'];
    $moduleName = $params['paymentmethod'];
    $whmcsVersion = $params['whmcsVersion'];

    // perform API call to cancel subscription and interpret result

    return array(
        // 'success' if successful, any other value for failure
        'status' => 'success',
        // Data to be recorded in the gateway log - can be a string or array
        'rawdata' => $responseData,
    );
}
