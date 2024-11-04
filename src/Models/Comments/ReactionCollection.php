<?php

namespace Phox\Phigma\Models\Comments;

use Phox\Phigma\Models\Collection;

class ReactionCollection extends Collection
{
    public function __construct(
        private array $items = [],
    ) {
        parent::__construct(Reaction::class, $items);
    }

    public function removeReaction(Reaction $reactionToRemove): ReactionCollection
    {
        $reactionName = $reactionToRemove->getEmoji();
        if (! $reactionName) {
            return $this;
        }

        foreach ($this->items as $index => $reaction) {
            if ($reaction->getEmoji() === $reactionName) {
                unset($this->items[$index]);
                return $this;
            }
        }

        return $this;
    }

    /**
     * @param array $data
     * @return ReactionCollection
     */
    public static function create(array $data): ReactionCollection
    {
        $reactionCollection = new ReactionCollection();
        foreach ($data as $reactionData) {
            $reactionCollection->addItem(Reaction::create($reactionData));
        }

        return $reactionCollection;
    }
}