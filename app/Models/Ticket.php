<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Ticket extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = [
        'customer_id',
        'subject',
        'message',
        'status',
        'replied_at',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
