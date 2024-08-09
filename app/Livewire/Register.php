<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\Status;
use App\Models\Attendees;

class Register extends Component
{
    public $isOpen = false;
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

    public $job_title='';
    #[Validate('email')]
    public $email='';

    public $code='';

    public function submit(){
//        $this->validate();
        if($this->validate()){
            $attendee= Attendees::updateOrCreate(
                [
                    'first_name'=>$this->first_name,
                    'last_name'=>$this->first_name,
                ],[
                'first_name'=>$this->first_name,
                'last_name'=>$this->first_name,
                'company'=>$this->company,
                'job_title'=>$this->job_title,
                'email'=>$this->email,
                'mobile'=>$this->mobile,
            ]);

            $attendee->status_code = Status::where('description','like','Check-in')->first()->code;
            $attendee->generateUniqueCode();
            $this->code = $attendee->attendee_code;
            $attendee->save();
            $this->isOpen=true;

        }
    }


    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.register');
    }
}
