<?php

namespace App\Services;

use App\Models\Customer;
use App\Repositories\TicketRepository;

class TicketService
{
    protected TicketRepository $ticketRepository;

    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    public function createTicket($data)
    {
        $customer = Customer::query()->firstOrCreate(
            ['email' => $data['email']],
            ['name' => $data['name'], 'phone' => $data['phone']]
        );

        $ticketData = [
            'customer_id' => $customer->id,
            'subject' => $data['subject'],
            'message' => $data['message'],
            'status' => 'new',
        ];

        $ticket = $this->ticketRepository->create($ticketData);

        if (isset($data['file']) && is_array($data['file'])) {
            foreach ($data['file'] as $file) {
                if ($file->isValid()) {
                    $ticket->addMedia($file)->toMediaCollection('documents');
                }
            }
        }

        return $ticket;
    }
}
