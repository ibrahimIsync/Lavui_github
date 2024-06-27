<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Models\ProductBrand;
use Exception;
use App\Services\ProductBrandService;
use App\Http\Requests\PaginateRequest;
use App\Http\Resources\ProductBrandResource;

class ProductBrandController extends Controller
{
    use ApiResponseTrait;
    private ProductBrandService $productBrandService;

    public function __construct(ProductBrandService $productBrandService)
    {
        $this->productBrandService = $productBrandService;
    }

    public function index(PaginateRequest $request): \Illuminate\Http\Response | \Illuminate\Http\Resources\Json\AnonymousResourceCollection | \Illuminate\Contracts\Foundation\Application | \Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            $brands = ProductBrand::select(['name', 'slug', 'image', 'description', 'status'])->inRandomOrder()->limit(10)->get();
            return $this->apiResponse(200, 'Brands data.', $brands);
//            return ProductBrandResource::collection($this->productBrandService->list($request));
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
//            return response(['status' => false, 'message' => $exception->getMessage()], 422);
        }
    }
}
