<?php 
class APIBaseClass {
 
	// API base URL.
	protected $base_url;

	// cURL handle used to make API request.
	protected $ch;

	// API output and info.
	protected $output;
	protected $info;

	/**
	 * Class constructor.
	 * @param string $base_url
	 * @return null
	 */
	protected function __construct($base_url) {
		$this->base_url = $base_url;
		$this->ch = curl_init();
	}

	/**
	 * Get the output of a cURL request.
	 * @return string
	 * 
	 */
	public function getOutput() {
		return $this->output;
	}

	/**
	 * Get information about the last cURL request made.
	 * @return string
	 */
	public function getInfo() {
		return $this->info;
	}

	/**
	 * Method to log API request outcome.
	 * Can be overriden in derived classes for custom logging.
	 * @param string $logFile
	 * @param string $message
	 * @return null
	 */
	protected function logResults($logFile, $message) {
		$loghandle = fopen($logFile, 'a');
		fwrite($loghandle, date("F j, Y, g:i a").": API response from ".$this->base_url." = ".$message."\n");
		fclose($loghandle);
	}

	/**
	 * Class destructor.
	 *
	 */
	protected function __destruct() {
		curl_close($this->ch);
	}
}