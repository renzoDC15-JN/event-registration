<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Attendees;
class CheckIn extends Component
{
    public $digit1 = '';
    public $digit2 = '';
    public $digit3 = '';
    public $digit4 = '';

    public $isOpen = true;
    public $status =1;

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
            $this->status = 2; // Example status change
            $this->isOpen = true; // Open the modal
        } else {
            $this->status = 0; // Handle invalid code
        }

//        $this->resetDigits();
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
