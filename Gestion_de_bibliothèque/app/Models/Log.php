<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Log extends Model
{
    use HasFactory;

    protected $table = 'logs';

    protected $fillable = [
        'user_id',
        'action',
        'dateAction',
        'adresseIP',
    ];

    protected $dates = ['dateAction'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public static function enregistrerAction($action, $userId = null, $ipAddress = null)
    {
        return self::create([
            'action' => $action,
            'user_id' => $userId,
            'dateAction' => now(),
            'adresseIP' => $ipAddress ?? request()->ip(),
        ]);
    }
}
