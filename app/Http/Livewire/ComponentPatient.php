<?php

namespace App\Http\Livewire;

use App\Models\Patient;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentPatient extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $activity;
    public $iteration;
    public $search;

    public $name;
    public $last_name;
    public $identity_card;
    public $issued;
    public $birthdate;
    public $sex;
    public $photo_path;
    public $photo_path_Before;

    public $patient_id;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'name' => 'required|max:200',
        'last_name' => 'required|max:200',
        'identity_card' => 'required|max:200',
        'issued' => 'required',
        'birthdate' => 'required',
        'sex' => 'required',
        'photo_path' => 'required|mimes:jpg,bmp,png,pdf|max:5120'
    ];

    public function mount()
    {
        $this->activity = 'create';
        $this->iteration = rand(0, 999);
        $this->search = "";
        $this->deleteModal = false;
    }

    public function render()
    {
        $queryPatient = Patient::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $queryPatient = $queryPatient->where('name', 'like', '%' . $this->search . '%')->orWhere('last_name', 'like', '%' . $this->search . '%');
        }
        $patients = $queryPatient->orderBy('id', 'DESC')->paginate(2);
        return view('livewire.component-patient', compact('patients'));
    }

    public function store()
    {
        $this->validate();

        $patient = new Patient();
        $patient->name = $this->name;
        $patient->last_name = $this->last_name;
        $patient->identity_card = $this->identity_card;
        $patient->issued = $this->issued;
        $patient->birthdate = $this->birthdate;
        $patient->sex = $this->sex;
        $patient->photo_path = $this->photo_path->store('public');
        $patient->save();

        $this->clear();

        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->clear();

        $this->patient_id = $id;

        $patient = Patient::find($id);

        $this->name = $patient->name;
        $this->last_name = $patient->last_name;
        $this->identity_card = $patient->identity_card;
        $this->issued = $patient->issued;
        $this->birthdate = $patient->birthdate;
        $this->sex = $patient->sex;
        $this->photo_path_Before = $patient->photo_path;

        $this->activity = "edit";
    }

    public function update()
    {
        $patient = Patient::find($this->patient_id);

        if ($this->photo_path != null) {
            $this->validate();

            Storage::delete($patient->photo_path);

            $patient->name = $this->name;
            $patient->last_name = $this->last_name;
            $patient->identity_card = $this->identity_card;
            $patient->issued = $this->issued;
            $patient->birthdate = $this->birthdate;
            $patient->sex = $this->sex;
            $patient->photo_path = $this->photo_path->store('public');
            $patient->save();
        } else {
            $this->validate([
                'name' => 'required|max:200',
                'last_name' => 'required|max:200',
                'identity_card' => 'required|max:200',
                'issued' => 'required',
                'birthdate' => 'required',
                'sex' => 'required',
            ]);

            $patient->name = $this->name;
            $patient->last_name = $this->last_name;
            $patient->identity_card = $this->identity_card;
            $patient->issued = $this->issued;
            $patient->birthdate = $this->birthdate;
            $patient->sex = $this->sex;
            $patient->save();
        }

        $this->activity = "create";
        $this->clear();

        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->patient_id = $id;
        $this->deleteModal = true;
    }

    public function delete()
    {
        $patient = Patient::find($this->patient_id);
        $patient->delete();

        $this->clear();
        $this->deleteModal = false;

        toast()
            ->success('Se elimino correctamente')
            ->push();
    }
    
    public function clear()
    {
        $this->reset(['name', 'last_name', 'identity_card', 'issued', 'birthdate', 'sex', 'photo_path', 'patient_id']);
        $this->iteration++;
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
