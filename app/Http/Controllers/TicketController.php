<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function create(Request $request)
    {
        // Validar los datos requeridos de cada ticket para su creacion
        $request->validate([
            'title' => 'required|max:255',
            'category' => 'required',
            'description' => 'required',
            'status' => 'required|in:open,closed'
        ]);

        // Crear el nuevo ticket
        $ticket = new Ticket;
        $ticket->title = $request->input('title');
        $ticket->description = $request->input('description');
        $ticket->status = $request->input('status');
        $ticket->save();

        // Redirigir al ticket creado
        return redirect()->route('tickets.show', ['ticket' => $ticket]);
    }

    public function show(Ticket $ticket)
    {
        return view('tickets.show', ['ticket' => $ticket]);
    }
}
