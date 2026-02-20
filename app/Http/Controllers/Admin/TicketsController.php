<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::query()->with(['customer', 'media']);

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('email')) {
            $query->whereHas('customer', function ($q) use ($request) {
                $q->where('email', 'like', '%'.$request->email.'%');
            });
        }

        if ($request->filled('phone')) {
            $query->whereHas('customer', function ($q) use ($request) {
                $q->where('phone', 'like', '%'.$request->phone.'%');
            });
        }

        $tickets = $query->latest()->paginate(10)->withQueryString();

        return view('tickets.ticket-list', compact('tickets'));
    }

    public function show($id)
    {
        $ticket = Ticket::query()->with(['customer', 'media'])->findOrFail($id);

        return view('tickets.ticket-detail', compact('ticket'));
    }
}
