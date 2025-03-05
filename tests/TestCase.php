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
        return $this->getJson(
            sprintf(
                "api/%s/%s",
                $this->resource,
                ltrim($path, '/')
            ),
            self::JSONAPI_HEADERS
        );
    }

    protected function postJsonApi(array $data): TestResponse
    {
        return $this->postJson(
            sprintf(
                "api/%s",
                $this->resource,
            ),
            ['data' => [
                'attributes' => $data,
            ]],
            self::JSONAPI_HEADERS
        );
    }

    protected function patchJsonMerge(int $id, array $data): TestResponse
    {
        return $this->patchJson(
            sprintf(
                "api/%s/%d",
                $this->resource,
                $id
            ),
            $data,
            self::JSONPATCH_HEADERS
        );
    }

    public function deleteJsonApi(int $id): TestResponse
    {
        return $this->deleteJson(
            sprintf(
                "api/%s/%d",
                $this->resource,
                $id
            ),
            [],
            self::JSONAPI_HEADERS
        );
    }
}
