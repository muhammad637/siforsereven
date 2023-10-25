<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Outlet extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'name' => $this->name,
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'coordinate' => $this->coordinate,
            'map_popup_content' => $this->map_popup_content,
            // Tambahkan atribut lain yang ingin Anda sertakan dalam JSON response
        ];
        
        // return ['outletData' => $request];
    }
}
