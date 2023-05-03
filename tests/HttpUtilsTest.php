<?php

namespace Tests\CommandString\Utils;

use CommandString\Utils\HttpUtils;
use PHPUnit\Framework\TestCase;

class HttpUtilsTest extends TestCase
{
    const HTTPBIN_URL = "https://httpbin.org";

    public function testGetRequest(): void
    {
        $response = json_decode(HttpUtils::get(self::HTTPBIN_URL . "/get"), true);
        $this->assertEquals(self::HTTPBIN_URL . "/get", $response["url"], "GET request failed");

        $response = json_decode(HttpUtils::get(self::HTTPBIN_URL . "/get?test=1"), true);
        $this->assertEquals('1', $response["args"]['test'], "GET request failed with query string");
    }

    public function testPostRequest(): void
    {
        $response = json_decode(HttpUtils::post(self::HTTPBIN_URL . "/post", ["test" => 1]), true);
        $this->assertEquals('1', $response["form"]['test'], "POST request failed");

        $response = json_decode(HttpUtils::post(self::HTTPBIN_URL . "/post?test=1", ["test" => 2]), true);
        $this->assertEquals('1', $response["args"]['test'], "POST request failed with query string");
        $this->assertEquals('2', $response["form"]['test'], "POST request failed with query string");
    }

    public function testPostJsonRequest(): void
    {
        $response = json_decode(HttpUtils::postJson(self::HTTPBIN_URL . "/post", ["test" => 1]), true);
        $this->assertEquals('1', $response["json"]['test'], "JSON POST request failed");

        $response = json_decode(HttpUtils::postJson(self::HTTPBIN_URL . "/post?test=1", ["test" => 2]), true);

        $this->assertEquals('1', $response["args"]['test'], "JSON POST request failed with query string");
        $this->assertEquals('2', $response["json"]['test'], "JSON POST request failed with query string");
    }

    public function testPutRequest(): void
    {
        $response = json_decode(HttpUtils::put(self::HTTPBIN_URL . "/put", ["test" => 1]), true);
        $this->assertEquals('1', $response["form"]['test'], "PUT request failed");

        $response = json_decode(HttpUtils::put(self::HTTPBIN_URL . "/put?test=1", ["test" => 2]), true);
        $this->assertEquals('1', $response["args"]['test'], "PUT request failed with query string");
        $this->assertEquals('2', $response["form"]['test'], "PUT request failed with query string");
    }

    public function testPutJsonRequest(): void
    {
        $response = json_decode(HttpUtils::putJson(self::HTTPBIN_URL . "/put", ["test" => 1]), true);
        $this->assertEquals('1', $response["json"]['test'], "JSON PUT request failed");

        $response = json_decode(HttpUtils::putJson(self::HTTPBIN_URL . "/put?test=1", ["test" => 2]), true);

        $this->assertEquals('1', $response["args"]['test'], "JSON PUT request failed with query string");
        $this->assertEquals('2', $response["json"]['test'], "JSON PUT request failed with query string");
    }

    public function testPathchRequest(): void
    {
        $response = json_decode(HttpUtils::patch(self::HTTPBIN_URL . "/patch", ["test" => 1]), true);
        $this->assertEquals('1', $response["form"]['test'], "PATCH request failed");

        $response = json_decode(HttpUtils::patch(self::HTTPBIN_URL . "/patch?test=1", ["test" => 2]), true);
        $this->assertEquals('1', $response["args"]['test'], "PATCH request failed with query string");
        $this->assertEquals('2', $response["form"]['test'], "PATCH request failed with query string");
    }

    public function testPatchJsonRequest(): void
    {
        $response = json_decode(HttpUtils::patchJson(self::HTTPBIN_URL . "/patch", ["test" => 1]), true);
        $this->assertEquals('1', $response["json"]['test'], "JSON PATCH request failed");

        $response = json_decode(HttpUtils::patchJson(self::HTTPBIN_URL . "/patch?test=1", ["test" => 2]), true);

        $this->assertEquals('1', $response["args"]['test'], "JSON PATCH request failed with query string");
        $this->assertEquals('2', $response["json"]['test'], "JSON PATCH request failed with query string");
    }

    public function testDeleteRequest(): void
    {
        $response = json_decode(HttpUtils::delete(self::HTTPBIN_URL . "/delete"), true);
        $this->assertEquals(self::HTTPBIN_URL . "/delete", $response["url"], "DELETE request failed");

        $response = json_decode(HttpUtils::delete(self::HTTPBIN_URL . "/delete?test=1"), true);
        $this->assertEquals('1', $response["args"]['test'], "DELETE request failed with query string");
    }
}
