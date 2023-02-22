<?php

namespace App\Http\Livewire;

use App\Models\Patient;
use Livewire\Component;

class ComponentMenu extends Component
{
    public $patient;

    public function mount(Patient $patient)
    {
        $this->patient = $patient;
    }

    public function render()
    {
        return view('livewire.component-menu');
    }
}
