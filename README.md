A PHP SDK for interacting with Figma's REST API

## Usage
### Authentication
In order to start using the Figma API, you must first acquire an access token. 
This can either be a [Personal Access Token](https://www.figma.com/developers/api#access-tokens) or an OAuth2 token
#### PAT flow
Once you have your Personal Access Token, a Phigma client object to send authenticated requests through can be instantiated
```php
use Phox\Phigma\Client;

$accessToken = 'YOUR_PERSONAL_ACCESS_TOKEN';
$client = new Client(accessToken: $accessToken, tokenType: 'PAT');
```

#### OAuth2 flow
In order to get an OAuth2 token a user must agree to allow your app to act on their behalf. 

First, in your app's settings in the [developer dashboard](https://www.figma.com/developers/apps), add a redirect URL for your app.

You can then create a link to a Figma authorisation confirmation page for your users
```php
use Phox\Phigma\Oauth\Handler;
use Phox\Phigma\Strings\AccessTokenScopes;

$clientId = 'YOUR_FIGMA_CLIENT_ID';
$clientSecret = 'YOUR_FIGMA_CLIENT_SECRET';
$redirectUri = 'YOUR_CALLBACK_URL';
$scopes = [
    AccessTokenScopes::FILE_VARIABLES_READ,
    AccessTokenScopes::FILE_VARIABLES_WRITE,
    AccessTokenScopes::FILES_READ,
    AccessTokenScopes::FILE_COMMENTS_WRITE,
];
$stateValue = 'RANDOM_STRING';

Handler::createAuthUrl(
    id: $clientId,
    redirectUri: $redirectUri,
    scopes: $scopes,
    state: $stateValue,
    responseType: 'code',
);
```
Direct your users to this link.
After a user authorises your app through this link, they will be redirected to your `$redirectUri`, along with two query parameters 'code' and 'state'.

For example, if the supplied redirect URI was `https://api.example.com/figma-connection`, the user will be redirected to `https://api.example.com/figma-connection?code=codeValue&state=stateValue`

Verify that the state value returned in this response matches the state value you supplied.

Using the returned code value, you can now request an OAuth2 access token to instantiate the Phigma client object with.
```php
use Phox\Phigma\Oauth\Handler;
use Phox\Phigma\Client;

$clientId = 'YOUR_FIGMA_CLIENT_ID';
$clientSecret = 'YOUR_FIGMA_CLIENT_SECRET';
$redirectUri = 'YOUR_CALLBACK_URL';
$code = 'RETURNED_CODE_VALUE';

$token = Handler::getAccessToken(
    id: $clientId,
    secret: $clientSecret,
    redirectUri: $redirectUri,
    code: $code,
    grantType: 'authorization_code',
);

// Store the token and related data in your database for reuse
$userId = $token->getUserId();
$accessToken = $token->getAccessToken();
$refreshToken = $token->getRefreshToken();
$expiresAt = $token->getExpiresAt(); // $token->getExpiresIn() is also available

$client = new Client(accessToken: $accessToken, tokenType: 'OAuth2');
```

When the token expires you can use the refresh token to generate a new access token
```php
use Phox\Phigma\Oauth\Handler;

$clientId = 'YOUR_FIGMA_CLIENT_ID';
$clientSecret = 'YOUR_FIGMA_CLIENT_SECRET';
$refreshToken = 'YOUR_REFRESH_TOKEN';

$token = Handler::refreshAccessToken(
    id: $clientId,
    secret: $clientSecret,
    refreshToken: $refreshToken,
);

// Replace your stored token values with these
$accessToken = $token->getAccessToken();
$refreshToken = $token->getRefreshToken();
$expiresAt = $token->getExpiresAt(); // Or $token->getExpiresIn()
```

