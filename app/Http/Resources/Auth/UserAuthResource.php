<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserAuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>$this->id,
            "name"=>$this->name,
            "email"=>$this->email,
            "type"=>$this->type,
            "email_verified_at"=>$this->email_verified_at,
            "token"=>$this->token
        ];
    }
}
