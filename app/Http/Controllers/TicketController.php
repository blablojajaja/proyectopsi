<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ticket;
use App\Models\Category;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\Gmail;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $tickets = Ticket::where('status', '!=' ,3)->latest()->paginate(5); 

        return view('tickets.index', compact('tickets'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $sectors = Sector::all();
        return view('tickets.create', compact('categories','sectors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'subject' => 'required',
            'category' => 'required',
            'sector' => 'required',
        ]);

        $ticket = new Ticket;
        $ticket->name = $request->name;
        $ticket->subject = $request->subject;
        $ticket->category = $request->category;
        $ticket->sector = $request->sector;
        $ticket->id_user = auth()->user()->id;
        if($request->hasFile('image')){
            $request->validate([
              'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            $path = $request->file('image')->store('public/images');
            $ticket->image = $path;
        }
        $ticket->save();
      

        return redirect()->route('tickets.user')
            ->with('success', 'Ticket creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        $categories = Category::all();
        $sectors = Sector::all();
        return view('tickets.edit', compact('ticket','categories','sectors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required'
        ]);
        $email = $ticket->user->email;
        $ticket->update($request->all());
        switch($request->status){
            case 1:
                $ticketstatus="ENVIADO";
            break;
            case 2:
                $ticketstatus="EN PROCESO DE ARREGLO";
            break;
            case 3:
                $ticketstatus="TERMINADO";
            break;
        }
        $details = [
            'title' => "El estatus del ticket ".$ticket->name." ha cambiado.",
            'body' => "El estatus actual cambió a ".$ticketstatus."."
        ];
        Mail::to($email)->send(new Gmail($details));

        return back()->with('success', 'Estatus actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket borrado exitosamente');
    }

    public function delete($id)
    {
        $ticket = Ticket::find($id);

        return view('tickets.delete', compact('ticket'));
    }

    public function indexbyuser()
    {
        $tickets = Ticket::where('id_user', auth()->user()->id)->latest()->paginate(5);
        
         return view('tickets.userindex', compact('tickets'))
             ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function historical(Request $request)
    {
        $categories = Category::all();
        $sectors = Sector::all();
        $tickets = Ticket::where([['name','!=',Null],[function($query)use($request){
                if(($term = $request->term)){
                    $query->where('name', 'LIKE', '%'. $term . '%')
                    ->orWhere('subject', 'LIKE', '%'. $term . '%')->get();
                    }
                if($status = $request->status && $category = $request->category && $sector = $request->sector && $created_at = $request->created_at){
                    $query->where('status', $status)
                    ->where('category', $category)
                    ->where('sector', $sector)
                    ->where('created_at', 'LIKE', '%'.$created_at.'%')->get();//1111
                }
                if($status = $request->status && $category = $request->category && $sector = $request->sector){
                    $query->where('status', $status)
                    ->where('category', $category)
                    ->where('sector', $sector)->get();//1110
                }
                if($status = $request->status && $category = $request->category && $created_at = $request->created_at){
                    $query->where('status', $status)
                    ->where('category', $category)
                    ->where('created_at', 'LIKE', '%'.$created_at.'%')->get();//1101
                }
                if($status = $request->status && $category = $request->category){
                    $query->where('status', $status)
                    ->where('category', $category)->get();//1100
                }
                if($status = $request->status && $sector = $request->sector && $created_at = $request->created_at){
                    $query->where('status', $status)
                    ->where('sector', $sector)
                    ->where('created_at', 'LIKE', '%'.$created_at.'%')->get();//1011
                }
                if($status = $request->status && $sector = $request->sector){
                    $query->where('status', $status)
                    ->where('sector', $sector)->get();//1010
                }
                if($status = $request->status && $created_at = $request->created_at){
                    $query->where('status', $status)
                    ->where('created_at', 'LIKE', '%'.$created_at.'%')->get();//1001
                }
                if($status = $request->status){
                    $query->where('status', $status)->get();//1000
                }
                if($category = $request->category && $sector = $request->sector && $created_at = $request->created_at){
                    $query->where('category', $category)
                    ->where('sector', $sector)
                    ->where('created_at', 'LIKE', '%'.$created_at.'%')->get();//0111
                }
                if($category = $request->category && $sector = $request->sector){
                    $query->where('category', $category)
                    ->where('sector', $sector)->get();//0110
                }
                if($status = $request->status && $category = $request->category && $sector = $request->sector && $created_at = $request->created_at){
                    $query->where('category', $category)
                    ->where('created_at', 'LIKE', '%'.$created_at.'%')->get(); //0101
                }
                if($category = $request->category){
                    $query->where('category', $category)->get(); //0100
                }
                if($sector = $request->sector && $created_at = $request->created_at){
                    $query->where('sector', $sector)
                    ->where('created_at', 'LIKE', '%'.$created_at.'%')->get();//0011
                }
                if($sector = $request->sector){
                    $query->where('sector', $sector)->get();//0010
                }
                if($created_at = $request->created_at){
                    $query->where('created_at', 'LIKE', '%'.$created_at.'%')->get();//0001
                }
            }]
        ]) 
        ->orderBy('id', 'desc')->paginate(5);
        return view('tickets.history', compact('tickets','categories','sectors'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function rate(Ticket $ticket){

        return view('tickets.rate', compact('ticket'));
    }

    public function setGrade(Request $request, Ticket $ticket){
        $request->validate([
            'grade' => 'required'
        ]);
        $ticket->update($request->all());

        return back()->with('success', 'Estatus evaluado exitosamente, ¡Gracias por tu ayuda!');
    }
}
