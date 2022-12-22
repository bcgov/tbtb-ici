<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name'];

    public const SUPER_ADMIN = 'Super Admin';

    public const ICI_USER = 'ICI User';

    public const ICI_ADMIN = 'ICI Admin';

    public const TWP_ADMIN = 'TWP Admin';

    public const TWP_USER = 'TWP User';

    /**
     * The roles that belong to the user.
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'role_user');
    }
}
