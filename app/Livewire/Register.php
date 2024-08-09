<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;

class Register extends Component
{
    public $isOpen = false;
    public $isInvalid = false;
    public $showTable = false;
    public $status =1;
    public $json_path = '';

    public $id='';

    #[Validate('required')]
    public $first_name = '';
    #[Validate('required')]
    public $last_name = '';
    #[Validate('required')]
    public $company='';
    #[Validate('numeric|digits:10')]
    public $mobile = '';
    public $position='';
    public $email='';

    public function submit(){
        $this->validate();

    }


    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.register');
    }
}
