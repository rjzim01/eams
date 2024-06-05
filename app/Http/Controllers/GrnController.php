<?php

namespace App\Http\Controllers;

use App\Models\Grn;
use App\Models\Uom;
use App\Models\Brand;
use App\Models\Spartpart;
use App\Models\Objecttorole;
use Illuminate\Http\Request;
use App\Models\Categorymodel;
use App\Models\Assetitem_po_mst;
use App\Models\Spareparts_po_mst;
use Illuminate\Support\Facades\Auth;

class GrnController extends Controller
{
    public function grnView()
    {
        $grn = Grn::with('categorymodel', 'assetitem_po_mst', 'spareparts_po_mst', 'spartpart', 'brand', 'user')->orderBy('id', 'desc')->get();
        //$grn = Grn::orderBy('id', 'desc')->get();
        $asset_item_po_mst = Assetitem_po_mst::get();
        $spareparts_po_mst = Spareparts_po_mst::get();
        $category_model = Categorymodel::get();
        $spartpart = Spartpart::get();
        $brand = Brand::get();
        //$workshops = Workshop::get();
        $umos = Uom::get();

        $userrole = Auth::user()->rollmanage_id;
        $roleaccess = Objecttorole::with('user', 'manageobject')
            ->where('rollmanage_id', '=', $userrole)->get();

        //return view("pages.meterPages.meter-create", compact('roleaccess', 'meters', 'assets'));
        return view("pages.grn.grn-create", compact('roleaccess', 'grn', 'asset_item_po_mst', 'spareparts_po_mst', 'category_model', 'spartpart', 'brand', 'umos'));
    }
    public function grnStore(Request $request)
    {
        // $request->validate([

        // ]);

        $data = [];
        $data['assetitem_po_mst_id'] = $request->assetitem_po_id;
        $data['spareparts_po_mst_id'] = $request->spareparts_po_id;
        $data['categorymodel_id'] = $request->category_model_id;
        $data['spartpart_id'] = $request->spare_parts_id;
        $data['brand_id'] = $request->brand_id;
        $data['unit_price'] = $request->unit_price;
        $data['quantity'] = $request->quantity;
        $data['totla_amount'] = $request->total_amount;
        $data['uom_id'] = $request->uom_id;
        //$data['stock_status'] = $request->stock_status;
        //$data['item_type'] = $request->item_type;

        $data['user_id'] = Auth::user()->id;
        //$data['updated_by'] = Auth::user()->id;

        $grns = Grn::insert($data);

        if ($grns) {
            return redirect()->route('grn-list')->with('message', 'GRN added Successfully');

        } else {
            return redirect()->back();
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
    public function grnEdit($id)
    {
        $grn = Grn::where('id', $id)->first();

        $userrole = Auth::user()->rollmanage_id;
        $roleaccess = Objecttorole::with('user', 'manageobject')
            ->where('rollmanage_id', '=', $userrole)->get();

        return view("pages.grn.grn-edit", compact('roleaccess', 'grn'));
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
}
