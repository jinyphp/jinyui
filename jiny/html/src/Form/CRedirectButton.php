<?php
namespace Jiny\Html\Form;

use Jiny\Html\CUrl;

/**
 * A class for creating buttons that redirect you to a different page.
 */
class CRedirectButton extends CSimpleButton {

	/**
	 * @param string      $caption
	 * @param string|CUrl $url           URL to redirect to
	 * @param string      $confirmation  confirmation message text
	 */
	public function __construct($caption, $url, $confirmation = null) {
		parent::__construct($caption);

		$this->setUrl($url, $confirmation);
	}

	/**
	 * Set the URL and confirmation message.
	 *
	 * If the confirmation is set, a confirmation pop up will appear before redirecting to the URL.
	 *
	 * @param string|CUrl $url
	 * @param string|null $confirmation
	 *
	 * @return CRedirectButton
	 */
	public function setUrl($url, $confirmation = null) {
		if ($url instanceof CUrl) {
			$url = $url->getUrl();
		}

		$this->setAttribute('data-url', $url);

		if ($confirmation !== null) {
			$this->setAttribute('data-confirmation', $confirmation);
		}
		return $this;
	}
}
