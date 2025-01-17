<div class="p-4 bg-white rounded-lg shadow">
    <div class="h-96 overflow-y-auto mb-4">
        @foreach($messages as $message)
            <div class="mb-4 {{ $message->user_id === auth()->id() ? 'text-right' : 'text-left' }}">
                <div class="inline-block bg-gray-100 rounded-lg p-3 max-w-md">
                    <div class="text-sm text-gray-600">{{ $message->user->name }}</div>
                    <div class="text-gray-800">{{ $message->message }}</div>
                    @if($message->attachment)
                        <div class="mt-2">
                            <a href="{{ Storage::url($message->attachment) }}" target="_blank" class="text-blue-500">
                                View Attachment
                            </a>
                        </div>
                    @endif
                    <div class="text-xs text-gray-500 mt-1">
                        {{ $message->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <form wire:submit.prevent="sendMessage" class="flex gap-2">
        <input type="text" wire:model="message" class="flex-1 rounded-lg border-gray-300" placeholder="Type your message...">
        <input type="file" wire:model="attachment" class="hidden" id="attachment">
        <label for="attachment" class="cursor-pointer px-4 py-2 bg-gray-100 rounded-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
            </svg>
        </label>
        <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-lg">
            Send
        </button>
    </form>
</div> 