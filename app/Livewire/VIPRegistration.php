<?php

namespace App\Livewire;


use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Attendees;
use App\Notifications\SmsCodeNotification;
class VIPRegistration extends Component
{
    #[Validate('required')]
    public $first_name = '';
    #[Validate('required')]
    public $last_name = '';
    #[Validate('required|numeric|digits:10')]
    public $mobile = '';

    public $isOpen = false;
    public $status =0;
    public $json_path = '';

    public function close_modal(){
        $this->isOpen = false;
    }

    public function submit(){
        $this->validate();
       $attendee= Attendees::where('first_name',$this->first_name)
           ->where('last_name',$this->last_name)
           ->where('mobile',$this->mobile)
           ->get()->first();
        if($attendee){
            $this->isOpen=true;
            $this->status=1;
            $this->json_path = asset('lottie_files/success.json');
            $this->dispatch('trigger_animation');
            $attendee->notify(new SmsCodeNotification("Welcome to Raemulan Lands Inc! Join us for {$attendee->title} on August 9, 2024 in {$attendee->place}. Your check-in pass code is: {$attendee->attendee_code}. Excited to meet and host you at the event!"));

        }else{
            $this->isOpen=true;
            $this->status=0;
            $this->json_path = asset('lottie_files/no_data.json');
            $this->dispatch('trigger_animation');
        }
    }


    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.v-i-p-registration');
    }
}
