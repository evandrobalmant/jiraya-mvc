<?php
class Helper
{
	public function baseUrl()
	{
		return dirname($_SERVER["PHP_SELF"]);
	}
	
	public function url(array $url_path)
	{
		$url = $this->baseUrl();
		foreach ($url_path AS $key => $value)
			$url .= "/" . $value;
		return $url;
	}
}