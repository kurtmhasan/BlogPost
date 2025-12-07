<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class NewsService
{
    /**
     * Teknoloji haberlerini getirir.
     * Cache Süresi: 3600 saniye (1 Saat)
     */
    public function getTechHeadlines()
    {
        return Cache::remember('tech_news', 3600, function () {

            $apiKey = config('services.news_api.key');

            if (empty($apiKey)) {
                return [];
            }

            try {

                $response = Http::timeout(3)->get("https://newsapi.org/v2/top-headlines", [
                    'category' => 'technology',
                    'apiKey'   => $apiKey,
                    'pageSize' => 5
                ]);


                if ($response->successful()) {
                    return $response->json()['articles'] ?? [];
                }


                Log::warning('News API hatası: ' . $response->status());
                return [];

            } catch (\Exception $e) {
                Log::error('News API bağlantı sorunu: ' . $e->getMessage());
                return [];
            }
        });
    }
}
