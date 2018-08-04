<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Contact extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'contact id' => $this->id,
            'contact name' => $this->name,
            'mobile' => $this->phone,
            'created' => (string)$this->created_at->format('d/m/Y')
        ];
    }
}
