<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class GuzzleController extends Controller
{
    public function getRemoteCienciaVitaeDegrees()
    {

        $science = auth('api')->user()->science_id;

        $client = new Client(['headers' => ['Accept' => 'application/json']]);

        $request = $client->get(
            'https://qa.cienciavitae.pt/api/v1.1/curriculum/'.$science.'/degree',
            [
                'auth'          => ['IPLEIRIA_ADMIN', 'I1@5CA12LE'],
            ]
        
        );

        $data = $request->getBody()->getContents();
        
        return $data;
    }

    public function getMyCurriculum($scienceid_from_users)
    {

        $client = new Client(['headers' => ['Content-Type' => ' application/pdf']]);

        $request = $client->get(
            'https://qa.cienciavitae.pt/api/v1.1/curriculum/'.$scienceid_from_users.'/pdf?attach-xml=false&lang=User%20defined',
            [
                'auth'          => ['IPLEIRIA_ADMIN', 'I1@5CA12LE'],
            ]
        
        );
        
        $data = $request->getBody()->getContents();
        
        return $data;
    }

    public function getRemoteCienciaVitaePersonInfo()
    {
        $science = auth('api')->user()->science_id;

        $client = new Client(['headers' => ['Accept' => 'application/json']]);

        $request = $client->get(
            'https://qa.cienciavitae.pt/api/v1.1/curriculum/'.$science.'/person-info',
            [
                'auth'          => ['IPLEIRIA_ADMIN', 'I1@5CA12LE'],
            ]
        
        );

        $data = $request->getBody()->getContents();
        
        return $data;
    }

    public function getRemoteCienciaVitaeMailingAddresses()
    {

        $science = auth('api')->user()->science_id;

        $client = new Client(['headers' => ['Accept' => 'application/json']]);

        $request = $client->get(
            'https://qa.cienciavitae.pt/api/v1.1/curriculum/'.$science.'/mailing-address',
            [
                'auth'          => ['IPLEIRIA_ADMIN', 'I1@5CA12LE'],
            ]
        
        );

        $data = $request->getBody()->getContents();
        
        return $data;
    }

    public function getRemoteCienciaVitaeOutputs()
    {

        $science = auth('api')->user()->science_id;

        $client = new Client(['headers' => ['Accept' => 'application/json']]);

        $request = $client->get(
            'https://qa.cienciavitae.pt/api/v1.1/curriculum/'.$science.'/output',
            [
                'auth'          => ['IPLEIRIA_ADMIN', 'I1@5CA12LE'],
            ]
        
        );

        $data = $request->getBody()->getContents();

        //$data = collect($data)->values()->toArray();//->paginate(10);
        //$data = $this->paginate($data,10);
        //return response()->json($data,402);
        
        return $data;
    }

    public function paginate($items, $perPage, $page = null, $options = []) { 
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1); 
        $items = $items instanceof Collection ? $items : Collection::make($items); 
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options); 
    }

    public function getRemoteCienciaVitaePhones()
    {

        $science = auth('api')->user()->science_id;

        $client = new Client(['headers' => ['Accept' => 'application/json']]);

        $request = $client->get(
            'https://qa.cienciavitae.pt/api/v1.1/curriculum/'.$science.'/phone-number',
            [
                'auth'          => ['IPLEIRIA_ADMIN', 'I1@5CA12LE'],
            ]
        
        );

        $data = $request->getBody()->getContents();
        
        return $data;
    }

    public function getRemoteCienciaVitaeOutputs_By_Id($id)
    {

        $client = new Client(['headers' => ['Accept' => 'application/json']]);

        $request = $client->get(
            'https://qa.cienciavitae.pt/api/v1.1/curriculum/'.$id.'/output',
            [
                'auth'          => ['IPLEIRIA_ADMIN', 'I1@5CA12LE'],
            ]
        
        );

        $data = $request->getBody()->getContents();
        
        return $data;
    }

    public function getRemoteCienciaVitaeWeb()
    {

        $science = auth('api')->user()->science_id;

        $client = new Client(['headers' => ['Accept' => 'application/json']]);

        $request = $client->get(
            'https://qa.cienciavitae.pt/api/v1.1/curriculum/'.$science.'/web-address',
            [
                'auth'          => ['IPLEIRIA_ADMIN', 'I1@5CA12LE'],
            ]
        
        );

        $data = $request->getBody()->getContents();
        
        return $data;
    }

    public function getRemoteCienciaVitaePrivileges()
    {

        $science = auth('api')->user()->science_id;

        $client = new Client(['headers' => ['Accept' => 'application/json']]);

        $request = $client->get(
            'https://qa.cienciavitae.pt/api/v1.1/api-user/'.$science.'/access-privileges',
            [
                'auth'          => ['IPLEIRIA_ADMIN', 'I1@5CA12LE'],
            ]
        
        );

        $data = $request->getBody()->getContents();
        
        return $data;
    }

    public function getRemoteCienciaVitaeAuthor()
    {

        $science = auth('api')->user()->science_id;

        $client = new Client(['headers' => ['Accept' => 'application/json']]);

        $request = $client->get(
            'https://qa.cienciavitae.pt/api/v1.1/curriculum/'.$science.'/author-identifier',
            [
                'auth'          => ['IPLEIRIA_ADMIN', 'I1@5CA12LE'],
            ]
        
        );

        $data = $request->getBody()->getContents();
        
        return $data;
    }

    public function getRemoteCienciaVitaeCitation()
    {

        $science = auth('api')->user()->science_id;

        $client = new Client(['headers' => ['Accept' => 'application/json']]);

        $request = $client->get(
            'https://qa.cienciavitae.pt/api/v1.1/curriculum/'.$science.'/citation-name',
            [
                'auth'          => ['IPLEIRIA_ADMIN', 'I1@5CA12LE'],
            ]
        
        );

        $data = $request->getBody()->getContents();
        
        return $data;
    }

    public function getRemoteCienciaVitaeLanguageCompetency()
    {

        $science = auth('api')->user()->science_id;

        $client = new Client(['headers' => ['Accept' => 'application/json']]);

        $request = $client->get(
            'https://qa.cienciavitae.pt/api/v1.1/curriculum/'.$science.'/language-competency',
            [
                'auth'          => ['IPLEIRIA_ADMIN', 'I1@5CA12LE'],
            ]
        
        );

        $data = $request->getBody()->getContents();
        
        return $data;
    }

    public function getRemoteCienciaVitaeEmployment()
    {

        $science = auth('api')->user()->science_id;

        $client = new Client(['headers' => ['Accept' => 'application/json']]);

        $request = $client->get(
            'https://qa.cienciavitae.pt/api/v1.1/curriculum/'.$science.'/employment',
            [
                'auth'          => ['IPLEIRIA_ADMIN', 'I1@5CA12LE'],
            ]
        
        );

        $data = $request->getBody()->getContents();
        
        return $data;
    }

    public function getRemoteCienciaVitaeGroups()
    {

        $science = auth('api')->user()->science_id;

        $client = new Client(['headers' => ['Accept' => 'application/json']]);

        $request = $client->get(
            'https://qa.cienciavitae.pt/api/v1.1/curriculum/'.$science.'/groups',
            [
                'auth'          => ['IPLEIRIA_ADMIN', 'I1@5CA12LE'],
            ]
        
        );

        $data = $request->getBody()->getContents();
        
        return $data;
    }

}

