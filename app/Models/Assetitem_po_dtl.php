<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assetitem_po_dtl extends Model
{
    use HasFactory;

    public function assetItemPo()
    {
        return $this->belongsTo(Assetitem_po_mst::class, 'assetitem_po_mst_id');
    }
    public function categoryModel()
    {
        return $this->belongsTo(Categorymodel::class, 'categorymodel_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    // Define the relationship to the brand table
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function uom()
    {
        return $this->belongsTo(Uom::class, 'uom_id');
    }

    // Define the relationship to the user table
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
