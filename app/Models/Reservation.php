<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Reservation extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

 
     protected $table = 'reservation';
 
     public $timestamps = false;
   
     protected $fillable = [
        'id_tur',
        'id_status',
        'summ',
        'date_start',
        'duration',
        'num_people',
        'id_user',
        'services'
    ];

}
