<?php

namespace App\Http\Controllers\Rooms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Room;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Repositories\RoomRepository;

use DB;

class RoomsController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $roomRepository;
    public function __construct(RoomRepository $roomRepository)
    {
        $this->roomRepository = $roomRepository;
        //$this->middleware('permission:room-list|room-create|room-edit|room-delete', ['only' => ['index','show']]);
        //$this->middleware('permission:room-create', ['only' => ['create','store']]);
        //$this->middleware('permission:room-edit', ['only' => ['edit','update']]);
        //$this->middleware('permission:room-delete', ['only' => ['destroy']]);
        
       /*  $this->middleware('auth');
        $this->middleware('permission:view-product|create-product|edit-product|delete-product', ['only' => ['index','show']]);
        $this->middleware('permission:create-product', ['only' => ['create','store']]);
        $this->middleware('permission:edit-product', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-product', ['only' => ['destroy']]); */
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {
        $products = $this->roomRepository->getPaginate(50);        
        //$user = $request->user();
        return view('rooms.index',compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request): View
    {
        if ($request->user()->cannot('room-create')) {
            abort(403);
        }
        return view('rooms.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        
        request()->validate([
            'room_name' => 'required',
        ]);
        
        $this->roomRepository->store($request->all());
        return redirect()->route('rooms.index')
                        ->with('success','Room created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $product = $this->roomRepository->find($id);
        return view('rooms.show',compact('product'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        //$product = Room::find($id);
        $product = $this->roomRepository->find($id);
        return view('rooms.edit', compact('product'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): RedirectResponse
    {
        /* request()->validate([
            'room_name' => 'required'
        ]); */

        $this->validate($request, [
            'room_name' => 'required',
        ]);
        
        $data = array('room_name'=> $request->input('room_name'), 
                      'room_status_id' => $request->input('room_status_id'),
                      'hosts_id' => $request->input('hosts_id'));

        $this->roomRepository->update($id, $data);
    
        return redirect()->route('rooms.index')
                        ->with('success','Room updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        
        $this->roomRepository->destroy($id);
        return redirect()->route('rooms.index')
                        ->with('success','Room deleted successfully');
    }
}
