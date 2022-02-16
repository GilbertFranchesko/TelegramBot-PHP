<?php


class StykovkaAPI
{
    private $URL = "https://femzone.space/";

    public function initStore($tg_token)   
    {
        $requestParams = array(
            "tg_token" => $tg_token
        );
        $request = $this->RestRequest("store", "initialBot", $requestParams);
        return $request;    
    }





    private function RestRequest($controller, $action, $body)
	{

        $modifyURL = $this->URL.$controller."/".$action;

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $modifyURL,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => $type,
		  CURLOPT_POSTFIELDS => json_encode($body)
		));

		$response = curl_exec($curl);

		curl_close($curl);

		return json_decode($response);
	}
}