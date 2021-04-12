<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reply;

class Ticket extends Model
{
    use HasFactory;
    protected $table = 'tickets';
    protected $fillable = [
        'name',
        'subject',
        'category',
        'sector',
        'status',
        'grade'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'id_user');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class,'id_ticket');
    }
}
