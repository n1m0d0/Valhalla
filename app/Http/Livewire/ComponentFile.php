<?php

namespace App\Http\Livewire;

use App\Models\Diagnostic;
use App\Models\Patient;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ComponentFile extends Component
{
    use WithPagination;

    public $search;

    public $patient;
    public $age;

    public function mount(Patient $patient)
    {
        $this->patient = $patient;
        $this->search = "";
        $this->age = Carbon::createFromDate($patient->birthdate)->age;
    }

    public function render()
    {
        $queryDiagnostic = Diagnostic::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $queryDiagnostic = $queryDiagnostic->whereDate('created_at', $this->search);
        }
        $diagnostics = $queryDiagnostic->where('patient_id', $this->patient->id)->orderBy('id', 'DESC')->paginate(7);
        return view('livewire.component-file', compact('diagnostics'));
    }

    public function resetSearch()
    {
        $this->reset(['search']);
        $this->updatingSearch();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
