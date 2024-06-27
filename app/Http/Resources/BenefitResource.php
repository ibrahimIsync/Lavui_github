<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class BenefitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
//icon
            'id'          => $this->id,
            'title'       => [
                'en' => $this->getTranslation('title', 'en'),
                'ar' => $this->getTranslation('title', 'ar'),
            ],
            'description'       => [
                'en' => $this->getTranslation('description', 'en'),
                'ar' => $this->getTranslation('description', 'ar'),
            ],
            'status'      => $this->status,
            'icon'        => $this->icon
//            'thumb'       => $this->thumb,
//            'cover'       => $this->cover
        ];
    }
}
