<?php

namespace App\Http\Livewire;

use App\Models\Meeting;
use App\Models\Patient;
use App\Models\User;
use Livewire\Component;

class ComponentDashboard extends Component
{
    public $users;
    public $patients;
    public $meetings;

    public function mount()
    {
        $this->users = User::all();
        $this->patients = Patient::all();
        $this->meetings = Meeting::all();
    }

    public function render()
    {
        return view('livewire.component-dashboard');
    }
}
