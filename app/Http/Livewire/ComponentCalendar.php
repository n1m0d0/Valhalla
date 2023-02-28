<?php

namespace App\Http\Livewire;

use App\Models\Meeting;
use App\Models\Patient;
use Livewire\Component;

class ComponentCalendar extends Component
{
    public $patients;
    public $events;

    public $patient_id;

    public function mount()
    {
        $this->patients = Patient::all();
    }

    public function render()
    {
        $queryMeeting = Meeting::query();
        $meetings = $queryMeeting->whereNull('attended')->get(); 
        $this->events = json_encode($meetings);
        return view('livewire.component-calendar', compact('meetings'));
    }
}
