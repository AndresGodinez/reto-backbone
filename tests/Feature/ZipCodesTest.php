<?php

namespace Tests\Feature;

use App\Models\ZipCode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ZipCodesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example(): void
    {

        $number = 64000;
        $url = "/api/zip-codes/{$number}";
        $response = $this->get($url);
        $response->assertStatus(200);
        var_dump($response->getContent());
        $response->assertJsonStructure([
            'data' =>
                [
                    'zip_code',
                    'locality',
                    'federal_entity',
                ]
        ]);
    }
}
