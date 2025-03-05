<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Testing\TestResponse;

abstract class TestCase extends BaseTestCase
{
    protected const JSONAPI_HEADERS = [
        'Accept' => 'application/vnd.api+json',
        'Content-Type' => 'application/vnd.api+json',
    ];
    protected const JSONPATCH_HEADERS = [
        'Accept' => 'application/vnd.api+json',
        'Content-Type' => 'application/merge-patch+json',
    ];

    protected string $resource;
    protected function getJsonApi(string $path): TestResponse
    {
        $response = $this->getJson(
            sprintf(
                "api/%s/%s",
                $this->resource,
                ltrim($path, '/')
            ),
            self::JSONAPI_HEADERS
        );

        $response->assertStatus(200);
        $response->assertJsonStructure(['data']);

        return $response;
    }

    protected function postJsonApi(array $data): TestResponse
    {
        $response = $this->postJson(
            sprintf(
                "api/%s",
                $this->resource,
            ),
            ['data' => [
                'attributes' => $data,
            ]],
            self::JSONAPI_HEADERS
        );

        $response->assertStatus(201);

        return $response;
    }

    protected function patchJsonMerge(int $id, array $data): TestResponse
    {
        $response = $this->patchJson(
            sprintf(
                "api/%s/%d",
                $this->resource,
                $id
            ),
            $data,
            self::JSONPATCH_HEADERS
        );

        $response->assertStatus(200);

        return $response;
    }

    public function deleteJsonApi(int $id): TestResponse
    {
        $response = $this->deleteJson(
            sprintf(
                "api/%s/%d",
                $this->resource,
                $id
            ),
            [],
            self::JSONAPI_HEADERS
        );

        $response->assertStatus(204);

        return $response;
    }
}
