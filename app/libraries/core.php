<?php

/**
 * Core Class
 * 
 * Set the controller, method and params
 */
class Core {
	protected $currentController = 'Pages';
	protected $currentMethod = 'index';
	protected $params = [];
	
	/**
	 * __construct
	 *
	 * Set current controller, method and params
	 */
	public function __construct() {
		$url = $this->getUrl();

		# Set Current Controller
		// 1. set first value of url become controller as a string
		if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
			// if exist, set current controller as a string
			$this->currentController = ucwords($url[0]);
			// unset index 0
			unset($url[0]);
		}
		// 2. require file controller from folder controllers
		require_once '../app/controllers/' . $this->currentController . '.php'; 
		// 3. instantiate controller, set current controller as a object
		$this->currentController = new $this->currentController;
	}

	/**
	 * getUrl
	 *
	 * Get the value of url
	 */
	public function getUrl() {
		if (isset($_GET['url'])) {
			// get value of url and remove '/' at the end
			$url = rtrim($_GET['url'], '/');
			// filter url, if not url, it will show error
			$url = filter_var($url, FILTER_SANITIZE_URL);
			// explode str to array
			$url = explode('/', $url);

			return $url;
		}
	}
}