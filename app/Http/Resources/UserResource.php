<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Helper\AppHelper;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //  $name = $this->name;
        // if(is_null($this->name)) $name = '';
        return AppHelper::removeNullValues([
            'id' => $this->id,
            'name' => $this->name,
            'tasks' => $this->tasks
        ]);
    }
}
