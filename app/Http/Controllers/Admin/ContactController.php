<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Contact;
class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $records = Contact::paginate(20);
       return view('admin.contacts.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contacts/create');
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
          'phone'  => 'required',
          'title'  => 'required',
          'content'  => 'required',

        ];

        $messages = [
          'name.required' => 'Name is Required',
          'email.required' => 'Name is Required',
          'phone.required' => 'Name is Required',
          'title.required' => 'Name is Required',
          'content.required' => 'Name is Required',
        ];

        $this->validate($request,$rules,$messages);

        $record = Contact::create($request->all());

        flash()->success("Success");
        return redirect(route('admin.contacts.index'));
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
        $model = Contact::findOrFail($id);
        return view('admin.contacts.edit',compact('model'));
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
        $record = Contact::findOrFail($id);
        $record->update($request->all());
        flash()->success("Edited");
        return redirect(route('admin.contacts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $record = Contact::findOrFail($id);
      $record->delete();
      flash()->success("Deleted");
      return redirect(route('admin.contacts.index'));
    }
}
