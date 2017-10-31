<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class Patient extends Model
{
    public static function import($xml){

    	$patient = new Patient;
    	
    	$json = $patient->callApi($xml);


    	return $patient->createPatientFromJson($json);

    	


    	
    }

    private function callApi($xml){

                /**
         * Sends a CCDA as an XML string to the parsing api. 
         * 
         * @param $xml
         *
         * @return string|array
         */





        $client = new Client([
        'base_uri' => env('CCD_PARSER_BASE_URI', 'https://circlelink-ccd-parser.medstack.net'),
        ]);

        $response = $client->request('POST', '/ccda/parse', [
        'headers' => ['Content-Type' => 'text/xml'],
        'body'    => $xml,
        ]);

        if (!$response->getStatusCode() == 200) {
        return [
            $response->getStatusCode(),
            $response->getReasonPhrase(),
        ];





    	//new guzzle (docume)
    	//post request opws postmal header xml body=request
    	//piannw output p to response, kamnw to variable->jsondecode(gmail), php, piannw pisw object kamnw return


    }

    private function createPatientFromJson($json){

    	return "ok";



    	//create a patient mesto database, jie problems se allo table (Condition Model)


    }
}
