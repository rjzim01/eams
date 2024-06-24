<?php

namespace App\Http\Controllers;

use App\Models\Grn;
use App\Models\Uom;
use App\Models\Brand;
use App\Models\Company;
use App\Models\Assetitem;
use App\Models\Spartpart;
use App\Models\Objecttorole;
use Illuminate\Http\Request;
use App\Models\Categorymodel;
use App\Models\Assetitem_po_mst;
use App\Models\Assetitem_po_dtl;
use App\Models\Spareparts_po_mst;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class GrnController extends Controller
{
    public function grnView()
    {
        $pendingAssetItemPoMsts = Assetitem_po_mst::where('status', 'pending')->get();
        $grn = Grn::with('categorymodel', 'assetitem_po_mst', 'spareparts_po_mst', 'spartpart', 'brand', 'user')->orderBy('id', 'desc')->get();
        //$grn = Grn::orderBy('id', 'desc')->get();
        $asset_item_po_mst = Assetitem_po_mst::get();
        $asset_item_po_dtls = Assetitem_po_dtl::get();
        $spareparts_po_mst = Spareparts_po_mst::get();
        $category_model = Categorymodel::get();
        $spartpart = Spartpart::get();
        $brand = Brand::get();
        //$workshops = Workshop::get();
        $umos = Uom::get();

        $userrole = Auth::user()->rollmanage_id;
        $roleaccess = Objecttorole::with('user', 'manageobject')
            ->where('rollmanage_id', '=', $userrole)->get();

        $company = Company::where('name', '=', Auth::user()->company_name)->get();
        //$comid = $company[0]->id;

        return view("pages.grn.grn-create", compact('roleaccess', 'grn', 'asset_item_po_mst', 'asset_item_po_dtls', 'spareparts_po_mst', 'category_model', 'spartpart', 'brand', 'umos', 'company', 'pendingAssetItemPoMsts'));
        //return $pendingAssetItemPoMsts;
    }
    // public function grnStore(Request $request)
    // {
    //     // $request->validate([

    //     // ]);

    //     // $data = [];
    //     // $data['assetitem_po_mst_id'] = $request->assetitem_po_id;
    //     // //$data['assetitem_po_dtls_id'] = $request->assetitem_po_dtls_id;
    //     // $data['spareparts_po_mst_id'] = $request->spareparts_po_id;
    //     // $data['categorymodel_id'] = $request->category_model_id;
    //     // $data['spartpart_id'] = $request->spare_parts_id;
    //     // $data['brand_id'] = $request->brand_id;
    //     // $data['unit_price'] = $request->unit_price;
    //     // $data['quantity'] = $request->quantity;
    //     // $data['totla_amount'] = $request->total_amount;
    //     // $data['uom_id'] = $request->uom_id;
    //     // //$data['stock_status'] = $request->stock_status;
    //     // //$data['item_type'] = $request->item_type;

    //     // $data['user_id'] = Auth::user()->id;
    //     // $data['company_id'] = $request->company_id;
    //     // //$data['updated_by'] = Auth::user()->id;

    //     // $grns = Grn::insert($data);
    //     ///////////////////////////////////////////////////////////////////////

    //     dd($request->all());
    //     $validatedData = $request->validate([
    //         'assetitem_po_mst_id' => 'required',
    //     ]);

    //     // Create a new Grn
    //     $assetItem = Grn::create($validatedData);

    //     if ($assetItem) {
    //         // Extract detail data from request
    //         $detailData = [];
    //         foreach ($request->input('categorymodel_id') as $key => $value) {
    //             $detailData[] = [
    //                 'assetitem_po_mst_id' => $assetPurchaseOrder_mst->id,
    //                 'categorymodel_id' => $request->input('categorymodel_id')[$key],
    //                 'brand_id' => $request->input('brand_id')[$key],
    //                 'unit_price' => $request->input('unit_price')[$key],
    //                 'quantity' => $request->input('quantity')[$key],
    //                 'total_amount' => $request->input('total_amount')[$key],
    //                 'uom_id' => $request->input('uom_id')[$key],
    //                 'user_id' => Auth::id(),
    //                 'updated_by' => Auth::user()->name,
    //             ];
    //         }

    //         // Create detail records
    //         Assetitem::insert($detailData);

    //         //return redirect()->route('assetPurchaseOrder-view')->with('message', 'Asset Purchase Order added Successfully');
    //         return redirect()->route('grn-list')->with('message', 'GRN added Successfully');
    //     }
    //     // if ($assetItem) {
    //     //     return redirect()->route('grn-list')->with('message', 'GRN added Successfully');

    //     // } 
    //     else {
    //         return redirect()->back();
    //     }
    // }


    public function grnEdit($id)
    {
        $asset_item_po = Assetitem_po_mst::where('id', $id)->with('spareParts')->first();
        $asset_item_po_dtls = Assetitem_po_dtl::where('assetitem_po_mst_id', $id)->with('assetItemPo', 'categoryModel', 'brand')->get();
        //$purchaseOrder = Assetitem_po_mst::with('details', 'workshop', 'supplier', 'company', 'user')->findOrFail($id);
        $grn = Grn::where('id', $id)->first();

        $userrole = Auth::user()->rollmanage_id;
        $roleaccess = Objecttorole::with('user', 'manageobject')
            ->where('rollmanage_id', '=', $userrole)->get();

        return view("pages.grn.grn-edit-2", compact('roleaccess', 'grn', 'asset_item_po', 'asset_item_po_dtls'));
        //return $asset_item_po;
    }
    public function grnStore(Request $request)
    {
        //dd($request->all());
        // Validate the request data
        $validatedData = $request->validate([
            'assetitem_po_mst_id' => 'required',
            //'spareparts_po_mst_id' => 'required',
            //'company_id' => 'required',
            'asset_item_po_dtls_id.*' => 'required',
            'categorymodel_id.*' => 'required',
            'brand_id.*' => 'required',
            'unit_price.*' => 'required|numeric',
            'quantity.*' => 'required|integer',
            'total_amount.*' => 'required|numeric',
        ]);

        // Create a new Grn
        $grn = Grn::create([
            'assetitem_po_mst_id' => $validatedData['assetitem_po_mst_id'],
            //'spareparts_po_mst_id' => $validatedData['spareparts_po_mst_id'],
            //'company_id' => $request->company_id,
            'uom_id' => 1,
            'stock_status' => 'Pending',
            'user_id' => Auth::id(),
        ]);

        // Check if GRN was created successfully
        if ($grn) {
            // Prepare detail data for insertion
            $detailData = [];
            foreach ($request->input('categorymodel_id') as $key => $value) {
                $detailData[] = [
                    'assetitem_po_mst_id' => $request->input('assetitem_po_mst_id'),
                    'categorymodel_id' => $request->input('categorymodel_id')[$key],
                    'brand_id' => $request->input('brand_id')[$key],
                    'unit_price' => $request->input('unit_price')[$key],
                    'user_id' => Auth::id(),
                    'updated_by' => Auth::user()->name,
                    'asset_status' => $request->input('asset_status')[$key],
                    'supplier_id' => $request->input('supplier_id')[$key],
                    'company_id' => $request->input('company_id')[$key],
                    'currency_id' => $request->input('currency')[$key],
                    // 'pruchase_date' =>,
                    // 'stock_sts' =>,
                ];
            }

            // Insert detail data
            Assetitem::insert($detailData);

            // Redirect with success message
            return redirect()->route('grn-list')->with('message', 'GRN added Successfully');
        } else {
            // Redirect back if GRN creation failed
            return redirect()->back()->with('error', 'Failed to create GRN');
        }
    }
    function grnList(Request $request)
    {
        $grn = Grn::with('categorymodel', 'assetitem_po_mst', 'spareparts_po_mst', 'spartpart', 'brand', 'user')->orderBy('id', 'desc')->get();

        $userrole = Auth::user()->rollmanage_id;
        $roleaccess = Objecttorole::with('user', 'manageobject')
            ->where('rollmanage_id', '=', $userrole)->get();

        return view("pages.grn.grn-list", compact('roleaccess', 'grn'));

    }

    public function grnUpate(Request $request)
    {
        // $request->validate([
        //     'meter_no' => 'required',
        //     'description' => 'required|max:255',
        // ]);

        $data = [];
        $data['unit_price'] = $request->unit_price;
        $data['quantity'] = $request->quantity;
        $data['totla_amount'] = $request->totla_amount;
        $data['stock_status'] = $request->stock_status;

        $update = Grn::where('id', $request->id)->limit(1)->update($data);

        if ($update) {
            return redirect()->route('grn-list')->with('message', 'GRN Updated Successfully');

        } else {
            return redirect()->back();
        }
    }
    public function grnDelete($id)
    {
        $grn = Grn::find($id)->delete();
        if ($grn) {
            return redirect()->route('grn-list')->with('message', 'Data deleted successfully');
        } else {
            return redirect()->back();
        }
    }
    public function grnReport($id)
    {
        //$purchaseOrder = Assetitem_po_mst::with('details', 'workshop', 'supplier', 'company', 'user')->findOrFail($id);
        $purchaseOrder = Grn::with('categorymodel', 'assetitem_po_mst', 'spareparts_po_mst', 'spartpart', 'brand', 'user')->findOrFail($id);

        $data = [
            'purchaseOrder' => $purchaseOrder,
        ];

        // $pdf = PDF::loadView('pages.grn.grn_report', $data);
        // return $pdf->download('grn_report.pdf');

        // Generate a unique name using a timestamp
        $timestamp = now()->format('Ymd_His');
        $fileName = 'grn_report_' . $timestamp . '.pdf';

        $pdf = PDF::loadView('pages.grn.grn_report', $data);
        return $pdf->download($fileName);
    }
}
