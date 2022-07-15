<?php

namespace App\Http\Controllers;

use App\Models\Requests;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PDF;

class RequestsController extends Controller
{
    public function index()
    {
        //return view('requests')->with('requests', Requests::where('approved_by', null)->get());
        $requests = Requests::where('approved_by', null)->get();
        // $users = User::all();

        // return view('requests',compact('requests', 'users'));

        foreach($requests as $r){
            dd($r->user());
        }
        
    }

    public function view()
    {
        return view('requestsview')->with('requests', Requests::all());
    }

    public function submitform()
    {
        return view('requests-submitform');
    }

    public function storeform(Request $r)
    {
        
        $requests = Requests::create([
            
            'type_of_request' => $r->type_of_request,
            'other_description' => $r->other_description,
            
            'supplier' => $r->supplier,
            'price' => $r->price,
            'so_no' => $r->so_no,
            'requested_by' => Auth::user()->id,
            'approved_by' => null,
            
            'title1' => $r->title1,
            'description1' => $r->description1,
            'quantity1' => $r->quantity1,
            'remark1' => $r->remark1,

            'title2' => $r->title2,
            'description2' => $r->description2,
            'quantity2' => $r->quantity2,
            'remark2' => $r->remark2,

            'title3' => $r->title3,
            'description3' => $r->description3,
            'quantity3' => $r->quantity3,
            'remark3' => $r->remark3,

            'title4' => $r->title4,
            'description4' => $r->description4,
            'quantity4' => $r->quantity4,
            'remark4' => $r->remark4,
        ]);

        return redirect('/requests')->with('status', "Successfully submitted '".$r->title1."' request form");
    }

    public function approved ()
    {
        //return view('requestsapproved')->with('requests', Requests::where('approved_by', !null)->get());
        $requests = Requests::where('approved_by', !null)->get();
        $users = User::all();

        return view('requestsapproved',compact('requests', 'users'));
    }

    public function viewform ($id)
    {
        return view('requestsview')->with('requests', Requests::where('id', $id)->get());
    }

    public function destroy($id)
    {
        $requests = Requests::findOrFail($id);
        $requests->delete();
        return redirect('/requests');
    }

    public function approveform($id)
    {
        $requests = Requests::find($id);
        $requests->approved_by = Auth::user()->id;
        $requests->save();

        return back()->with('status', "This request form has been approved!");
    }

    public function exportPDF($id)
    {
        $requests = Requests::where('id', $id)->get();
        $users = User::all();
        $pdf = PDF::loadView('pdf', compact('requests', 'users'));
        return $pdf->download('Request Form.pdf');
    }

    public function editform ($id)
    {
        return view('requestsedit')->with('requests', Requests::where('id', $id)->get());
    }

    public function updateform(Request $r)
    {
        $requests = Requests::find($r->id);
        $requests->type_of_request = $r->type_of_request;
        $requests->other_description = $r->other_description;
        
        $requests->supplier = $r->supplier;
        $requests->price = $r->price;
        $requests->so_no = $r->so_no;
        
        $requests->title1 = $r->title1;
        $requests->description1 = $r->description1;
        $requests->quantity1 = $r->quantity1;
        $requests->remark1 = $r->remark1;

        $requests->title2 = $r->title2;
        $requests->description2 = $r->description2;
        $requests->quantity2 = $r->quantity2;
        $requests->remark2 = $r->remark2;

        $requests->title3 = $r->title3;
        $requests->description3 = $r->description3;
        $requests->quantity3 = $r->quantity3;
        $requests->remark3 = $r->remark3;

        $requests->title4 = $r->title4;
        $requests->description4 = $r->description4;
        $requests->quantity4 = $r->quantity4;
        $requests->remark4 = $r->remark4;
        $requests->save();

        return redirect('/requests/view/'.$r->id)->with('status', "Request form updated!");
    }
}
