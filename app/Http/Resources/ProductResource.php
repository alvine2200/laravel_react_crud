<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;


class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            "type" => $this->type,
            "quantity" => $this->quantity,
            "photo" => !empty($this->photo) ? url(Storage::url($this->photo)) : '',
            //'photo' => URL::asset('storage/app/' . $this->photo)
        ];

        // $result = [
        //     "id" => $this->id,
        //     'name' => $this->name,
        //     'price' => $this->price,
        //     "type" => $this->type,
        //     "quantity" => $this->quantity,
        //     "photo" => !empty($this->photo) ? url(Storage::url($this->photo)) : '',
        //     //'thumbnail_image' => !empty($this->thumbnail_image) ? url(Storage::url($this->thumbnail_image)) : '',

        // ];
        //return $resolve;
    }
}
