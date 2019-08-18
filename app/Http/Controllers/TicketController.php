<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Module;
use App\Models\Type;
use App\Models\Channel;
use App\Models\Company;
use App\Http\Requests\TicketFormRequest;
use App\User;
use Carbon\Carbon;

class TicketController extends Controller
{
    private $itensPerPage = 3;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $companies = Company::all();
        $modules = Module::all();
        $channels = Channel::all();
        $types = Type::all();
        $users = User::all();
        $data = $request->all();
        if(isset($data['filter']) && $data['filter'] == "s"){
            $query = Ticket::query();
            if($data['opened_at_start'] != ""){
                $query = $query->where('opened_at', ">=", $data['opened_at_start']);
            }
            if($data['opened_at_finish'] != ""){
                $date = new Carbon($data['opened_at_finish']);
                $query = $query->where('opened_at', "<=", $date->addDay()->toDateTimeString());
            }
            if($data['user_id'] != ""){
                $query = $query->where('user_id', $data['user_id']);
            }
            if($data['channel_id'] != ""){
                $query = $query->where('channel_id', $data['channel_id']);
            }
            if($data['type_id'] != ""){
                $query = $query->where('type_id', $data['type_id']);
            }
            if($data['module_id'] != ""){
                $query = $query->where('module_id', $data['module_id']);
            }
            if($data['company_id'] != ""){
                $query = $query->where('company_id', $data['company_id']);
            }
            $tickets = $query->with('company')->with('channel')->with('type')->with('module')->with('user')->paginate($this->itensPerPage);
        }else{
            $tickets = Ticket::with('company')->with('channel')->with('type')->with('module')->with('user')->paginate($this->itensPerPage);
        }
        
        return view('ticket.index', compact('tickets','companies','tickets','modules','types', 'channels','users'));
    }

    public function close(Request $request)
    {
        $data = $request->all();
        $ticket = Ticket::findOrFail($data['id']);
        $data['closed'] = 1;
        $ticket->update($data);
        return redirect()->route('tickets.index')->with('success','Chamado fechado com sucesso!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ticket = new Ticket();
        $companies = Company::all();
        $modules = Module::all();
        $channels = Channel::all();
        $types = Type::all();
        
        return view('ticket.create', compact('ticket','companies','tickets','modules','types', 'channels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketFormRequest $request)
    {
        $data = $request->all();
        $data['opened_at'] = \Carbon\Carbon::now()->toDateTimeString();
        $data['user_id'] = auth()->user()->id;

        // dd($data);
        $ticket = Ticket::create($data);
        return redirect()->route('tickets.index')->with('success','Chamado criado com sucesso!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticket = Ticket::with('company')->with('channel')->with('type')->with('module')->with('user')->findOrFail($id);
        $companies = Company::all();
        $modules = Module::all();
        $channels = Channel::all();
        $types = Type::all();
        return view('ticket.edit', compact('ticket','companies','tickets','modules','types', 'channels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TicketFormRequest $request, Ticket $ticket)
    {
        $ticket->update($request->all());
        return redirect()->route('tickets.index')->with('success','Chamado alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('tickets.index')->with('success','Chamado deletado com sucesso!');
    }
}
