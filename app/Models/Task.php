<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['do_number', 'customer_name', 'printing', 'delivered', 'user_id', 'printing_by', 'delivered_by'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
