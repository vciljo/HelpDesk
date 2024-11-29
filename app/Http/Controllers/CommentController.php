<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Сохранение нового комментария

    public function store(Request $request, $ticketId)
    {
       
        $ticket = Ticket::findOrFail($ticketId);

       
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        //  Создание комментария 

        Comment::create([
            'ticket_id' => $ticket->id,
            'user_id' => auth()->id(),
            'message' => $request->message,
        ]);

        return redirect()->route('tickets.show', $ticketId)->with('success', 'Комментарий добавлен.');
    }
}
