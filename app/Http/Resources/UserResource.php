<?php

namespace App\Http\Resources;

use App\Enums\UserRole;
use App\Models\Company;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'company' => new CompanyResource($this->whenLoaded(Company::class)),
            'profile' => new StandardResource($this->whenLoaded(Profile::class))
        ];
    }
}
