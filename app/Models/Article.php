<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Article extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = ['title', 'user_name', 'user_email', 'content'];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $table = 'articles';


    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
