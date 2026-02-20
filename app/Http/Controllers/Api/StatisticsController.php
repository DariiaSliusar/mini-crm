<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TicketStatisticsResource;
use App\Models\Ticket;

class StatisticsController extends Controller
{
    public function statistics()
    {
        $statistics = [
            'daily' => Ticket::query()->lastDay()->count(),
            'weekly' => Ticket::query()->lastWeek()->count(),
            'monthly' => Ticket::query()->lastMonth()->count(),
            'total' => Ticket::query()->count(),
        ];

        return new TicketStatisticsResource($statistics);
    }
}
