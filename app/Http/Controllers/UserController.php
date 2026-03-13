<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\DataTables;
use Hash;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Rules\MatchOldPassword;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*')
                    ->where('active',1)
                    ->orderBy('created_at','DESC');
            return DataTables::of($data)
                    ->addIndexColumn()        
                    ->addColumn('action', function($row){
                        $btn = '<div class="btn-group"><a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-edit" 
                        data-bs-toggle="tooltip" title="Edit"><i class="fa fa-fw fa-pencil-alt"></i></span>';
                        $btn .= '<a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-delete"
                                 data-bs-toggle="tooltip" title="Delete"><i class="fa fa-fw fa-times"></i></a>';
                        $btn .= '<a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-reset"
                        data-bs-toggle="tooltip" title="reset"><i class="fa fa-fw fa-key"></i></a></div>';
                        return $btn;
                    })
                    ->escapeColumns([])
                    ->make(true);
        }
        return view('user.index');
    }
    
    public function profile()
    {
        return view('user.profile');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
 


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->request->add(['password' => Hash::make($request->password)]);
        User::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(request()->ajax()) {
            $data = User::FindOrFail($id);
            return response()->json(['data'=>$data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)
                  ->update([
                      'active' => '0'
                  ]);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        return redirect()->route('profile')->with('success',"Password berhasil diupdate!");
        
    }
    
    public function reset(Request $request, User $user)
    {
        $request->validate([
            'reset_password' => ['required'],
        ]);

        if(request()->ajax()) {
            $user = User::where('id', $request->reset_id)
                  ->update(['password'=> Hash::make($request->reset_password)]);

        }
    }
}
