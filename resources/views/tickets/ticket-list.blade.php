@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Ticket List</h1>

        <div class="mb-6 bg-white p-4 rounded-lg border">
            <form method="GET" action="{{ route('tickets.index') }}" class="flex flex-col md:flex-row flex-wrap gap-3 items-end">

                <div class="w-full md:w-auto">
                    <label class="text-xs font-semibold text-gray-600 uppercase">Email</label>
                    <input type="text" name="email" value="{{ request('email') }}" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="w-full md:w-auto">
                    <label class="text-xs font-semibold text-gray-600 uppercase">Phone</label>
                    <input type="text" name="phone" value="{{ request('phone') }}" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="w-full md:w-auto">
                    <label class="text-xs font-semibold text-gray-600 uppercase">Status</label>
                    <select name="status" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">All statuses</option>
                        <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>New</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="processed" {{ request('status') == 'processed' ? 'selected' : '' }}>Processed</option>
                    </select>
                </div>

                <div class="w-full md:w-auto">
                    <label class="text-xs font-semibold text-gray-600 uppercase">Date</label>
                    <input type="date" name="date" value="{{ request('date') }}" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="flex gap-2 w-full md:w-auto">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 text-sm font-medium transition">
                        Filter
                    </button>
                    <a href="{{ route('tickets.index') }}" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-200 text-sm font-medium transition text-center">
                        Reset
                    </a>
                </div>

            </form>
        </div>

        @if($tickets->isEmpty())
            <p>There are no tickets.</p>
        @else
            <table class="min-w-full bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Customer</th>
                        <th class="px-4 py-2 border">Phone</th>
                        <th class="px-4 py-2 border">Status</th>
                        <th class="px-4 py-2 border">Date</th>
                        <th class="px-4 py-2 border">Actions</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                        <tr>
                            <td class="px-4 py-2 border">{{ $ticket->id }}</td>
                            <td class="px-4 py-2 border">
                                <div class="text-sm font-medium text-gray-900">{{ $ticket->customer->name }}</div>
                                <div class="text-sm text-gray-500">{{ $ticket->customer->email }}</div>
                            </td>
                            <td class="px-4 py-2 border">{{ $ticket->customer->phone }}</td>
                            <td class="px-4 py-2 border">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                {{ $ticket->status === 'new' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $ticket->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $ticket->status === 'processed' ? 'bg-green-100 text-green-800' : '' }}">

                                {{ ucfirst(str_replace(['new', 'in_progress', 'processed'], ['New', 'In progress', 'Processed'], $ticket->status)) }}
                            </span>
                            </td>
                            <td class="px-4 py-2 border">{{ $ticket->created_at->format('d.m.Y H:i') }}</td>
                            <td class="px-4 py-2 border">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900 font-bold">
                                    View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <div class="mt-4">
        {{ $tickets->links() }}
    </div>
@endsection
