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

    public $table='';

    //Required if others
    public $group_name;

    public $event_code;
    public $event_name;
    public $event;

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
                    'other_group_name'=>$this->group_name,
                    'event_code'=>$this->event_code,
                    'table_code'=>$this->event->getAvailableTable()
                ],['mobile'=>$this->mobile,]);

            $attendee->status_code = Status::where('description','like','Check-in')->first()->code;
            $this->table=$attendee->table_code;
            // $attendee->generateUniqueCode();
            $attendee->save();
            $this->isOpen=true;

        }
    }

    public function mount($enc_id=null)
    {
        $this->event =Events::findOrFail(Crypt::decrypt($enc_id));
        $this->event_code = $this->event->code;
        $this->event_name = $this->event->description;
        $this->groups = Group::all();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.register');
    }
}
