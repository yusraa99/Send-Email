<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transactions;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'total_price',
        'min_invest',
        'invest_amount',
    ];



    public function transactions() {
        return $this->hasMany(Transactions::class, 'project_id');
    }

    public function increaseBalance($amount){
        $current_amount= $this->balance;

        $this->update(['invest_amount'=> $current_amount+$amount]);
    }
}
