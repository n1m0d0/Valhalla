<?php

namespace App\Http\Livewire;

use App\Models\Meeting;
use App\Models\Patient;
use Livewire\Component;

class ComponentCalendar extends Component
{
    public function render()
    {
        $queryMeeting = Meeting::query();
        $meetings = $queryMeeting->whereNull('attended')->get(); 
        return view('livewire.component-calendar', compact('meetings'));
    }
}
