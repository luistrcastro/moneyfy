<?php

namespace App\Models;

use App\Scopes\AuthUserScope;
use App\Traits\HashedId;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Transaction extends Model
{
    use HasFactory;
    use HashedId;

    public $table = 'transactions';

    /**
     * Overrides the model's booted method
     * @return void
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new AuthUserScope);

        static::creating(function ($query) {
            $query->user_id = Auth::user()->getKey();
        });
    }

    public $fillable = [
        'user_id',
        'parent_transaction_id',
        'category_id',
        'label',
        'description',
        'amount',
        'date',
        'system_generated'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var string[]
     */
    protected $casts = [
        'user_id' => 'integer',
        'parent_transaction_id' => 'integer',
        'category_id' => 'integer',
        'label' => 'string',
        'description' => 'string',
        'amount' => 'decimal:2',
        'date' => 'date:Y-m-d',
        'system_generated' => 'boolean',
    ];

    protected static function newFactory(): CategoryFactory
    {
        return CategoryFactory::new();
    }

    /**
     * Validation rules.
     *
     * @var string[]
     */
    public static array $createRules = [
        'parent_transaction_id' => 'nullable|integer',
        'category_id' => 'required|integer',
        'label' => 'required|string|max:20',
        'description' => 'required|string|max:255',
        'amount' => 'required|decimal:2',
        'date' => 'required|date',
        'system_generated' => 'boolean'
    ];

    public static array $updateRules = [
        'category_id' => 'required|integer',
        'label' => 'required|string|max:20',
        'description' => 'required|string|max:255',
        'amount' => 'required|decimal:2',
        'date' => 'required|date',
    ];

    /**---------------------
     * - Relationships:
     * ---------------------**/
    public const relations = ['user', 'category'];

    /**
     * Get the user the transaction belongs to.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the category the transaction belongs to.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
