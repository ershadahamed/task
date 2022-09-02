<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = ['date_id', 'order_id', 'quotation_no', 'customer_name', 'product', 'description', 'filename', 'remark', 'submitted_by', 'approved_by', 'excel', 'urgent', 'request_revision'];

    public function submittedBy()
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
