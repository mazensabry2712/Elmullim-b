<?php

namespace App\Http\Resources;

use App\Http\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->whenHas("id"),
            'name' => $this->whenHas('name'),
            "image" => $this->image ? (new ImageService())->imageUrlToBase64($this->image) : null,
            'education_level' => new EducationLevelResource($this->educationLevel),
        ];
    }
}
