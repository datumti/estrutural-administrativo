<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Person;

class PermissionProfile extends Model{
    
    protected $table = 'permission_profile';
    protected $fillable = ['id_permission', 'id_profile'];

    public function permission()
    {
        return $this->hasOne('App\Models\Permission');
    }
    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }
}