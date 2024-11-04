<?php

namespace Phox\Phigma\Requests;

use GuzzleHttp\Exception\GuzzleException;
use JsonException;
use Phox\Phigma\Client;
use Phox\Phigma\Models\Comments\Comment;
use Phox\Phigma\Models\Comments\Reaction;
use Phox\Phigma\Models\Comments\ReactionCollection;
use Phox\Phigma\Models\Properties\FrameOffset;
use Phox\Phigma\Models\Properties\FrameOffsetRegion;
use Phox\Phigma\Models\Properties\Region;
use Phox\Phigma\Models\Properties\Vector;

readonly class Comments
{
    public function __construct(
        private Client $client,
    ) {}

    /**
     * @link https://www.figma.com/developers/api#get-comments-endpoint Figma API reference
     * @param string $key A file key or branch key to get comments from.
     * @param bool|null $asMarkdown If enabled, will return comments as their markdown equivalents when applicable
     * @return Comment[]|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getComments(string $key, bool $asMarkdown = null): array|null
    {
        $parameters = [];
        if ($asMarkdown !== null) {
            $parameters['as_md'] = $asMarkdown;
        }

        $body = $this->client->get("https://api.figma.com/v1/files/{$key}/comments", [
            'query' => $parameters,
        ]);

        if (empty($body)) {
            return null;
        }

        $comments = [];
        foreach ($body['comments'] as $comment) {
            $comments[] = Comment::create($comment);
        }
        return $comments;
    }

    /**
     * @link https://www.figma.com/developers/api#post-comments-endpoint Figma API reference
     * @param string $key A file key or branch key to add a comment to
     * @param string $message The text contents of the comment to post
     * @param string|null $commentId The id of the comment to reply to, if any
     * @param Vector|FrameOffset|Region|FrameOffsetRegion|array|null $clientMeta
     * @return Comment|null
     * @throws GuzzleException
     * @throws JsonException
     */
    public function createComment(
        string $key,
        string $message,
        string $commentId = null,
        Vector|FrameOffset|Region|FrameOffsetRegion|array|null $clientMeta = null
    ): ?Comment {
        $bodyParams = [
            'message' => $message,
        ];

        if ($clientMeta !== null) {
            if (! is_array($clientMeta)) {
                $clientMeta = $clientMeta->toArray();
            }
            $bodyParams['client_meta'] = $clientMeta;
        }
        if ($commentId !== null) {
            $bodyParams['comment_id'] = $commentId;
        }

        $body = $this->client->post("https://api.figma.com/v1/files/{$key}/comments", [
            'body' => json_encode($bodyParams, JSON_THROW_ON_ERROR),
        ]);

        if (empty($body)) {
            return null;
        }

        return Comment::create($body);
    }

    /**
     * @link https://www.figma.com/developers/api#get-comment-reactions-endpoint Figma API reference
     * @param string $key A file key or branch key to delete a comment from
     * @param string $commentId ID of comment to delete
     * @throws GuzzleException
     */
    public function deleteComment(string $key, string $commentId): array
    {
        return $this->client->delete("https://api.figma.com/v1/files/{$key}/comments/{$commentId}");
    }

    /**
     * @link https://www.figma.com/developers/api#delete-comments-endpoint Figma API reference
     * @param string $key A file key or branch key where the comment exists
     * @param string $commentId ID of comment to get reactions for
     * @param string|null $cursor Cursor for pagination
     * @throws GuzzleException
     */
    public function getCommentReactions(string $key, string $commentId, string $cursor = null): ?array
    {
        $queryParams = [];
        if ($cursor) {
            $queryParams['cursor'] = $cursor;
        }

        $body = $this->client->get("https://api.figma.com/v1/files/{$key}/comments/{$commentId}/reactions", [
            'query' => $queryParams
        ]);

        if (empty($body)) {
            return null;
        }

        $body['reactions'] = ReactionCollection::create($body['reactions']);
        return $body;
    }

    /**
     * @link https://www.figma.com/developers/api#post-comment-reactions-endpoint Figma API reference
     * @param string $key A file key or branch key where the comment exists
     * @param string $commentId ID of comment to react to
     * @param string $emoji The shortcode of the emoji to add
     * @throws GuzzleException
     * @throws JsonException
     */
    public function postCommentReaction(string $key, string $commentId, string $emoji): ?array
    {
        $bodyParams = [
            'emoji' => $emoji,
        ];

        $body = $this->client->post("https://api.figma.com/v1/files/{$key}/comments/{$commentId}/reactions", [
            'body' => json_encode($bodyParams, JSON_THROW_ON_ERROR),
        ]);

        if (empty($body)) {
            return null;
        }

        return $body;
    }

    /**
     * @link https://www.figma.com/developers/api#delete-comment-reactions-endpoint Figma API reference
     * @param string $key A file key or branch key where the comment exists
     * @param string $commentId ID of comment to remove a reaction from
     * @param string $emoji The shortcode of the emoji to remove
     * @throws GuzzleException
     */
    public function deleteCommentReaction(string $key, string $commentId, string $emoji): ?array
    {
        $queryParams = [
            'emoji' => $emoji,
        ];

        $body = $this->client->delete("https://api.figma.com/v1/files/{$key}/comments/{$commentId}/reactions", [
            'query' => $queryParams,
        ]);

        if (empty($body)) {
            return null;
        }

        return $body;
    }
}