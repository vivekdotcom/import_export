<?php

namespace App\Http\Controllers;
use App\Mail\Notification;
use App\Models\Detail;
use App\Exports\DetailExport;
use App\Imports\ImportUser;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Hash;
use File;
use Mail;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    public function store(Request $request){
        $store = $request->all();

        Excel::import(new ImportUser, $request->file('attachment')->store('attachments'));

        $store = new Detail();
        $store->name =$request->name;
        $store->email =$request->email;
        $store->password=Hash::make($request->pwd);
        $store->attachment =$request->attachment;
        $store->save();
        $path = public_path('uploads');

            $attachment = $request->file('attachment');

            $name = time().'.'.$attachment->getClientOriginalExtension();



            // create folder

            if(!File::exists($path)) {

            File::makeDirectory($path, $mode = 0777, true, true);

            }

            $attachment->move($path, $name);

            $filename = $path.'/'.$name;

            try {

            Mail::to($store['email'])->send(new Notification($filename));

            } catch (\Exception $e) {

            return redirect()->back()->with('success', $e->getMessage());

            }
    }

    public function export(Request $request)
    {
        return Excel::download(new DetailExport, 'details.xlsx');
    }
    

}