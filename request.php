<?php
/**
 * ***************************************************************
 * Request
 * ===============================================================
 * Object Oriented Wrapper for Client URL (cURL) in PHP
 * ===============================================================
 * @author      Rahul Mac
 * @copyright   (C) April 2023 - Rahul Mac
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 *****************************************************************
 */

class Request
{
    private $options;

    function __construct($type = '', $url = '')
    {
        $this->options = array();
        $this->options[CURLOPT_URL] = $url;
        $this->options[CURLOPT_RETURNTRANSFER] = true;
        $this->options[CURLOPT_CUSTOMREQUEST] = $type;
        $this->options[CURLOPT_HTTPHEADER] = array();
        $this->options[CURLOPT_POSTFIELDS] = '';
    }

    public function setURL($url = '')
    {
        $this->options[CURLOPT_URL] = $url;
    }

    public function setType($type = '')
    {
        $this->options[CURLOPT_CUSTOMREQUEST] = $type;
    }

    public function setHeaders($headers = array())
    {
        $this->options[CURLOPT_HTTPHEADER] = $headers;
    }

    public function setData($data = '')
    {
        $this->options[CURLOPT_POSTFIELDS] = $data;
    }

    public function setOptions($options = array())
    {
        foreach($options as $key => $value)
        {
            $this->options[$key] = $value;
        }
    }

    public function clearURL()
    {
        $this->setURL();
    }

    public function clearType()
    {
        $this->setType();
    }

    public function clearHeaders()
    {
        $this->headers = array();
    }

    public function clearData()
    {
        $this->setData();
    }

    public function clearOptions()
    {
        $this->__construct();
    }

    public function getResponse()
    {
        try
        {
            $response = new stdClass;
            $cURL = curl_init();
            curl_setopt_array($cURL, $this->options);
            $response->status = true;
            $response->payload = curl_exec($cURL);
            if(curl_errno($cURL))
            {
                throw new Exception(curl_error($cURL));
            }
        }
        catch(Exception $e)
        {
			$response->status = false;
			$response->payload = $e->getMessage();
		}
		finally
		{
            curl_close($cURL);
			return $response;
		}
    }
}
?>