<?php

namespace Phox\Phigma\Models\Payments;

class PaymentStatus
{
    public function __construct(
        private string|null $type = null
    ) {}

    public function getType(): ?string
    {
        return $this->type;
    }

    public function type(string $type): PaymentStatus
    {
        $this->type = $type;
        return $this;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public static function create(array $data): PaymentStatus
    {
        $paymentStatus = new PaymentStatus();
        if (isset($data['type'])) {
            $paymentStatus->type($data['type']);
        }

        return $paymentStatus;
    }
}