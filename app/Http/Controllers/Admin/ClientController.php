<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Client;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $records = Client::paginate(20);
       return view('admin.clients.index', compact('records'));
    }

    public function active($id){
       $record = Client::findOrFail($id);
       $record->is_active =0;
       $record->save();
       return back();
     }
     public function disactive($id){
         $record = Client::findOrFail($id);
         $record->is_active =1;
         $record->save();
         return back();
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
          'name'  => 'required',
          'email'  => 'required',
          'date_of_birth'  => 'required',
          'blood_type_id'  => 'required',
          'last_donation_date'  => 'required',
          'city_id'  => 'required',
          'phone'  => 'required',
          'password'  => 'required'
        ];

        $messages = [
          'name.required' => 'Name is Required',
          'email.required' => 'Email is Required',
          'date_of_birth.required' => 'Date_of_birth is Required',
          'blood_type_id.required' => 'Blood_type_id is Required',
          'last_donation_date.required' => 'Last_donation_date is Required',
          'city_id.required' => 'City_id is Required',
          'phone.required' => 'Phone is Required',
          'password.required' => 'Password is Required'
        ];

        $this->validate($request,$rules,$messages);

        $record = Client::create($request->all());

        flash()->success("Success");
        return Redirect(route('admin.clients.index'));
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
        $model = Client::findOrFail($id);
        return view('admin.clients.edit',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $record = Client::findOrFail($id);
        $record->update($request->all());
        flash()->success("Edited");
        return redirect(route('admin.clients.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $record = Client::findOrFail($id);
      $record->delete();
      flash()->success("Deleted");
      return redirect(route('admin.clients.index'));
    }
}
