<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\Status;
use App\Models\Attendees;
use App\Models\Events;
use App\Models\Group;

class Register extends Component
{


    public $isOpen = false;
    public $json_path = '';

    public $id='';

    #[Validate('required|numeric|digits:10')]
    public $mobile = '';
    #[Validate('required')]
    public $full_name = '';
    #[Validate('required')]
    public $selected_group;

    public $event_code;
    public $event_name;

    public $groups;

    public function submit(){
//        $this->validate();

        $exist=Attendees::where('event_code',$this->event_code)->where('mobile',$this->mobile)->first();
        if ($exist) {
            // If the mobile number exists, add a validation error
            $this->addError('mobile', 'This mobile number is already registered for this event.');
            return;
        }

        if($this->validate()){
            $attendee= Attendees::updateOrCreate(
                [
                    'full_name'=>$this->full_name,
                    'group_code'=>$this->selected_group,
                    'event_code'=>$this->event_code,
                ],['mobile'=>$this->mobile,]);

            $attendee->status_code = Status::where('description','like','Check-in')->first()->code;
            $attendee->generateUniqueCode();
            $this->code = $attendee->attendee_code;
            $attendee->save();
            $this->isOpen=true;

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
        return view('livewire.register');
    }
}
