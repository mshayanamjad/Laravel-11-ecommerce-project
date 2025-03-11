<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\GeminiService;
use Illuminate\Http\Request;

class ProductGenerater extends Controller
{
    protected $geminiService;

    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }

    public function generateAndSaveProducts()
    {
        // Fetch products from Gemini API
        $products = $this->geminiService->generateProducts();
    
        // Check if products were generated
        if (empty($products)) {
            \Log::error('No products generated!');
            return response()->json(['message' => 'No products generated! Check Gemini API response.'], 400);
        }
    
        $addedCount = 0; // Counter for successfully added products
    
        foreach ($products as $product) {
            try {
                \Log::info('Processing Product:', ['product' => $product]);
    
                // Ensure required fields exist
                if (empty($product['title']) || empty($product['price'])) {
                    \Log::warning('Skipping product due to missing required fields', ['product' => $product]);
                    continue;
                }
    
                // Create product in the database
                $newProduct = Product::create([
                    'title'       => $product['title'],
                    'slug'        => \Str::slug($product['title']),
                    'price'       => floatval($product['price']),
                    'description' => $product['description'] ?? 'No description available',
                    'image'       => $product['image'] ?? 'no-image.jpg',
                    'user_id'     => 1, // Default user
                    'qty'         => 10, // Default quantity
                    'status'      => 'publish', // Default status
                ]);
    
                if ($newProduct) {
                    $addedCount++;
                    \Log::info('Product Inserted Successfully', ['id' => $newProduct->id]);
                }
            } catch (\Exception $e) {
                \Log::error('Product Insert Failed', [
                    'error'   => $e->getMessage(),
                    'product' => $product
                ]);
            }
        }
    
        \Log::info("Total Products Added: {$addedCount}");
    
        return response()->json(['message' => "{$addedCount} products added successfully"], 200);
    }
    
    
    
    
    
}
