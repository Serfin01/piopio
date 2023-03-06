<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Events\PioCreated;

class Pio extends Model
{
    use HasFactory;
    protected $fillable=[
        'message',
    ];

    protected $dispatchesEvents=[
        'created'=>PioCreated::class,
    ];
    /**
     * returns user owner
     *
     * @return User
     */
    function user(){
        return $this->belongsTo(User::class);
    }
}
