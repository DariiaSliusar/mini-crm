<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TicketStoreRequest;
use App\Services\TicketService;

class TicketController extends Controller
{
    protected TicketService $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    public function store(TicketStoreRequest $request)
    {
        $ticket = $this->ticketService->createTicket($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Ticket created successfully',
            'data' => [
                'ticket_id' => $ticket->id,
                'customer' => $ticket->customer->name,
            ],
        ], 201);
    }
}
