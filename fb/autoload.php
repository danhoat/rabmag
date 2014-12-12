<?php
session_start();
/**
 * Copyright 2014 Facebook, Inc.
 *
 * You are hereby granted a non-exclusive, worldwide, royalty-free license to
 * use, copy, modify, and distribute this software in source code or binary
 * form for use in connection with the web services and APIs provided by
 * Facebook.
 *
 * As with any software that integrates with the Facebook platform, your use
 * of this software is subject to the Facebook Developer Principles and
 * Policies [http://developers.facebook.com/policy/]. This copyright notice
 * shall be included in all copies or substantial portions of the software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
 * THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
 * DEALINGS IN THE SOFTWARE.
 *
 */

/**
 * You only need this file if you are not using composer.
 * Why are you not using composer?
 * https://getcomposer.org/
 */

if (version_compare(PHP_VERSION, '5.4.0', '<')) {
  throw new Exception('The Facebook SDK v4 requires PHP version 5.4 or higher.');
}
//649507738451547
//94ebe965e049db4b9bbecc15b3d0c6fe
//1ba1b0cd7fc7f6b00996b7337e77c6f7
/**
 * Register the autoloader for the Facebook SDK classes.
 * Based off the official PSR-4 autoloader example found here:
 * https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader-examples.md
 *
 * @param string $class The fully-qualified class name.
 * @return void
 */

require_once( 'src/Facebook/FacebookSession.php' );
require_once( 'src/Facebook/FacebookRedirectLoginHelper.php' );
require_once( 'src/Facebook/FacebookRequest.php' );
require_once( 'src/Facebook/FacebookResponse.php' );
require_once( 'src/Facebook/FacebookSDKException.php' );
require_once( 'src/Facebook/FacebookRequestException.php' );
require_once( 'src/Facebook/FacebookAuthorizationException.php' );
require_once( 'src/Facebook/GraphObject.php' );

require_once( 'src/Facebook/HttpClients/FacebookCurl.php' );
require_once( 'src/Facebook/HttpClients/FacebookHttpable.php' );
require_once( 'src/Facebook/HttpClients/FacebookCurlHttpClient.php');


use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;
use Facebook\HttpClients;
// init app with app id (APPID) and secret (SECRET)
FacebookSession::setDefaultApplication('649507738451547','94ebe965e049db4b9bbecc15b3d0c6fe');
$appId = '649507738451547';
$appSecret = '94ebe965e049db4b9bbecc15b3d0c6fe';
// login helper with redirect_uri
$helper = new FacebookRedirectLoginHelper( 'http://rabthemes.com/' );
$session = new FacebookSession('1ba1b0cd7fc7f6b00996b7337e77c6f7');
var_dump($session);
try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
	var_dump($ex);
  // When Facebook returns an error
} catch( Exception $ex ) {
	var_dump($ex);
  // When validation fails or other local issues
}
var_dump($_SESSION);
 // $t = new FacebookSession( $_SESSION['FBRLH_state'] );
 // var_dump($t);
var_dump($session);
if($session){
  
   echo '<a href="' . $helper->getLogoutUrl(wp_logout_url()) . '">Log out</a>';
   var_dump($session);
} else {
   echo '<a href="' . $helper->getLoginUrl( array('scope' => 'publish_actions,manage_pages')) . '">Login</a>';
}

?>
