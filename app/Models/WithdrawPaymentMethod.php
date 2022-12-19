<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawPaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'freelancer_id',
        'bkash_account',
        'bkash_account_type',
        'bkash_status',

        'nagad_account',
        'nagad_account_type',
        'nagad_status',

        'rocket_account',
        'rocket_account_type',
        'rocket_status',

        'cellfin_account',
        'cellfin_holder',
        'cellfin_status',

        'dbbl_ac_account',
        'dbbl_holder',
        'dbbl_branch',
        'dbbl_status',

        'ibbl_ac_account',
        'ibbl_holder',
        'ibbl_branch',
        'ibbl_status',

        'bank_asia_ac_account',
        'bank_asia_holder',
        'bank_asia_branch',
        'bank_asia_status',

        'dhaka_ac_account',
        'dhaka_bank_holder',
        'dhaka_bank_branch',
        'dhaka_bank_status',
        
    ];
}
