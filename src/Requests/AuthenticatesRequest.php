<?php

namespace Phox\Phigma\Requests;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;
use Psr\Http\Message\ResponseInterface;

class AuthenticatesRequest
{
    /**
     * @param string $accessToken
     * @param string $tokenType Valid values: 'OAuth2', 'PAT'
     */
    public function __construct(
        private readonly string $accessToken,
        private readonly string $tokenType = 'OAuth2',
    ) {}

    /**
     * @throws GuzzleException
     */
    public function request(string $method, string $url = '', array $params = []): mixed
    {
        $this->addAuthHeader($params);
        $response = (new Client())->request($method, $url, $params);

        try {
            $body = json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException) {
            return null;
        }

        return $body;
    }

    /**
     * @throws GuzzleException
     */
    public function get(string $url = '', array $params = []): mixed
    {
        $this->addAuthHeader($params);
        $response = (new Client())->get($url, $params);

        try {
            $body = json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException) {
            return null;
        }

        return $body;
    }

    /**
     * @throws GuzzleException
     */
    public function post(string $url = '', array $params = []): mixed
    {
        $this->addAuthHeader($params);
        $this->addContentTypeHeader($params, 'application/json');
        $response = (new Client())->post($url, $params);

        try {
            $body = json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException) {
            return null;
        }

        return $body;
    }

    /**
     * @throws GuzzleException
     */
    public function delete(string $url = '', array $params = []): mixed
    {
        $this->addAuthHeader($params);
        $response = (new Client())->delete($url, $params);

        try {
            $body = json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException) {
            return null;
        }

        return $body;
    }

    /**
     * @throws GuzzleException
     */
    public function put(string $url = '', array $params = []): mixed
    {
        $this->addAuthHeader($params);
        $response = (new Client())->put($url, $params);

        try {
            $body = json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException) {
            return null;
        }

        return $body;
    }

    private function addAuthHeader(array &$params): void
    {
        $headers = $params['headers'] ?? [];

        if ($this->tokenType === 'PAT') {
            $headers['X-Figma-Token'] = $this->accessToken;
        } else {
            $headers['Authorization'] = 'Bearer ' . $this->accessToken;
        }

        $params['headers'] = $headers;
    }

    private function addContentTypeHeader(array &$params, string $contentType): void
    {
        $headers = $params['headers'] ?? [];
        $headers['Content-Type'] = $contentType;
        $params['headers'] = $headers;
    }
}