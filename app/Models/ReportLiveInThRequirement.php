<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportLiveInThRequirement extends Model
{
    protected $table = 'report_live_in_th_requirements';
    protected $fillable = [
        'e_title',
        'e_body',
        'm_title',
        'm_body',
        't_title',
        't_body',
        's_title',
        's_body',
        'type',
    ];
}
