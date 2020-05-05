<?php

namespace App\Http\Livewire\Auth;

use App\User;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $state = 'unverified';

    //states
//  unverified
//  passwordless - verified needs passwordless login
//  password - verified needs password login

    public function mount($email)
    {
        $this->email=$email;
    }

    public function render()
    {
        if($this->email) {

            if(filter_var($this->email, FILTER_VALIDATE_EMAIL) !== false) {

                $user = User::where('email',$this->email)->first();

                if($user) {

                    if($user->passwordless == true) {
                        $this->state='passwordless';
                    } else {
                        $this->state='password';
                    }

                } else {
                    $this->state='unverified';
                }
            }
        }

        return view('livewire.auth.login');
    }
}
