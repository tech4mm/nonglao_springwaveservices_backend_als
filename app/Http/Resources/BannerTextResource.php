<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BannerTextResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    // public function toArray(Request $request): array
    // {
    //     return parent::toArray($request);
    // }

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'e_body' => $this->e_body,
            'm_body' => $this->m_body,
            's_body' => $this->s_body,
            't_body' => $this->t_body,
        ];
    }
}
