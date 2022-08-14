<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Models\ProductsPurchaseTemp;
use App\Models\ProductsPurchase;
use App\Models\PurchaseRequest;
use App\Models\PurchaseOrder;
use App\Models\LaporanPR;
use App\Models\Users;

use Barryvdh\DomPDF\Facade\Pdf;

class PurchaseOrderController extends Controller
{
    public function index(){
        $purchase_order = PurchaseOrder::with('purchase_request')->get();
        return view('purchase.order', ['purchase_order' => $purchase_order]);
    }

    public function approve($id){
        $purchase_order = PurchaseOrder::with('purchase_request')->where('id', $id)->first();
        $product_purchase = ProductsPurchase::where('rack_id', $purchase_order->purchase_request->rack_id)->where('status', 'Process')->get();
        $getall = ProductsPurchase::where('rack_id', $purchase_order->purchase_request->rack_id)->get();
        foreach($product_purchase as $key => $product){
            $check = ProductsPurchase::where('rack_id', $purchase_order->purchase_request->rack_id)->where('name', $product->name)->where('pr_id', $purchase_order->pr_id)->where('status', 'Sold')->get();
            $x = ProductsPurchase::where('rack_id', $purchase_order->purchase_request->rack_id)->where('name', $product->name)->where('status', 'Process')->get();
            $y = ProductsPurchase::where('rack_id', $purchase_order->purchase_request->rack_id)->where('name', $product->name)->where('status', 'Sold')->get();
            if($check->count() > 0){
                foreach($check as $check_product){
                    if($product->name == $check_product->name){
                        $check_product->quantity += $product->quantity;
                        $check_product->save();
                        ProductsPurchase::find($product->id)->delete();
                    }else{
                        ProductsPurchase::find($product->id)->update([
                            'status' => 'Receiving',
                        ]);
                    }
                }
            }else{
                ProductsPurchase::find($product->id)->update([
                    'status' => 'Receiving',
                ]);
            }
        }
        PurchaseRequest::where('rack_id', $purchase_order->purchase_request->rack_id)->orderBy('id', 'DESC')->delete();
        PurchaseOrder::where('id', $id)->update([
            'status' => 'Receiving'
        ]);
        $get = PurchaseOrder::where('id', $id)->first();
        LaporanPR::where('id', $get->pr_id)->update([
            'status' => 'Receiving'
        ]);
        return back()->with('Success', 'Purchase di teruskan ke admin');
    }

    public function decline($id, $pr_id){
        $purchase_order = PurchaseOrder::with('purchase_request')->where('id', $id)->first();
        PurchaseOrder::where('id', $id)->update([
            'status' => 'Declined'
        ]);
        LaporanPR::where('id', $pr_id)->update([
            'status' => 'Declined'
        ]);
        ProductsPurchase::where('pr_id', $pr_id)->update([
            'status' => 'Declined'
        ]);
        PurchaseRequest::where('rack_id', $purchase_order->purchase_request->rack_id)->orderBy('id', 'DESC')->delete();
        return back()->with('Success', 'Data berhasil di decline');
    }

    public function receiving(Request $user){
        $purchase_order = PurchaseOrder::where('status', 'Receiving')->get();
        return view('purchase.receving', compact('purchase_order'));
    }

    public function receiving_approve(Request $user, $id){
        $purchase_order = PurchaseOrder::where('id', $id)->first();
        $laporan_pr = LaporanPR::where('id', $purchase_order->pr_id)->first();
        $product = ProductsPurchase::where('rack_id', $laporan_pr->rack_id)->where('status', 'Sold')->get();
        $check = ProductsPurchase::where('pr_id', $laporan_pr->id)->where('status', 'Receiving')->get();

        foreach( $check as $data ){
            ProductsPurchaseTemp::insert([
                'name' => $data->name,
                'quantity' => $data->quantity,
                'price' => $data->price,
                'type' => $data->type,
                'sell_price' => $data->sell_price,
                'image' => $data->image,
                'barcode' => $data->barcode,
                'rack_id' => $data->rack_id,
                'pr_id' => $data->pr_id,
                'expired_date' => $data->expired_date,
                'total_income' => $data->total_income,
                'status' => $data->status
            ]);
        }

        if($product->count() > 0){
            foreach( $product as $key => $sold ){
                if( $sold->name == $check[$key]->name ){
                    $sold->quantity += $check[$key]->quantity;
                    $sold->save();
                    ProductsPurchase::where('id', $check[$key]->id)->delete();
                }
            }
        }else{
            foreach($check as $key => $x){
                ProductsPurchase::where('id', $x->id)->update([
                    'status' => 'Sold',
                    'expired_date' => $user->expired_date,
                ]);
            }
        }
        LaporanPR::where('id', $purchase_order->pr_id)->update([
            'status' => 'Approved'
        ]);
        PurchaseOrder::find($id)->update([
            'status' => 'Approved'
        ]);
        return back()->with('Success', 'Transaksi berhasil di approve');
    }

    public function details($id, $pr_id){
        $laporan_pr = LaporanPR::where('id', $pr_id)->first();
        if( $laporan_pr->status == 'Approved' ){
            $products = ProductsPurchaseTemp::where('pr_id', $pr_id)->get();
        }else{
            $products = ProductsPurchase::where('pr_id', $pr_id)->get();
        }
        $po = PurchaseOrder::where('id', $id)->where('pr_id', $laporan_pr->id)->first();
        $users = Users::with('roles')->where('email', Session::get('email'))->first();
        return view('purchase.details', [
            'products' => $products, 
            'laporan_pr' => $laporan_pr,
            'po' => $po,
            'users' => $users,
            'detail_id' => $id,
            'detail_pr_id' => $pr_id
        ]);
    }

    public function exports($id, $pr_id){
        $products = ProductsPurchase::where('pr_id', $pr_id)->get();
        $laporan_pr = LaporanPR::where('id', $pr_id)->first();
        $po = PurchaseOrder::where('id', $id)->first();
        $users = Users::with('roles')->where('email', Session::get('email'))->first();
        $pdf = Pdf::loadView('exports.purchase_exports', [
            'products' => $products, 
            'laporan_pr' => $laporan_pr,
            'po' => $po,
            'users' => $users,
            'detail_id' => $id,
            'detail_pr_id' => $pr_id,
            'users' => $users
        ])->setOptions([ 'defaultFont' => 'sans-serif']);
        return $pdf->setPaper('A4')->stream();
    }

    public function delete_products($id, $pr_id){
        $products = ProductsPurchase::where('id', $id)->where('pr_id', $pr_id)->get();
        if( $products->count() > 1 ){
            ProductsPurchase::where('id', $id)->where('pr_id', $pr_id)->delete();
            return back()->with('Success', 'Product berhasil di hapus');
        }else{
            return back()->with('Error', 'Minimal 1 product harus ada');
        }
    }

    public function delete($id){
        $purchase_order = PurchaseOrder::where('id', $id)->first();
        $purchase_order->delete();
        ProductsPurchase::where('pr_id', $purchase_order->pr_id)->where('status', 'Process')->delete();
        return redirect()->route('purchase.order')->with('Success', 'Data berhasil di hapus');
    }

    public function invoice(){
        return view('purchase.invoice');
    }
}
