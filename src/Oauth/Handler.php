<?php

namespace Phox\Phigma\Oauth;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

readonly class Handler
{
    /**
     * @link https://www.figma.com/developers/api#auth-oauth2 Figma API reference
     * @link https://www.figma.com/developers/apps Figma app platform
     * @param string $id Figma API client id
     * @param string $redirectUri The auth page will call this URI when the user allows access to your app. This must be defined in your Figma app's OAuth 2.0 redirect URLs list.
     * @param array $scopes Scopes determine which endpoints can be accessed. Reference the constants defined in \Phox\Phigma\Strings\AccessTokenScopes
     * @param string $state A randomly generated value. Check that the state value returned when the redirect is triggered matches this state value that you provide
     * @param string $responseType Currently the only valid value for this is 'code'
     * @param string|null $challenge Optional S256-generated code challenge
     * @return string A link for a user to navigate to which prompts them to give your app access
     */
    public static function createAuthUrl(
        string $id,
        string $redirectUri,
        array $scopes,
        string $state,
        string $responseType,
        string $challenge = null,
    ): string {
        $parameters = [
            'client_id' => $id,
            'redirect_uri' => $redirectUri,
            'scope' => implode(',', $scopes),
            'state' => $state,
            'response_type' => $responseType,
        ];

        if ($challenge) {
            $parameters['code_challenge'] = $challenge;
        }

        $query = http_build_query($parameters);
        return "https://www.figma.com/oauth?{$query}";
    }

    /**
     * @link https://www.figma.com/developers/api#auth-oauth2 Figma API reference
     * @param string $id Figma API client id
     * @param string $secret Figma API client secret
     * @param string $redirectUri This must match the URL provided to createAuthUrl
     * @param string $code The code value returned in the query parameters when the redirect callback triggered
     * @param string $grantType Currently the only valid value for this is 'authorization_code'
     * @param string|null $codeVerifier The verifier used if a challenge was provided to createAuthUrl
     * @return Token A token instance
     * @throws GuzzleException
     * @throws JsonException
     */
    public static function getAccessToken(
        string $id,
        string $secret,
        string $redirectUri,
        string $code,
        string $grantType,
        string $codeVerifier = null,
    ): Token {
        $http = new HttpClient();
        $headers = [
            'Authorization' => 'Basic ' . base64_encode("{$id}:{$secret}"),
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];
        $query = [
            'grant_type' => $grantType,
            'code' => $code,
            'code_verifier' => $codeVerifier,
            'redirect_uri' => $redirectUri,
        ];
        $requestOptions = [
            'headers' => $headers,
            'query' => $query,
        ];

        $response = $http->post(
            'https://api.figma.com/v1/oauth/token',
            $requestOptions,
        );

        $body = json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR);

        return new Token(
            $body['user_id'],
            $body['access_token'],
            $body['refresh_token'],
            $body['expires_in'],
        );
    }


    /**
     * @link https://www.figma.com/developers/api#refresh-oauth2 Figma API reference
     * @param string $id Figma API client id
     * @param string $secret Figma API client secret
     * @param string $refreshToken Your user's refresh token
     * @return Token A token instance
     * @throws GuzzleException
     * @throws JsonException
     */
    public static function refreshAccessToken(
        string $id,
        string $secret,
        string $refreshToken
    ): Token {
        $http = new HttpClient();
        $headers = [
            'Authorization' => 'Basic ' . base64_encode("{$id}:{$secret}"),
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];
        $query = [
            'refresh_token' => urlencode($refreshToken),
        ];
        $requestOptions = [
            'headers' => $headers,
            'query' => $query,
        ];

        $response = $http->post(
            'https://api.figma.com/v1/oauth/refresh',
            $requestOptions,
        );

        $body = json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR);
        return new Token(
            null,
            $body['access_token'],
            $refreshToken,
            $body['expires_in'],
        );
    }
}