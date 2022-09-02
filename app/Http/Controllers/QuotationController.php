<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use File;

class QuotationController extends Controller
{
    public function index()
    {
        return view('quotation')->with('quotations', Quotation::where('approved_by', null)->get());
    }

    public function submitpage()
    {
        return view('quotation-submitpage')->with('quotations', Quotation::latest('id')->first());
    }

    public function storeform(Request $r)
    {
        $r->validate([
            'customer_name' => 'required',
            'filename' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024'
        ]);

        if ($r->filename!=null){
            $filename = time().'.'.$r->filename->extension();
            $r->filename->move(public_path('imageupload'), $filename);
        } else {
            $filename = null;
        }

        $quotation = Quotation::create([

            'date_id' => $r->date_id,
            'order_id' => $r->order_id,
            'quotation_no' => $r->quotation_no,
            'customer_name' => $r->customer_name,

            'product' => $r->product,
            'description' => $r->description,
            'filename' => $filename,
            'remark' => $r->remark,
            'submitted_by' => Auth::user()->id,
            'approved_by' => null,

            'excel' => null,
            'urgent' => null,
            'request_revision' => null,
        ]);

        return redirect('/quotation')->with('status', "Successfully submitted new quotation!");
    }

    public function approved ()
    {
        return view('quotationapproved')->with('quotations', Quotation::where('approved_by', !null)->get());
    }

    public function viewform ($id)
    {
        return view('quotationview')->with('quotations', Quotation::where('id', $id)->get());
    }

    public function destroy($id)
    {
        $quotation = Quotation::findOrFail($id);

        if(File::exists(public_path('imageupload/'.$quotation->filename))){
            File::delete(public_path('imageupload/'.$quotation->filename));
        }

        $quotation_id = $quotation->quotation_no;

        $quotation->delete();
        return redirect('/quotation')->with('failed', "Quotation $quotation_id has been deleted!");;


    }

    public function approveform($id)
    {
        $quotation = Quotation::find($id);
        $quotation->approved_by = Auth::user()->id;
        $quotation->request_revision = 0;
        $quotation->save();

        return back()->with('status', "This quotation has been approved!");
    }

    public function editform ($id)
    {
        return view('quotationedit')->with('quotations', Quotation::where('id', $id)->get());
    }

    public function updateform(Request $r)
    {
        $r->validate([
            'customer_name' => 'required',
            'filename' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($r->filename!=null){
            $filename = time().'.'.$r->filename->extension();
            $r->filename->move(public_path('imageupload'), $filename);
        } else {
            $filename = null;
        }

        $quotation = Quotation::find($r->id);
        $quotation->customer_name = $r->customer_name;
        $quotation->product = $r->product;
        $quotation->description = $r->description;
        $quotation->filename = $filename;
        $quotation->remark = $r->remark;
        $quotation->save();

        return redirect('/quotation/view/'.$r->id)->with('status', "Quotation updated!");
    }

    public function excel(Request $r)
    {
        $quotation = Quotation::find($r->ids);
        $quotation->excel = $r->checkedStatus;
        $quotation->save();

        return response()->json(['message' => 'Status excel updated successfuly']);
    }

    public function urgent(Request $r)
    {
        $quotation = Quotation::find($r->ids);
        $quotation->urgent = $r->checkedStatus;
        $quotation->save();

        return response()->json(['message' => 'Status urgent updated successfuly']);
    }

    public function requestrevision(Request $r)
    {
        $quotation = Quotation::find($r->ids);
        $quotation->request_revision = $r->checkedStatus;
        $quotation->approved_by = null;
        $quotation->save();

        return response()->json(['message' => 'Status request revision updated successfuly']);
    }
}
