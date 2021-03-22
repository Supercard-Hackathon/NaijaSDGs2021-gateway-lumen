<?php

namespace App\Traits;

trait ApiResponse
{
    /**
     * Success Response
     * @param array $data
     * @param boolean $status
     * @param int $code
     * @return json
     */
    public function successResponseForMicroservice($data, $status = true, $code = \Illuminate\Http\Response::HTTP_OK)
    {
        $result = json_decode($data);

        if ($result->status == true) {
            return response(json_encode($result))->header('Content-Type', 'application/json');
        }

        return $this->errorResponseWithoutDetails($result->data, 400, $result->service);
    }

    /**
     * Success Response
     * @param array $data
     * @param boolean $status
     * @param int $code
     * @return json
     */
    public function successResponseForGateway($data, $status = true, $service = "", $code = \Illuminate\Http\Response::HTTP_OK)
    {
        if ($service == "") {
            $service = env('MICROSERVICE_NAME');
        }
        
        return response()->json(
                        [
                            'code' => $code,
                            'status' => $status,
                            'service' => $service,
                            'data' => $data
                        ], 
                        $code
                    )->header('Content-Type', 'application/json');
    }

    /**
     * Success Response
     * @param array $data
     * @param boolean $status
     * @param int $code
     * @return json
     */
    public function successResponseForGatewayWithMicroserviceData($data, $status = true, $service = "", $code = \Illuminate\Http\Response::HTTP_OK)
    {
        if ($service == "") {
            $service = env('MICROSERVICE_NAME');
        }
        
        return response()->json(
                        [
                            'code' => $code,
                            'status' => $status,
                            'service' => $service,
                            'data' => json_decode($data)
                        ], 
                        $code
                    )->header('Content-Type', 'application/json');
    }

    /**
     * Error Response With Error Details
     * @param string $message
     * @param array $errors
     * @param int $code
     * @param string $service
     * @param boolean $status
     * @return json
     */
    public function errorResponseWithDetails($message, $errors, $code, $service = "", $status = false)
    {
        if ($service == "") {
            $service = env('MICROSERVICE_NAME');
        }

        return response()->json(
                            [
                                'code' => $code,
                                'status' => $status,
                                'service' => $service,
                                'message' => $message, 
                                'errors' => array_values(collect($errors)->all())
                            ], 
                            $code
                        );
    }

    /**
     * Error Response Without Error Details
     * @param string $message
     * @param int $code
     * @param string $service
     * @param boolean $status
     * @return json
     */
    public function errorResponseWithoutDetails($message, $code, $service = "", $status = false)
    {
        if ($service == "") {
            $service = env('MICROSERVICE_NAME');
        }

        return response()->json(
                            [
                                'code' => $code,
                                'status' => $status,
                                'service' => $service,
                                'message' => $message
                            ], 
                            $code
                        );
    }

    /**
     * Error Message
     * @param string $message
     * @param int $code
     * @return json
     */
    public function errorMessage($message, $code)
    {
        return response($message, $code)->header('Content-Type', 'application/json');
    }
}