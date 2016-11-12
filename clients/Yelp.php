<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\authclient\clients;

use yii\authclient\OAuth1;
use yii\authclient\OAuthToken;
use Yii;

/**
 * Yelp allows authentication via Yelp OAuth.
 *
 * In order to use Yelp OAuth you must register your api access at <https://www.yelp.com/developers/v2/manage_api_keys>.
 *
 * Example application configuration:
 *
 * ~~~
 * 'components' => [
 *     'authClientCollection' => [
 *         'class' => 'yii\authclient\Collection',
 *         'clients' => [
 *             'yelp' => [
 *                 'class' => 'yii\authclient\clients\Yelp',
 *
 *                 'consumerKey' => 'yelp_consumer_key',
 *                 'consumerSecret' => 'yelp_comsumer_secret',    //tokenSecretParamKey
 *                 'token' => 'token',
 *                 'tokenSecret' => 'token_secret'
 *
 *             ],
 *         ],
 *     ]
 *     ...
 * ]
 * ~~~
 * use yii\authclient\clients\Yelp;
 *
 * $client = new Yelp();
 * $accessToken = $client->fetchAccessToken(); // get access token
 * $response = $client->api('url','GET',$params = []);
 *
 * @author Steve Morocho <idsp@yahoo.com>
 * @since 2.0
 */
class Yelp extends OAuth1
{

	public $apiBaseUrl = 'https://api.yelp.com/v2';

	public $token;
	public $tokenSecret;

	/**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }

    /**
     * Fetches the OAuth request token.
     * @param array $params additional request params.
     * @return OAuthToken request token.
     */
    public function fetchRequestToken(array $params = [])
    {
		return null;
    }

    /**
     * @inheritdoc
     */
    public function buildAuthUrl()
    {
    	return null;
    }

    /**
     * @inheritdoc
     */
    public function fetchAccessToken(OAuthToken $requestToken = null, $oauthVerifier = null, array $params = [])
    {
    	$this->removeState('requestToken');
    	$tokenConfig = [
    		'class' => OAuthToken::className(),
    		'tokenParamKey' => $this->token,
    		'tokenSecretParamKey' => $this->tokenSecret,
    	];
    	$token = Yii::createObject($tokenConfig);
    	$this->setAccessToken($token);

    	return $token;
    }

    /**
     * @inheritdoc
     */
    protected function defaultName()
    {
        return 'yelp';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle()
    {
        return 'Yelp';
    }

}
