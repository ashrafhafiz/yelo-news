<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Carbon instance fields - not working
    // protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function scopePublished(Builder $query): void
    {
        $query->where('published_at', '<=', Carbon::now());
    }

    public function scopeFeatured(Builder $query): void
    {
        $query->where('featured', true);
    }

    public function scopeWithCategory(Builder $query, string $category): void
    {
        $query->whereHas('categories', function ($query) use ($category) {
            $query->where('slug', $category);
        });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function Categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function getExcerpt()
    {
        return Str::limit(strip_tags($this->body), 100, '...');
    }

    public function getReadingTime()
    {
        $mins = str_word_count($this->body) / 250;
        return ($mins < 1 ? 1 : $mins);
    }

    public function getThumbnailImage()
    {
        $isUrl = str_contains($this->image, 'http');
        return $isUrl ? $this->image : Storage::disk('public')->url($this->image);
    }
}
