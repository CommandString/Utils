<?php

namespace CommandString\Utils;

/**
 * A simple HTTP client.
 * 
 * @package CommandString\Utils
 */
class HttpUtils
{

    /**
     * Performs a GET request.
     *
     * @param string $url The URL to send the GET request to.
     * @param array $headers The headers to include in the request.
     * @return string The response body.
     */
    public static function get(string $url, array $headers = []): string
    {
        $curl = curl_init($url);
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    /**
     * Performs a POST request.
     * 
     * @param string $url The URL to send the POST request to.
     * @param array $data The data to include in the request body.
     * @param array $headers The headers to include in the request.
     * @return string The response body.
     */
    public static function post(string $url, array $data, array $headers = []): string
    {
        $curl = curl_init($url);
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_HTTPHEADER => $headers,
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    /**
     * Performs a POST request with JSON data.
     * 
     * @param string $url The URL to send the POST request to.
     * @param array $data The data to include in the request body as JSON.
     * @param array $headers The headers to include in the request.
     * @return string The response body.
     */
    public static function postJson(string $url, array $data, array $headers = []): string
    {
        $curl = curl_init($url);
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array_merge($headers, ['Content-Type: application/json']),
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }


    /**
     * Performs a PUT request.
     * 
     * @param string $url The URL to send the PUT request to.
     * @param array $data The data to include in the request body.
     * @param array $headers The headers to include in the request.
     * @return string The response body.
     */
    public static function put(string $url, array $data, array $headers = []): string
    {
        $curl = curl_init($url);
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_HTTPHEADER => $headers,
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    /**
     * Performs a PUT request with JSON data.
     * 
     * @param string $url The URL to send the PUT request to.
     * @param array $data The data to include in the request body as JSON.
     * @param array $headers The headers to include in the request.
     * @return string The response body.
     */
    public static function putJson(string $url, array $data, array $headers = []): string
    {
        $curl = curl_init($url);
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array_merge($headers, ['Content-Type: application/json']),
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    /**
     * Performs a PATCH request.
     * 
     * @param string $url The URL to send the PATCH request to.
     * @param array $data The data to include in the request body.
     * @param array $headers The headers to include in the request.
     * @return string The response body.
     */
    public static function patch(string $url, array $data, array $headers = []): string
    {
        $curl = curl_init($url);
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "PATCH",
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_HTTPHEADER => $headers,
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    /**
     * Performs a PATCH request with JSON data.
     * 
     * @param string $url The URL to send the PATCH request to.
     * @param array $data The data to include in the request body as JSON.
     * @param array $headers The headers to include in the request.
     * @return string The response body.
     */
    public static function patchJson(string $url, array $data, array $headers = []): string
    {
        $curl = curl_init($url);
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "PATCH",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array_merge($headers, ['Content-Type: application/json']),
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    /**
     * Performs a DELETE request.
     * 
     * @param string $url The URL to send the DELETE request to.
     * @param array $headers The headers to include in the request.
     * @return string The response body.
     */
    public static function delete(string $url, array $headers = []): string
    {
        $curl = curl_init($url);
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "DELETE",
            CURLOPT_HTTPHEADER => $headers,
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
}
