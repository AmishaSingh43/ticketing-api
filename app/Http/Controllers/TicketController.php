<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Validator;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::orderBy('id', 'DESC')->get();
        return response()->json(['status' => 200, 'tickets' => $tickets]); 
    }   

    public function store(Request $request)
    {   
        $ticketNumber = Str::upper(Str::random(8));

        $userId = Auth::id();
    
        $validator = Validator::make($request->all(), [
           'title' => 'required|max:191',
           'description' => 'required',
           'priority' => 'required',
           'type' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors(),
            ], 422);

        }else {
            $ticket = Ticket::create([
                'user_id' => $userId,
                'title' => $request->title,
                'description' => $request->description,
                'ticket_id' => $ticketNumber,
                'priority' => $request->priority,
                'type' => $request->type,
            ]);
        }

        if($ticket){
            return response()->json([
                'status' => 200,
                'message' => "Ticket created successfully",
            ], 200);
        }else{
            return response()->json([
                'status' => 500,
                'message' => "Something went wrong",
            ], 500);
        }
    }

    public function show($id)
    {
        $ticket = Ticket::find($id);
        if($ticket){
            return response()->json([
                'status' => 200,
                'ticket' => $ticket,
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "Ticket not found with this ID",
            ], 404);
        }
    }

    public function edit(Request $request, $id)
    {
        $ticket = Ticket::find($id);
        if($ticket){
            return response()->json([
                'status' => 200,
                'ticket' => $ticket,
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "Ticket not found with this ID",
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $userId = Auth::id();
    
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:191',
            'description' => 'required',
            'priority' => 'required',
            'type' => 'required',
         ]);
 
        if ($validator->fails())
        {
             return response()->json([
                 'status' => 422,
                 'errors' => $validator->errors(),
             ], 422);
 
        }else {
           $ticket = Ticket::find($id);
           if($ticket) {
              $ticket->user_id = $userId;
              $ticket->title = $request->input('title');
              $ticket->ticket_id = $request->input('ticket_id');
              $ticket->status = $request->input('status');
              $ticket->description = $request->input('description');
              $ticket->priority = $request->input('priority');
              $ticket->type = $request->input('type');
              $ticket->staff_id = $request->input('staff_id');
              $ticket->update();

              return response()->json([
                'status' => 200,
                'message' => 'Ticket updated successfully',
              ], 200);
            }
            else{
                return response()->json([
                    'status' => 404,
                    'message' => "Ticket not found with this ID",
                ], 404);
            }
        //    $ticket->update($request->all());
        }
    }
}
