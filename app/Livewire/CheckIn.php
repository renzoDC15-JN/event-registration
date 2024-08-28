<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\Attendees;
use App\Models\Status;
use App\Models\Events;
use App\Models\Group;
class CheckIn extends Component
{
//    public $digit1 = '';
//    public $digit2 = '';
//    public $digit3 = '';
//    public $digit4 = '';
    #[Validate('required|numeric|digits:10')]
    public $attendee_mobile='';

    public $isOpen = false;
    public $isInvalid = false;
    public $showTable = false;
    public $status =1;
    public $json_path = '';

    public $id='';
//    public $name='';
//    public $company='';
//    public $position='';
//    public $email='';
    public $mobile='';
    public $full_name='';
    public $table='';
    public $enc_id;

    public $event_code;
    public $event_name;



    public function submit()
    {

        $this->validate();
        $attendee = Attendees::where('mobile',$this->attendee_mobile)
            ->where('event_code',$this->event_code)->get()->first();
        if ($attendee) {
//            $this->status = 2; // Example status change
            $this->id = $attendee->id;
//            $this->name = $attendee->first_name . ' ' . $attendee->last_name;
//            $this->company = $attendee->company_name;
//            $this->position = $attendee->job_title;
//            $this->email = $attendee->email;
            $this->full_name = $attendee->full_name;
            $this->mobile ='+63'. $attendee->mobile;
            $this->table = $attendee->table_code;


            $this->isOpen = true; // Open the modal
        } else {
            $this->json_path = asset('lottie_files/invalid.json');
            $this->dispatch('trigger_animation');
            $this->isInvalid=true;
            $this->status = 0; // Handle invalid code
        }

//        $this->resetDigits();
    }

    public function confirm(){
        $this->isOpen=false;

        $attendee = Attendees::find($this->id);
        $attendee->status_code = Status::where('description','like','Check-in')->first()->code;
        $attendee->save();
        $this->json_path = asset('lottie_files/success.json');
        $this->dispatch('trigger_animation');
        $this->isInvalid=true;
        $this->status = 1; // Handle invalid code
    }

//    protected function resetDigits()
//    {
//        $this->digit1 = '';
//        $this->digit2 = '';
//        $this->digit3 = '';
//        $this->digit4 = '';
//    }

    public function mount($enc_id=null)
    {
        $this->enc_id = $enc_id;
        $event = Events::findOrFail(Crypt::decrypt($enc_id));
        $this->event_code = $event->code;
        $this->event_name = $event->description;
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.check-in');
    }
}
