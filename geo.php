<?php 

class geo
{
	
	protected $api= 'http://ip-api.com/json/%s';
	protected $addr_api='http://maps.googleapis.com/maps/api/geocode/json?latlng=%s,%s&sensor=false';
	//protected $addr_api='https://ctrlq.org/maps/address/#%s,%s';
    


    protected  $properties=[];
    protected  $address=[];


    public function request($ip)
    {

          $url=sprintf($this->api,$ip);
          $data=$this->sendRequest($url);
         
          $this->properties=json_decode($data, true);
          
          
          return  $this->properties;


    }


    public function addressrequest($lat,$long)
    {

    	$url=sprintf($this->addr_api,$lat,$long);
    	//echo $url;
    	$data=$this->sendRequest($url);
        $this->address=json_decode($data, true);
          
        return  $this->address;


    }



    protected function sendRequest($url)
    {

    	$curl=curl_init();
    	curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
    	curl_setopt($curl,CURLOPT_URL, $url);


    	return curl_exec($curl);
    }




	function getUserIP()
		{
		    $client  = @$_SERVER['HTTP_CLIENT_IP'];
		    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
		    $remote  = $_SERVER['REMOTE_ADDR'];

		    if(!empty($client))
		    {
		        $ip = $client;
		    }
		    elseif(!empty($forward))
		    {
		        $ip = $forward;
		    }
		    else
		    {
		        $ip = $remote;
		    }

		    return $ip;
		}








}





 ?>