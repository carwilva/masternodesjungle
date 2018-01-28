<?php

namespace App\Model;

use DB;
use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    protected $table = 'users';
    protected $fillable = [
        'id', 'name', 'email','created_at', 'update_at'
    ];
    public $timestamps = false;
    
    static function getUserList()
    {
        $return = Static::get();

        return $return;
    }

    public static function update_user($id, $name, $email, $pass)
    {
        return Static::where('id', $id) -> update(['name' => $name,'email' => $email, 'password' => $pass]);
    }

    public static function delete_user($id)
    {
        return Static::where('id', $id)->delete();
    }
}