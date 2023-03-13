<?php

namespace App\Http\Livewire;

use App\Models\Diagnostic;
use App\Models\Patient;
use App\Models\Tooth;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentDiagnostic extends Component
{
    use WithPagination;
    use WireToast;

    public $activity;
    public $search;

    public $patient;

    public $tooth_id;
    public $description;
    public $diagnostic_id;

    public $teeth;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'tooth_id' => 'required',
        'description' => 'required|max:1000',
    ];

    public function mount(Patient $patient)
    {
        $this->patient = $patient;
        $this->activity = 'create';
        $this->search = "";
        $this->teeth = Tooth::all();
        $this->deleteModal = false;
    }

    public function render()
    {
        $queryDiagnostic = Diagnostic::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $queryDiagnostic = $queryDiagnostic->whereHas('tooth', function (Builder $query) {
                $query->where('number', 'like', '%' . $this->search . '%');
            });
        }
        $diagnostics = $queryDiagnostic->where('patient_id', $this->patient->id)->orderBy('id', 'DESC')->paginate(2);
        return view('livewire.component-diagnostic', compact('diagnostics'));
    }

    public function store()
    {
        $this->validate();

        $diagnostic = new Diagnostic();
        $diagnostic->patient_id = $this->patient->id;
        $diagnostic->tooth_id = $this->tooth_id;
        $diagnostic->description = $this->description;
        $diagnostic->save();

        $this->clear();

        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->clear();

        $this->diagnostic_id = $id;

        $diagnostic = Diagnostic::find($id);

        $this->tooth_id = $diagnostic->tooth_id;
        $this->description = $diagnostic->description;

        $this->activity = "edit";
    }

    public function update()
    {
        $diagnostic = Diagnostic::find($this->diagnostic_id);

        $this->validate();

        $diagnostic->tooth_id = $this->tooth_id;
        $diagnostic->description = $this->description;
        $diagnostic->save();

        $this->activity = "create";
        $this->clear();

        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->diagnostic_id = $id;
        $this->deleteModal = true;
    }

    public function delete()
    {
        $diagnostic = Diagnostic::find($this->diagnostic_id);
        $diagnostic->delete();

        $this->clear();
        $this->deleteModal = false;

        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['tooth_id', 'description', 'diagnostic_id']);
        $this->activity = "create";
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
