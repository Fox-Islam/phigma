<?php

namespace Phox\Phigma\Oauth;

use Carbon\Carbon;

readonly class Token
{
    public function __construct(
        private readonly int|null $userId,
        private readonly string $accessToken,
        private readonly string $refreshToken,
        private readonly int $expiresIn,
    ) {}

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }

    public function getExpiresAt(): Carbon
    {
        return Carbon::now()->addSeconds($this->expiresIn);
    }

    /**
     * @return int Time until token expires, in seconds
     */
    public function getExpiresIn(): int
    {
        return $this->expiresIn;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}