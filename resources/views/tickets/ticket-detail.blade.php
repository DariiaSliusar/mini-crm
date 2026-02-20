@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8 px-4">
        <div class="max-w-4xl mx-auto">
            <div class="mb-4">
                <a href="{{ route('tickets.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                    Back to list
                </a>
            </div>

            <div class="bg-white dark:bg-zinc-800 shadow rounded-lg overflow-hidden border border-zinc-200 dark:border-zinc-700">
                <div class="bg-zinc-50 dark:bg-zinc-900 px-6 py-4 border-b border-zinc-200 dark:border-zinc-700">
                    <h1 class="text-xl font-bold text-gray-800 dark:text-white">
                        Ticket #{{ $ticket->id }}: {{ $ticket->subject }}
                    </h1>
                </div>

                <div class="p-6 space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Customer</h3>
                            <p class="text-gray-900 dark:text-gray-100 font-medium">{{ $ticket->customer->name }}</p>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $ticket->customer->email }}</p>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $ticket->customer->phone }}</p>
                        </div>
                        <div>
                            <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Status and Data</h3>
                            <div class="mb-1">
                            <span class="px-2 py-1 text-xs font-bold rounded-full
                                {{ $ticket->status === 'new' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $ticket->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $ticket->status === 'processed' ? 'bg-green-100 text-green-800' : '' }}">
                                {{ strtoupper($ticket->status) }}
                            </span>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Created at: {{ $ticket->created_at->format('d.m.Y H:i') }}</p>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Message</h3>
                        <div class="bg-gray-50 dark:bg-zinc-900 p-4 rounded-md border border-gray-200 dark:border-zinc-700 text-gray-800 dark:text-gray-200">
                            {{ $ticket->message }}
                        </div>
                    </div>

                    <div>
                        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Attached files</h3>
                        <div class="space-y-2">
                            @forelse($ticket->getMedia('documents') as $file)
                                <div class="flex items-center justify-between p-3 bg-white dark:bg-zinc-800 border rounded-md hover:border-indigo-300 transition">
                                    <div class="flex items-center">
                                        <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">{{ $file->file_name }}</span>
                                    </div>
                                    <a href="{{ route('media.download', $file) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-bold">
                                        Download
                                    </a>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500 italic">No files were uploaded for this ticket.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
