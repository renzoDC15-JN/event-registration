<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Attendees;
use App\Models\Status;
class CheckIn extends Component
{
    public $digit1 = '';
    public $digit2 = '';
    public $digit3 = '';
    public $digit4 = '';

    public $isOpen = false;
    public $isInvalid = false;
    public $showTable = false;
    public $status =1;
    public $json_path = '';

    public $id='';
    public $name='';
    public $company='';
    public $position='';
    public $email='';
    public $mobile='';

    public function submit()
    {
        $this->validate([
            'digit1' => 'required',
            'digit2' => 'required',
            'digit3' => 'required',
            'digit4' => 'required',
        ]);
        $code = $this->digit1 . $this->digit2 . $this->digit3 . $this->digit4;
        $attendee = Attendees::where('attendee_code',$code)->get()->first();
        if ($attendee) {
//            $this->status = 2; // Example status change
            $this->id = $attendee->id;
            $this->name = $attendee->first_name . ' ' . $attendee->last_name;
            $this->company = $attendee->company_name;
            $this->position = $attendee->job_title;
            $this->email = $attendee->email;
            $this->mobile ='+63'. $attendee->mobile;

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
        $attendee->status_code = Status::where('description','like','Confirmed')->first()->code;
        $attendee->save();
    }

    protected function resetDigits()
    {
        $this->digit1 = '';
        $this->digit2 = '';
        $this->digit3 = '';
        $this->digit4 = '';
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.check-in');
    }
}
