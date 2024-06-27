<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BadgeRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Badge;
use App\Models\User;
use Exception;

class BadgeController extends AdminController
{
    use ApiResponseTrait;

    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:settings'])->only('show', 'store', 'destroy', 'update');
    }

    public function index(): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            $badges = Badge::withTrashed()->get();
            return $this->apiResponse(200, 'Badges data.', $badges);
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }

    public function store(BadgeRequest $request): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            Badge::create([
                'level' => $request->level,
                'points' => $request->points,
                'creator_type' => User::class,
                'creator_id' => auth()->user()->id,
                'editor_type' => User::class,
                'editor_id' => auth()->user()->id,
            ]);
            return $this->apiResponse(200, 'Badge created successfully.');
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }

    public function show(Badge $badge): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            return $this->apiResponse(200, 'Badge data.', $badge);
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }

    public function destroy(Badge $badge): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            $badge->delete();
            return $this->apiResponse(202, 'Badge deleted successfully.');
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }

    public function update(BadgeRequest $request, Badge $badge): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            $badge->update([
                'level' => $request->level,
                'points' => $request->points,
                'editor_type' => User::class,
                'editor_id' => auth()->user()->id,
            ]);
            return $this->apiResponse(200, 'Badge updated successfully.');
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }
}
