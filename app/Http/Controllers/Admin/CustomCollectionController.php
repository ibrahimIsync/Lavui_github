<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CustomCollectionRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\FileTrait;
use App\Models\CustomCollection;
use App\Models\User;
use Exception;
use Illuminate\Support\Str;

class CustomCollectionController extends AdminController
{
    use ApiResponseTrait, FileTrait;
    const PATH = 'custom-collection';
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:settings'])->only('show', 'store', 'destroy', 'update');
    }

    public function index(): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            $customCollections = CustomCollection::withTrashed()->get();
            return $this->ApiResponse(200, 'Custom collections data.', $customCollections);
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }

    public function store(CustomCollectionRequest $request): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            $imageName = $this->uploadImage($request->image, self::PATH);
            CustomCollection::create([
                'name' => [
                    'en' => $request->name_en,
                    'ar' => $request->name_ar,
                ],
                'description' => [
                    'en' => $request->description_en,
                    'ar' => $request->description_ar,
                ],
                'status' => $request->status,
                'slug' => Str::slug($request->name_en),
                'image' => $imageName,
                'creator_type' => User::class,
                'creator_id' => auth()->user()->id,
                'editor_type' => User::class,
                'editor_id' => auth()->user()->id,
            ]);
            return $this->ApiResponse(200, 'Custom collection created successfully.');
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }

    public function show(CustomCollection $collection): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            return $this->ApiResponse(200, 'Custom collection data.', $collection);
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }

    public function destroy(CustomCollection $collection): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            $this->deleteImage($collection->image);
            $collection->delete();
            return $this->apiResponse(200, 'Custom collection deleted successfully.');
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }

    public function update(CustomCollection $collection, CustomCollectionRequest $request): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            $imageName = ($request->image) ? $this->uploadImage($request->image, self::PATH, $collection->image) : $collection->getRawOriginal('image');
            $collection->update([
                'name' => [
                    'en' => $request->name_en,
                    'ar' => $request->name_ar,
                ],
                'description' => [
                    'en' => $request->description_en,
                    'ar' => $request->description_ar,
                ],
                'status' => $request->status,
                'slug' => Str::slug($request->name_en),
                'image' => $imageName,
                'editor_type' => User::class,
                'editor_id' => auth()->user()->id,
            ]);
            return $this->apiResponse(200, 'Custom collection updated successfully.');
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }
}
