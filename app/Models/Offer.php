<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable=[
        'cpf','institution','institution_id','name_modal','cod','PMin','PMax','PMedium','VMin','VMax' ,'VMedium', 'TaxesMonth', 'ValueToPay'
    ];

    protected $table = 'offer';
}
