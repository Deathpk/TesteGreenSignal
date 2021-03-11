<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class userModel extends Model
{
    protected $table = 'users';
    public $timestamps = false;
    
    public static function getUserInfo()
    {
        return userModel::where('cpf', Auth::user()->cpf )->first( ['name','email','telephone'] );
    }

    public static function getAllUsers()
    {
        return userModel::where('cpf','!=', Auth::user()->cpf)->get(['name','email']);

    }

    public static function updateUserInfo(Array $data)
    {   
        foreach($data as $key => $value){
            userModel::where('cpf', Auth::user()->cpf )->update([
                $key => $value
            ]);
        }
    }

    public static function getUserNameFromCpf($cpf)
    {
        return userModel::where('cpf', $cpf)->first('name');
    }

   

}
