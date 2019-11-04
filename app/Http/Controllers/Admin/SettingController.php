<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Setting;
class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $records = Setting::paginate(20);
       return view('admin.settings.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $rules = [
        //   'logo'  => 'required',
        //   'phone'  => 'required',
        //   'email'  => 'required',
        //   'fb_url'  => 'required',
        //   'tw_url'  => 'required',
        //   'yt_url'  => 'required',
        //   'ins_url'  => 'required',
        //   'wa_url'  => 'required',
        //   'go_url'  => 'required',
        //   'about'  => 'required'
        // ];
        //
        // $messages = [
        //   'logo.required' => 'Logo is Required',
        //   'phone.required' => 'Phone is Required',
        //   'email.required' => 'Email is Required',
        //   'fb_url.required' => 'Fas_url is Required',
        //   'tw_url.required' => 'Tw_url is Required',
        //   'yt_url.required' => 'Yt_url is Required',
        //   'ins_url.required' => 'Ins_Url is Required',
        //   'wa_url.required' => 'Wa_Url is Required',
        //   'go_url.required' => 'Go_Url is Required',
        //   'about.required' => 'about is Required'
        //
        // ];
        //
        // $this->validate($request,$rules,$messages);
        //
        // $record = Setting::create($request->all());
        // if ( $request->hasFile('image')  ) {
        //     $logo = $request->image;
        //     $logo_new_name = time() . $logo->getClientOriginalName();
        //     $logo->move('uploads/setting', $logo_new_name);
        //     $record->image = 'uploads/setting/'.$logo_new_name;
        //     $record->save();
        // }
        //
        // flash()->success("Success");
        // return redirect(route('admin.settings.index'));
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
        $model = Setting::findOrFail($id);
        return view('admin.settings.edit',compact('model'));
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
        $record = Setting::findOrFail($id);
        $record->update($request->all());
        flash()->success("Edited");
        return redirect(route('admin.settings.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $record = Setting::findOrFail($id);
      $record->delete();
      flash()->success("Deleted");
      return redirect('settings.index');
    }
}
