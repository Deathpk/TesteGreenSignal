<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\userModel;
use App\Http\Requests\updateUserRequest;
use Auth;
use Hash;
use Exception;

class userController extends Controller
{
    
    public function showUserUpdateForm()
    {
        $userInfo = userModel::getUserInfo();
        return view('updateUserForm', ['user'=>$userInfo] );
    }

    public function updateUserInfo(updateUserRequest $request)
    {
        if ( $this->isEmailCorrect($request->email,$request->newEmail) && $this->isPasswordCorrect($request->password) ){
            try{
                $updateUserInfo = userModel::updateUserInfo([
                    'name' => $request->name,
                    'telephone' => $request->telephone,
                    'email' => $request->newEmail,
                    'password' => Hash::make($request->newPassword)
                ]);
            } catch(Exception $e){
                $this->flashError('Oops.. houve uma falha inesperada! , '.$e->getMessage() );
                return redirect('dashboard/main');
            }

            $this->flashSuccess('Dados atualizados com sucesso!');
            return redirect('dashboard/main');
        }
        
        if( !$this->isNewEmailReallyNew($request->newEmail) ){
            $this->flashError('Novo e-mail já existente, insira um novo e-mail que não exista.');
            return redirect('dashboard/update/userinfo');
        }

        $this->flashError('Falha ao atualizar dados , cheque os campos e tente novamente.');
        return redirect('dashboard/main');
    }

    
    public function isEmailCorrect($email,$newEmail)
    {
        $currentEmail = userModel::where('cpf', Auth::user()->cpf)->first('email');
        if($currentEmail->email == $email && $this->isNewEmailReallyNew($newEmail) ){
            return true;
        }
        return false;
    }

    public function isNewEmailReallyNew($newEmail)
    {
        $allEmails = userModel::all('email');
        foreach($allEmails as $usedEmail){
            if($usedEmail->email == $newEmail){
                return false;
            }
        }
        return true;
    }

    public  function isPasswordCorrect($password)
    {
        return Hash::check($password, Auth::user()->password );
    }

}
