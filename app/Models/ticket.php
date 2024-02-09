<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ticket extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function staff(){
      return $this->belongsTo(User::class, 'foreign_key', 'staff_id');
    }

    protected $table = 'tickets';
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'description',
        'ticket_id',
        'priority',
        'type',
    ];
}
