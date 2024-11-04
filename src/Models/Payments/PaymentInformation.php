<?php

namespace Phox\Phigma\Models\Payments;

use Carbon\Carbon;

class PaymentInformation
{
    public function __construct(
        private string|null $user_id = null,
        private string|null $resource_id = null,
        private string|null $resource_type = null,
        private array|null $payment_status = null,
        private string|null $date_of_purchase = null,
    ) {}

    public function getUserId(): string|null
    {
        return $this->user_id;
    }

    public function getResourceId(): string|null
    {
        return $this->resource_id;
    }

    public function getResourceType(): string|null
    {
        return $this->resource_type;
    }

    public function getPaymentStatus(): PaymentStatus|null
    {
        if (! $this->payment_status) {
            return null;
        }

        return PaymentStatus::create($this->payment_status);
    }

    public function getDateOfPurchase(): Carbon|null
    {
        if (! $this->date_of_purchase) {
            return null;
        }
        return Carbon::parse($this->date_of_purchase);
    }

    public function userId(string $userId): PaymentInformation
    {
        $this->user_id = $userId;
        return $this;
    }

    public function resourceId(string $resourceId): PaymentInformation
    {
        $this->resource_id = $resourceId;
        return $this;
    }

    public function resourceType(string $resourceType): PaymentInformation
    {
        $this->resource_type = $resourceType;
        return $this;
    }

    public function paymentStatus(array $paymentStatus): PaymentInformation
    {
        $this->payment_status = $paymentStatus;
        return $this;
    }

    public function dateOfPurchase(string $dateOfPurchase): PaymentInformation
    {
        $this->date_of_purchase = $dateOfPurchase;
        return $this;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public static function create(array $data): PaymentInformation
    {
        $paymentInformation = new PaymentInformation();
        if (isset($data['user_id'])) {
            $paymentInformation->userId($data['user_id']);
        }
        if (isset($data['resource_id'])) {
            $paymentInformation->resourceId($data['resource_id']);
        }
        if (isset($data['resource_type'])) {
            $paymentInformation->resourceType($data['resource_type']);
        }
        if (isset($data['payment_status'])) {
            $paymentInformation->paymentStatus($data['payment_status']);
        }
        if (isset($data['date_of_purchase'])) {
            $paymentInformation->dateOfPurchase($data['date_of_purchase']);
        }

        return $paymentInformation;
    }
}