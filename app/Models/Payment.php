<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
 
    protected $table = 'payments'; // Specify the table name if needed
    protected $primaryKey = 'payment_id'; // Set the custom primary key
    public $incrementing = true; // If payment_id is auto-incrementing
    protected $keyType = 'int'; // Specify the type (int or string)

    protected $fillable = ['booking_id', 'guest_id', 'amount', 'status', 'payment_intent_id', 'currency', 'payment_method'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function booking()
{
    return $this->belongsTo(Booking::class);
}


}
