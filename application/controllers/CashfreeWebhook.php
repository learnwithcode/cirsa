<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Cashfree\Cashfree;

class CashfreeWebhook extends CI_Controller {

    public function index() {
        // Optional: Include Composer autoload if not done globally
        // require_once(APPPATH . '../vendor/autoload.php');

        // Read raw input
        $rawData = file_get_contents("php://input");

        // Read headers (normalized to lowercase for consistency)
        $headers = array_change_key_case(getallheaders(), CASE_LOWER);
        $expectedSig = $headers['x-webhook-signature'] ?? '';
        $timestamp = $headers['x-webhook-timestamp'] ?? '';

        // Validate presence
        if (empty($expectedSig) || empty($timestamp)) {
            log_message('error', 'Webhook missing headers: ' . json_encode($headers));
            http_response_code(400);
            echo "Bad Request";
            return;
        }

        // Set Cashfree credentials
        Cashfree::$XClientId = '7095501be8969f1d1a369726555907';
        Cashfree::$XClientSecret = 'cfsk_ma_test_0ba5d02439c97faa8dbed837a72567cf_503a0d71';

        try {
            $cf = new Cashfree();
            $cf->PGVerifyWebhookSignature($expectedSig, $rawData, $timestamp);

            // Signature verified
            $data = json_decode($rawData, true);
            log_message('info', '✅ Webhook verified: ' . print_r($data, true));

            // 👉 Process your order/payment update logic here

            http_response_code(200);
            echo "Webhook verified and received.";

        } catch (Exception $e) {
            log_message('error', '❌ Signature failed: ' . $e->getMessage());
            http_response_code(403);
            echo "Invalid Signature";
        }
    }
}
