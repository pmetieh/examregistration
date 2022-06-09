<?php
// Copyright (c) Microsoft Corporation.
// Licensed under the MIT License.

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\TokenStore\TokenCache;
use Illuminate\Http\Request;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;

class AuthController extends Controller
{
  public function signin()
  {
    // Initialize the OAuth client
    $oauthClient = new \League\OAuth2\Client\Provider\GenericProvider([
      'clientId'                => env('OAUTH_APP_ID'),
      'clientSecret'            => env('OAUTH_APP_PASSWORD'),
      'redirectUri'             => env('OAUTH_REDIRECT_URI'),
      'urlAuthorize'            => env('OAUTH_AUTHORITY').env('OAUTH_AUTHORIZE_ENDPOINT'),
      'urlAccessToken'          => env('OAUTH_AUTHORITY').env('OAUTH_TOKEN_ENDPOINT'),
      'urlResourceOwnerDetails' => '',
      'scopes'                  => env('OAUTH_SCOPES')
    ]);

   // var_dump($oauthClient);
   // dd($oauthClient);
   // dd($oauthClient->getBaseAuthorizationUrl());

    $authUrl = $oauthClient->getAuthorizationUrl();
    //dd($authUrl);
   // dd($oauthClient->getState());
    // Save client state so we can validate in callback
    session(['oauthState' => $oauthClient->getState()]);
   // dd(session('oauthState'));
    // Redirect to AAD signin page
    return redirect()->away($authUrl);
  }

  public function callback(Request $request)
  {

    // dd('Within Callback Function');
      // Validate state
      $expectedState = session('oauthState');
      //dd($expectedState);
      $request->session()->forget('oauthState');
      $providedState = $request->query('state');
    // dd('ProvidedState  '.$providedState);
      /**/
      if (!isset($expectedState)) {
        //dd('ExpextedState '.$expectedState);
        // If there is no expected state in the session,
        // do nothing and redirect to the home page.
        return redirect('/');
    }

    if (!isset($providedState) || $expectedState != $providedState) {
      return redirect('/')
        ->with('error', 'Invalid auth state')
        ->with('errorDetail', 'The provided auth state did not match the expected value');
    }

    // Authorization code should be in the "code" query param
    $authCode = $request->query('code');
    //dd($authCode);
    if (isset($authCode)) {
      // Initialize the OAuth client
      $oauthClient = new \League\OAuth2\Client\Provider\GenericProvider([
        'clientId'                => env('OAUTH_APP_ID'),
        'clientSecret'            => env('OAUTH_APP_PASSWORD'),
        'redirectUri'             => env('OAUTH_REDIRECT_URI'),
        'urlAuthorize'            => env('OAUTH_AUTHORITY').env('OAUTH_AUTHORIZE_ENDPOINT'),
        'urlAccessToken'          => env('OAUTH_AUTHORITY').env('OAUTH_TOKEN_ENDPOINT'),
        'urlResourceOwnerDetails' => '',
        'scopes'                  => env('OAUTH_SCOPES')
      ]);
//dd($oauthClient);
      // <StoreTokensSnippet>
      try {
        // Make the token request
        $accessToken = $oauthClient->getAccessToken('authorization_code', [
          'code' => $authCode
        ]);
     //  dd($accessToken);
        $graph = new Graph();
        $graph->setAccessToken($accessToken->getToken());

        //$user = $graph->createRequest('GET', '/users')
        $user = $graph->createRequest('GET', '/me')
          ->setReturnType(Model\User::class)
          ->execute();


dd($user);
        $tokenCache = new TokenCache();
        $tokenCache->storeTokens($accessToken, $user);

        return redirect('/');
      }
      // </StoreTokensSnippet>
      catch (League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
        return redirect('/')
          ->with('error', 'Error requesting access token')
          ->with('errorDetail', $e->getMessage());
      }
    }

    return redirect('/')
      ->with('error', $request->query('error'))
      ->with('errorDetail', $request->query('error_description'));
  }

  // <SignOutSnippet>
  public function signout()
  {
    $tokenCache = new TokenCache();
    $tokenCache->clearTokens();
    return redirect('/');
  }
  // </SignOutSnippet>
}
