<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Categories;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Upload extends Model
{
    use HasFactory;
    use HasUlids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int,string>
     */
    protected $fillable = [
        'category',
        'path',
        'filename',
        'description',
        'year',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'category' => Categories::class,
    ];

    /** @return BelongsTo<User,self> */
    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected static function booted()
    {
        self::updating(function (self $model) {
            if ($model->isDirty('path')) {
                Storage::delete($model->getOriginal('path'));
            }
        });

        self::deleted(function (self $model) {
            Storage::delete($model->getAttribute('path'));
        });
    }
}
