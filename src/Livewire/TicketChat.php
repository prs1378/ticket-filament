<?php

namespace prs1378\FilamentTickets\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use YourVendor\FilamentTickets\Models\Ticket;
use YourVendor\FilamentTickets\Models\TicketMessage;

class TicketChat extends Component
{
    use WithFileUploads;

    public Ticket $ticket;
    public $message = '';
    public $attachment;

    protected $listeners = ['messageReceived' => '$refresh'];

    public function mount(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function sendMessage()
    {
        $this->validate([
            'message' => 'required|string',
            'attachment' => 'nullable|file|max:10240',
        ]);

        $attachmentPath = null;
        if ($this->attachment) {
            $attachmentPath = $this->attachment->store('ticket-attachments', 'public');
        }

        $message = TicketMessage::create([
            'ticket_id' => $this->ticket->id,
            'user_id' => auth()->id(),
            'message' => $this->message,
            'attachment' => $attachmentPath,
        ]);

        $this->message = '';
        $this->attachment = null;

        // Broadcast the message
        broadcast(new TicketMessageSent($message))->toOthers();
    }

    public function render()
    {
        return view('filament-tickets::livewire.ticket-chat', [
            'messages' => $this->ticket->messages()->with('user')->latest()->get(),
        ]);
    }
} 
