<?php

namespace Phox\Phigma\Models\Comments;

use Phox\Phigma\Models\Collection;

/**
 * @extends Collection<Reaction>
 */
class ReactionCollection extends Collection
{
    public function __construct(
        private array $items = [],
    ) {
        parent::__construct(Reaction::class, $items);
    }

    /**
     * @return Collection<Reaction>
     */
    public function removeReaction(mixed $itemToRemove): Collection
    {
        return $this->removeItem($itemToRemove, 'getEmoji');
    }

    /**
     * @return Collection<Reaction>
     */
    public static function create(array $data): Collection
    {
        $collection = new Collection(Reaction::class);
        $collection->createItemsFromArray($data);

        return $collection;
    }
}