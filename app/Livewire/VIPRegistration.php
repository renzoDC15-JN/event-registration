<?php

namespace App\Livewire;


use Illuminate\Support\Facades\Crypt;
use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Attendees;
use App\Models\Events;
use App\Models\Group;
use App\Models\Status;
class VIPRegistration extends Component
{
//    #[Validate('required')]
//    public $first_name = '';
//    #[Validate('required')]
//    public $last_name = '';
    #[Validate('required|numeric|digits:10')]
    public $mobile = '';
    #[Validate('required')]
    public $full_name = '';
    #[Validate('required')]
    public $selected_group;


    public $isOpen = false;
    public $status =0;
    public $json_path = '';

    public $event_code;
    public $event_name;

    public $groups;

    public function close_modal(){
        $this->isOpen = false;
    }

    public function submit(){

        $this->validate();
       $attendee= Attendees::where('full_name',$this->full_name)
           ->where('group_code',$this->selected_group)
           ->where('mobile',$this->mobile)
           ->get()->first();
        if($attendee){
            $this->isOpen=true;
            $this->status=1;
            $this->json_path = asset('lottie_files/success.json');
            $this->dispatch('trigger_animation');
            $attendee->status_code = Status::where('description','like','Pre-listed')->first()->code;
//            $attendee->generateUniqueCode();
//            $attendee->notify(new SmsCodeNotification($attendee));

        }else{
            $this->isOpen=true;
            $this->status=0;
            $this->json_path = asset('lottie_files/no_data.json');
            $this->dispatch('trigger_animation');
        }
    }

    public function mount($enc_id=null)
    {
        $event = Events::findOrFail(Crypt::decrypt($enc_id));
        $this->event_code = $event->code;
        $this->event_name = $event->description;
        $this->groups = Group::all();
    }


    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.v-i-p-registration');
    }
}
