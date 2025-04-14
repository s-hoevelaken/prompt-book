<?php

/*
    Contributor: Xander
*/
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ImageCreatorService
{
    public static function getPexelsImage(string $query): ?string
    {
        $response = Http::withHeaders([
            'Authorization' => env('PEXELS_API_KEY'),
        ])->get('https://api.pexels.com/v1/search', [
            'query' => $query,
            'per_page' => 1,
        ]);

        $data = $response->json();

        Log::info('Pexels response', $data);

        return $data['photos'][0]['src']['medium'] ?? null;
    }
}
