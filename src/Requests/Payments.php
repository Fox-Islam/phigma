<?php

namespace Phox\Phigma\Requests;

use GuzzleHttp\Exception\GuzzleException;
use Phox\Phigma\Client;
use Phox\Phigma\Models\Payments\PaymentInformation;

readonly class Payments
{
    public function __construct(
        private readonly Client $client,
    ) {}

    /**
     * @link https://www.figma.com/developers/api#get-payments-endpoint-plugin-payment-token Figma API reference
     * @link https://www.figma.com/plugin-docs/requiring-payment/#getting-started Figma plugin docs
     * @link https://www.figma.com/plugin-docs/api/figma-payments#getpluginpaymenttokenasync Figma plugin API reference
     * @param string $pluginPaymentToken Token returned from "getPluginPaymentTokenAsync" in the plugin payments API
     * @throws GuzzleException
     */
    public function getPaymentsViaPaymentToken(string $pluginPaymentToken): ?PaymentInformation
    {
        $body = $this->client->get('https://api.figma.com/v1/payments', [
            'query' => [
                'plugin_payment_token' => $pluginPaymentToken,
            ],
        ]);

        if (empty($body)) {
            return null;
        }

        return PaymentInformation::create($body);
    }

    /**
     * @link https://www.figma.com/developers/api#get-payments-endpoint-user-resource-id Figma API reference
     * @param int $userId The ID of the user to query payment information about
     * @param int $communityFileId The ID of the Community file to query a user's payment information on
     * @param int $pluginId The ID of the plugin to query a user's payment information on
     * @param int $widgetId The ID of the widget to query a user's payment information on
     * @throws GuzzleException
     */
    public function getPaymentsViaUserId(int $userId, int $communityFileId, int $pluginId, int $widgetId): ?PaymentInformation
    {
        $body = $this->client->get('https://api.figma.com/v1/payments', [
            'query' => [
                'user_id' => $userId,
                'community_file_id' => $communityFileId,
                'plugin_id' => $pluginId,
                'widget_id' => $widgetId,
            ],
        ]);
        if (empty($body)) {
            return null;
        }

        return PaymentInformation::create($body);
    }
}