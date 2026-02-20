<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketStatisticsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'daily' => $this['daily'],
            'weekly' => $this['weekly'],
            'monthly' => $this['monthly'],
            'total' => $this['total'],
        ];
    }
}
