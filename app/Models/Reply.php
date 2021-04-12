<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ticket;

class Reply extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'text',
        'id_ticket'
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'id_user');
    }

    public function tickets()
    {
        return $this->belongsTo(Reply::class,'id_ticket');
    }
}
