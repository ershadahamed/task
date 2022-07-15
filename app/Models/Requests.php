<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    use HasFactory;

    protected $fillable = ['type_of_request', 'other_description', 'supplier', 'price', 'so_no', 'requested_by', 'approved_by', 'title1', 'description1', 'quantity1', 'remark1', 'title2', 'description2', 'quantity2', 'remark2', 'title3', 'description3', 'quantity3', 'remark3', 'title4', 'description4', 'quantity4', 'remark4'];

    public function requestedBy()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
