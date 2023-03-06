<?php

namespace App\Http\Livewire;

use App\Models\Patient;
use Carbon\Carbon;
use Livewire\Component;

class ComponentFile extends Component
{
    public $patient;
    public $age;

    public function mount(Patient $patient)
    {
        $this->patient = $patient;
        $this->age = Carbon::createFromDate($patient->birthdate)->age;
    }

    public function render()
    {
        return view('livewire.component-file');
    }
}
