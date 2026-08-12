<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->name,
            'descripcion' => $this->description,
            'precio' => (float) $this->price,
            'categoria' => $this->category,
            'disponible' => (bool) $this->is_available,
            'creado_en' => $this->created_at ? $this->created_at->toDateTimeString() : null,
            'actualizado_en' => $this->updated_at ? $this->updated_at->toDateTimeString() : null,
        ];
    }
}
