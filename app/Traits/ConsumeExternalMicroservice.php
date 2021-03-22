<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait ConsumeExternalMicroservice
{
    /**
     * Send request to any service
     * @param $method
     * @param $requestUrl
     * @param array $formParams
     * @param array $headers
     * @return string
     */
    public function performRequest($method, $uriPrefix, $requestUrl, $formParams = [], $headers = [])
    {
        $client = new Client([
            'base_uri'  =>  $this->baseUri,
        ]);

        if(isset($this->secret))
        {
            $headers['Authorization'] = $this->secret;
        }

        // concatenate microservice prefix with request url e.g. /clinic/patient/all where /clinic is the microservice and /patient/all is the request url
        $requestUrl = "/".$uriPrefix.$requestUrl;

        $response = $client->request($method, $requestUrl, [
            'json' => $formParams,
            'headers'     => $headers,
        ]);

        return $response->getBody()->getContents();
    }

    /**
     * Send request to any service
     * @param $method
     * @param $requestUrl
     * @param array $formParams
     * @param array $headers
     * @return string
     */
    public function performRequestWithFileUpload($method, $uriPrefix, $requestUrl, $formParams = [], $headers = [])
    {
        $client = new Client([
            'base_uri'  =>  $this->baseUri,
        ]);

        if(isset($this->secret))
        {
            $headers['Authorization'] = $this->secret;
        }

        $outputArray = explode('&', urldecode(http_build_query($formParams->all())));

        $postData = [];

        foreach ($outputArray as $data) {
            list($key, $value) = explode('=', $data);
            $postData[] = ['name' => $key, 'contents' => $value];
        }

        $fileDetails1 = [
                    'name'     => 'file',
                    'contents' => file_get_contents($formParams->file->getRealPath()),
                    'filename'  => $formParams->filepath,
                ];

        $fileDetails2 = [
                    'name'     => 'authorization',
                    'contents' => $this->secret,
                ];

        $fileDetails3 = [
                    'name'     => 'fileOriginalExtension',
                    'contents' => $formParams->file->getClientOriginalExtension(),
                ];

        array_push($postData, $fileDetails1, $fileDetails2, $fileDetails3);

        // concatenate microservice prefix with request url e.g. /clinic/patient/all where /clinic is the microservice and /patient/all is the request url
        $requestUrl = "/".$uriPrefix.$requestUrl;

        $response = $client->request($method, $requestUrl, [
            'headers' => ['Authorization' => $headers],
            'multipart' => $postData,
        ]);

        return $response->getBody()->getContents();
    }
}