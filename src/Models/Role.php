<?php

namespace Aweram\UserManagement\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    // TODO: add observer on delete
    use HasFactory;

    protected $fillable = [
        "name",
        "title",
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
