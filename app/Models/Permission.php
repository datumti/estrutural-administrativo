<?php
namespace App\Models;

use App\Models\Person;
use Illuminate\Database\Eloquent\Model;
class Permission extends Model{
    protected $table = 'permission';
    protected $fillable = ['local_access'];
}