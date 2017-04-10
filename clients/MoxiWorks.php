<?php
namespace yii\authclient\clients;

use yii\authclient\OAuth2;

class MoxiWorks extends OAuth2
{
	/**
	 * @inheritdoc
	 */
	public $authUrl = "https://sso.moxiworks.com/oauth/authorize";
	/**
	 * @inheritdoc
	 */
	public $tokenUrl = "https://sso.moxiworks.com/oauth/token";
	/**
	 * @inheritdoc
	 */
	public $apiBaseUrl = "https://sso.moxiworks.com";
	/**
	 * @var array list of attribute names, which should be requested from API to initialize user attributes.
	 * @since 2.0.4
	 */
	public $attributeNames = ["user_id", "display_name", "email", "company_name"];

	/**
	 * @inheritdoc
	 */
	protected function apiInternal($accessToken, $url, $method, $params, array $headers) {
		$headers[] = "Authorization: Bearer " . $accessToken->getToken();
		return $this->sendRequest($method, $url, $params, $headers);
	}

	/**
	 * @inheritdoc
	 */
	protected function initUserAttributes() {
		return $this->api("agent/profile", "GET");
	}

	/**
	 * @inheritdoc
	 */
	protected function defaultName() {
		return "moxiworks";
	}

	/**
	 * @inheritdoc
	 */
	protected function defaultTitle() {
		return "MoxiWorks";
	}
}
?>