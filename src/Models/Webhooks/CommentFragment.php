<?php

namespace Phox\Phigma\Models\Webhooks;

class CommentFragment
{
    public const ID_METHOD = 'getText';
    
    public function __construct(
        private string|null $text = null,
        private string|null $mention = null,
    ) {}

    public function getText(): ?string
    {
        return $this->text;
    }

    public function getMention(): ?string
    {
        return $this->mention;
    }

    public function text(string $text): CommentFragment
    {
        $this->text = $text;
        return $this;
    }

    public function mention(string $mention): CommentFragment
    {
        $this->mention = $mention;
        return $this;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public static function create(array $data): CommentFragment
    {
        $paymentStatus = new CommentFragment();
        if (isset($data['text'])) {
            $paymentStatus->text($data['text']);
        }
        if (isset($data['mention'])) {
            $paymentStatus->mention($data['mention']);
        }

        return $paymentStatus;
    }
}