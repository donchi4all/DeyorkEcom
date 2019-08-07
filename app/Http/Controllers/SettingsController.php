<?php

namespace App\Http\Controllers;

use App\Setting;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::all();

        return view('settings.index')
            ->with('settings', $settings);
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
          $setting = Setting::find($id);

        if (empty($setting)) {
            Flash::error('Setting not found');

            return redirect(route('settings.index'));
        }

        return view('settings.edit')->with('setting', $setting);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id )
    {
     $setting =Setting::find($id);

        if (empty($setting)) {
            Flash::error('Setting not found');

            return redirect(route('settings.index'));
        }
  $request->validate([
      'cart_vat' => 'required|numeric',
      'invoice_address' => 'required',
  ]);
 
   $setting->update($request->all());

        Flash::success('Setting updated successfully.');

        return redirect(route('setting.index'));
    }

   
}
