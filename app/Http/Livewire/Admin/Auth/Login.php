<?php

namespace App\Http\Livewire\Admin\Auth;

use Livewire\Component;

use Auth;
use App\Models\User;

use App\Http\Livewire\Admin\Auth\LoginLog\Log;

class Login extends Component
{
    public $email, $password;

    protected $rules = [
        'email'     => 'required|max:100',
        'password'  => 'required|max:100',
    ];

    public function login(){

        //Validation
        $this->validate();

        //dd($this->login, $this->password);

        $data = User::where('email', $this->email)
                        ->Where('password', $this->password)
                        ->first();


        if($data){

            //dd($data);

            //Login By Auth
            Auth::login($data);

            //Login Log
            $LoginLog = new Log();
            $LoginLog->userLoginLog($this->email, '1');

            return redirect()->route('admin.index');

        }else{
            session()->flash('message', 'You have entered invalid credentials');
        }

        
    }

    public function render()
    {
        return view('livewire.admin.auth.login');
    }
}
