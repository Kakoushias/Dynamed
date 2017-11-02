<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Condition;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;



class Patient extends Model
{
    protected $fillable = ['name', 'adress'];

    public function conditions() {

        return $this->belongsToMany(Condition::class, 'condition_patient', 'patient_id', 'condition_id');
    }




    public static function import($xml){

    	$patient = new Patient;
    	
    	$json = $patient->callApi($xml);

        //dd($json);
        //dd((string)$json);


    	return $patient->createPatientFromJson($json);

    	


    	
    }

    private function callApi($xml)
    {

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

        //dd((string)$response->getBody());

        //if response is not ok

        if ($response->getStatusCode() != 200) {
        return [
            $response->getStatusCode(),
            $response->getReasonPhrase(),
        ];
        }



        return (string)$response->getBody() ? json_decode((string)$response->getBody()) : false;

    	//new guzzle (docume)
    	//post request opws postmal header xml body=request
    	//piannw output p to response, kamnw to variable->jsondecode(gmail), php, piannw pisw object kamnw return


    }

    private function createPatientFromJson($json){

    	//return "ok";

        $patient = new Patient();
       
        $name = $json->demographics->name->given[0];
        $adress = $json->demographics->address->street[0];
      


        $patient->name = $name;
        $patient->adress = $adress;
        $patient->save();

        $condition = new Condition();
        $condition_name = $json->results[9]->name;

        $condition->name = $condition_name;
        $condition->patient_id = $patient->id;
        $condition->save();

        $patient->conditions()->attach($condition->id);

        
        






    	//create a patient mesto database, jie problems se allo table (Condition Model)


    }
}
