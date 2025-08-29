<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    protected $apiKey;
    protected $client;

    public function __construct()
    {
        $this->apiKey = env('GEMINI_API_KEY'); // Ensure your API key is in .env
        $this->client = new Client(['base_uri' => 'https://generativelanguage.googleapis.com/']);

    }

    public function generateProducts()
    {
        $prompt = "Generate a JSON array of 5 men's fashion products. Each product should have: title, category, brand, price, description, and image. Ensure the response is a valid JSON array.";
    
        try {
            $response = Http::post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key={$this->apiKey}", [
                "contents" => [
                    [
                        "parts" => [
                            ["text" => $prompt]
                        ]
                    ]
                ]
            ]);
    
            $result = $response->json();
            \Log::info('Gemini API Response:', ['response' => $result]);
    
            // Check if the response contains a valid JSON array
            if (!isset($result['candidates'][0]['content']['parts'][0]['text'])) {
                \Log::error('Gemini API Error:', ['error' => $result]);
                return null;
            }
    
            // Extract the text response
            $responseText = $result['candidates'][0]['content']['parts'][0]['text'];
    
            // Remove code block formatting if present (```json ... ```)
            $responseText = trim($responseText);
            if (str_starts_with($responseText, "```json")) {
                $responseText = substr($responseText, 7); // Remove "```json\n"
            }
            if (str_ends_with($responseText, "```")) {
                $responseText = substr($responseText, 0, -3); // Remove "```"
            }
    
            // Decode JSON
            $products = json_decode($responseText, true);
    
            // Validate if JSON was correctly parsed
            if (json_last_error() !== JSON_ERROR_NONE) {
                \Log::error('Invalid JSON from Gemini:', ['responseText' => $responseText]);
                return null;
            }
    
            return $products;
        } catch (\Exception $e) {
            \Log::error('Gemini API Request Failed', ['error' => $e->getMessage()]);
            return null;
        }
    } 
 
}
