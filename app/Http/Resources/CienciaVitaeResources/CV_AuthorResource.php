<?php

namespace App\Http\Resources\CienciaVitaeResources;

use Illuminate\Http\Resources\Json\JsonResource;

class CV_AuthorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
