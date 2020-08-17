<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhonebookRequest;
use App\Phonebook;
use Illuminate\Http\Request;
use Validator;
class PhonebookController extends Controller
{

    public function index()
    {
      return view('phonebook');
    }

    public function getData()
    {
      return Phonebook::orderBy('name','ASC')->get();
    }
    public function getOne($id)
    {
      if($id){
        return Phonebook::findorFail($id);
      }
    }
    public function store(PhonebookRequest $request){
      // return $request->all();
      // $rules=[
      //   'name' => 'required|max:255|min:3',
      //   'phone'=> 'required|max:10',
      //   'email'=> 'required|email|unique:phonebooks,email,'.$request->id
      // ];
      // $this->validate($request, $rules);
      // $validator = Validator::make($request->all(),$rules);
        $pb = new Phonebook;
        $pb->name = $request->name;
        $pb->phone = $request->phone;
        $pb->email = $request->email;
        $pb->save();
        return $pb;
    }
    public function update(PhonebookRequest $request){//
        $pb = Phonebook::findorFail($request->id);
        $pb->name = $request->name;
        $pb->phone = $request->phone;
        $pb->email = $request->email;
        $pb->save();
        // return $pd;
    }
    public function destroy(Phonebook $phonebook)
    {
        Phonebook::where('id',$phonebook->id)->delete();
    }
}
