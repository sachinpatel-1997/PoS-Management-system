<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Facades\Auth;
use App\Payment;
use PDF;
class CustomerController extends Controller
{
     public function view(){
        $allData = Customer::all();
        return view('admin.customer.view-customer', compact('allData'));
    }

    public function add(){
        return view('admin.customer.add-customer');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'mobile_no' => 'required',
            'email' => 'required|unique:customers',
            'address' => 'required',
        ]);

        $data = new Customer();
        $data->name = $request->name;
        $data->mobile_no = $request->mobile_no;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->created_by = Auth::guard('admin')->user()->id;
        $data->save();

        return redirect()->route('customers.view')->with('success', 'Customer added successful!');
    }

    public function edit($id){
        $editData = Customer::find($id);
        return view('admin.customer.edit-customer', compact('editData'));
    }

    public function update($id, Request $request){
        $data = Customer::find($id);
        $data->name = $request->name;
        $data->mobile_no = $request->mobile_no;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->updated_by = Auth::guard('admin')->user()->id;
        $data->save();
        return redirect()->route('customers.view')->with('success', 'Customer info updated!');
    }

    public function credit(){
        $allData = Payment::whereIn('paid_status', ['full_due', 'partial_paid'])->get();
        return view('admin.customer.customer-credit', compact('allData'));
    }

    public function creditPdf(){
        return redirect()->back()->with('error', 'Please download from credit page....');
    }

    public function paid(){
        $allData = Payment::where('paid_status', '!=', 'full_due')->get();
        return view('admin.customer.customer-paid', compact('allData'));
    }

    public function paidPdf(){
        return redirect()->back()->with('error', 'Please download from paidlist page....');
    }

    public function customerWishReport(){
        $customers = Customer::all();
        return view('admin.customer.customer-wish-report', compact('customers'));
    }

    public function invoiceEdit($invoice_id){
        $payment = Payment::where('invoice_id', $invoice_id)->first();
        return view('admin.customer.edit-invoice', compact('payment'));
    }

    public function invoiceUpdate(Request $request, $invoice_id){
        if($request->new_paid_amount < $request->paid_amount){
            return redirect()->back()->with('error', 'Sorry! you have paid unknown amount.');
        } else {
            $payment = Payment::where('invoice_id', $invoice_id)->first();
            $payment_details = new \App\Model\PaymentDetail();
            $payment->paid_status = $request->paid_status;
            if($request->paid_amount == 'full_paid'){
                $payment->paid_amount = Payment::where('invoice_id', $invoice_id)->first()['paid_amount']+$request->new_paid_amount;
                $payment->due_amount = '0';
                $payment_details->current_paid_amount = $request->new_paid_amount;
            } elseif($request->paid_status == 'partial_paid'){
                $payment->paid_amount = Payment::where('invoice_id', $invoice_id)->first()['paid_amount']+$request->paid_amount;
                $payment->due_amount = Payment::where('invoice_id', $invoice_id)->first()['due_amount']-$request->paid_amount;
                $payment_details->current_paid_amount = $request->paid_amount;
            }

            $payment->save();
            $payment_details->invoice_id = $invoice_id;
            $payment_details->date = date('Y-m-d', strtotime($request->date));
            $payment_details->save();

            return redirect()->route('customers.credit')->with('success', 'Invoice Updated Successfully!');
        }
    }

    public function invoiceDetailsPdf($invoice_id){
        $data['payment'] = Payment::where('invoice_id', $invoice_id)->first();
        $pdf = PDF::loadView('admin.pdf.customer-invoice-details-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->download('document.pdf');

    }

    public function delete($id){
        $data = Customer::find($id);
        $data->delete();
        return redirect()->route('customers.view')->with('warning', 'Customer Deleted!');
    }
}
