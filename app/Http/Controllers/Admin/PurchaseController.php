<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Supplier;
use App\Unit;
use App\Purchase;
use Auth;
use PDF;

class PurchaseController extends Controller
{
    public function view()
    {
        $allData = Purchase::orderBy('date', 'desc')->orderBy('id', 'desc')->get();
        return view('admin.purchase.view-purchase', compact('allData'));
    }

    public function add()
    {
        $data['suppliers'] = Supplier::all();
        $data['units'] = Unit::all();
        $data['categories'] = Category::all();
        $data['products'] = Product::all();
        return view('admin.purchase.add-purchase', $data);
    }

    public function store(Request $request)
    {
        if ($request->category_id == null) {
            return redirect()->back()->with('error', 'Sorry! You do not select any item.');
        } else {
            $count_category = count($request->category_id);
            for ($i=0; $i < $count_category; $i++){
                $purchase = new Purchase();
                $purchase->date = date('Y-m-d', strtotime($request->date[$i]));
                $purchase->purchase_no = $request->purchase_no[$i];
                $purchase->supplier_id = $request->supplier_id[$i];
                $purchase->category_id = $request->category_id[$i];
                $purchase->product_id = $request->product_id[$i];
                $purchase->buying_qty = $request->buying_qty[$i];
                $purchase->unit_price = $request->unit_price[$i];
                $purchase->buying_price = $request->buying_price[$i];
                $purchase->description = $request->description[$i];
                $purchase->created_by = Auth::guard('admin')->user()->id;
                $purchase->status = '0';
                $purchase->save();
            }
        }
        return  redirect()->route('purchase.view')->with('success', 'Data saved successfully');
    }
    function pendingList(){
        $allData = Purchase::orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', '0')->get();
        return view('admin.purchase.view-pending-list', compact('allData'));
    }


    public function approve($id)
    {
        $purchase = Purchase::find($id);
        $product = Product::where('id', $purchase->product_id)->first();
        $purchase_qty = ((float)($purchase->buying_qty))+((float)($product->quantity));
        $product->quantity = $purchase_qty;
        if($product->save()){
            DB::table('purchases')
                ->where('id', $id)
                ->update(['status' => 1]);
        }

        return redirect()->route('purchase.pending.list')->with('success', 'Purchase approved!');
    }

    public function dailyReport(){
        return view('admin.purchase.daily-purchase-report');
    }

    public function dailyReportPDF(Request $request){
        $startDate = date('Y-m-d', strtotime($request->start_date));
        $endDate = date('Y-m-d', strtotime($request->end_date));
        $data['allData'] = Purchase::whereBetween('date', [$startDate, $endDate])->where('status', '1')->orderBy('supplier_id')->orderBy('category_id')->orderBy('product_id')->get();
        $data['start_date'] = date('Y-m-d', strtotime($request->start_date));
        $data['end_date'] = date('Y-m-d', strtotime($request->end_date));
        $pdf = PDF::loadView('admin.pdf.daily-purchase-report-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->download('document.pdf');
    }

    public function delete($id)
    {
        $data = Purchase::find($id);
        $data->delete();
        return redirect()->route('purchase.view')->with('warning', 'Purchase Deleted!');
    }
}
