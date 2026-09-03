<?php

namespace App\Http\Services;

use GuzzleHttp\Client;

class PaymobService
{
    protected Client $client;
    protected string $apiKey;
    protected string $integrationId;
    protected string $iframeId;
    protected string $hmacSecret;
    protected string $baseUrl;
    protected string $walletIssuer;

    public function __construct()
    {
        $this->client = new Client([
            'timeout' => 20,
            'connect_timeout' => 10,
        ]);

        $config = config('services.paymob');

        $this->baseUrl = rtrim((string) ($config['base_url'] ?? 'https://accept.paymob.com/api'), '/');
        $this->apiKey = (string) ($config['api_key'] ?? '');
        $this->integrationId = (string) ($config['integration_id'] ?? '');
        $this->iframeId = (string) ($config['iframe_id'] ?? '');
        $this->hmacSecret = (string) ($config['hmac_secret'] ?? '');
        $this->walletIssuer = (string) ($config['wallet_issuer'] ?? 'Vodafone');

        if ($this->apiKey === '' || $this->integrationId === '') {
            throw new \RuntimeException('Paymob configuration is missing.');
        }
    }

    public function generateAuthToken(): string
    {
        $response = $this->client->post($this->baseUrl . '/auth/tokens', [
            'json' => [
                'api_key' => $this->apiKey,
            ],
        ]);

        return (string) json_decode((string) $response->getBody(), true, 512, JSON_THROW_ON_ERROR)['token'];
    }

    public function generateOrderId(int $amountCents, string $authToken): int
    {
        $merchantOrderId = (string) \Illuminate\Support\Str::uuid();

        $response = $this->client->post($this->baseUrl . '/ecommerce/orders', [
            'json' => [
                'auth_token' => $authToken,
                'delivery_needed' => false,
                'amount_cents' => $amountCents,
                'currency' => 'EGP',
                'merchant_order_id' => $merchantOrderId,
            ],
        ]);

        return (int) json_decode((string) $response->getBody(), true, 512, JSON_THROW_ON_ERROR)['id'];
    }

    public function generatePaymentData(array $data): array
    {
        $amountCents = (int) round(((float) $data['amount']) * 100);
        $authToken = $this->generateAuthToken();
        $orderId = $this->generateOrderId($amountCents, $authToken);

        $response = $this->client->post($this->baseUrl . '/acceptance/payment_keys', [
            'json' => [
                'auth_token' => $authToken,
                'amount_cents' => $amountCents,
                'expiration' => 3600,
                'order_id' => $orderId,
                'billing_data' => [
                    'first_name' => $data['name'],
                    'last_name' => $data['name'],
                    'email' => $data['email'],
                    'phone_number' => $data['phone'],
                    'street' => 'NA',
                    'building' => 'NA',
                    'floor' => 'NA',
                    'apartment' => 'NA',
                    'city' => 'Cairo',
                    'state' => 'Cairo',
                    'country' => 'EGY',
                ],
                'metadata' => [
                    'student_id' => $data['student_id'],
                    'orderable_id' => $data['orderable_id'],
                    'orderable_type' => $data['orderable_type'],
                ],
                'currency' => 'EGP',
                'integration_id' => (int) $this->integrationId,
            ],
        ]);

        $paymentToken = (string) json_decode((string) $response->getBody(), true, 512, JSON_THROW_ON_ERROR)['token'];

        return [
            'paymentToken' => $paymentToken,
            'orderId' => $orderId,
        ];
    }

    public function payWithPaymob(string $paymentToken, string $phoneNumber): array
    {
        $response = $this->client->post($this->baseUrl . '/acceptance/payments/pay', [
            'json' => [
                'source' => [
                    'identifier' => $phoneNumber,
                    'subtype' => 'WALLET',
                    'wallet_issuer' => $this->walletIssuer,
                ],
                'payment_token' => $paymentToken,
            ],
        ]);

        return json_decode((string) $response->getBody(), true, 512, JSON_THROW_ON_ERROR);
    }

    public function verifyHmac(array $payload, string $providedHmac): bool
    {
        if ($this->hmacSecret === '' || $providedHmac === '') {
            return false;
        }

        $transaction = $payload['obj'] ?? $payload;
        $order = $transaction['order'] ?? [];
        $sourceData = $transaction['source_data'] ?? [];

        $values = [
            $transaction['amount_cents'] ?? '',
            $transaction['created_at'] ?? '',
            $transaction['currency'] ?? '',
            $transaction['error_occured'] ?? '',
            $transaction['has_parent_transaction'] ?? '',
            $transaction['id'] ?? '',
            $transaction['integration_id'] ?? '',
            $transaction['is_3d_secure'] ?? '',
            $transaction['is_auth'] ?? '',
            $transaction['is_capture'] ?? '',
            $transaction['is_refunded'] ?? '',
            $transaction['is_standalone_payment'] ?? '',
            $transaction['is_voided'] ?? '',
            $order['id'] ?? '',
            $transaction['owner'] ?? '',
            $transaction['pending'] ?? '',
            $sourceData['pan'] ?? '',
            $sourceData['sub_type'] ?? '',
            $sourceData['type'] ?? '',
            $transaction['success'] ?? '',
        ];

        $calculated = hash_hmac('sha512', implode('', array_map(static fn ($value) => strtolower((string) $value), $values)), $this->hmacSecret);

        return hash_equals(strtolower($calculated), strtolower($providedHmac));
    }
}
