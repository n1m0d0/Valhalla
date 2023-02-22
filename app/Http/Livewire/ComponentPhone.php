<?php

namespace App\Http\Livewire;

use App\Models\Patient;
use App\Models\Phone;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentPhone extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $activity;
    public $iteration;
    public $search;

    public $patient;

    public $number;
    public $phone_id;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8',
    ];

    public function mount(Patient $patient)
    {
        $this->patient = $patient;
        $this->activity = 'create';
        $this->iteration = rand(0, 999);
        $this->search = "";
        $this->deleteModal = false;
    }

    public function render()
    {
        $queryPhone = Phone::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $queryPhone = $queryPhone->where('number', 'like', '%' . $this->search . '%');
        }
        $phones = $queryPhone->where('phoneable_id', $this->patient->id)->orderBy('id', 'DESC')->paginate(2);
        return view('livewire.component-phone', compact('phones'));
    }

    public function store()
    {
        $this->validate();

        $phone = new Phone();
        $phone->number = $this->number;
        $phone->phoneable_id = $this->patient->id;
        $phone->phoneable_type = Patient::class;
        $phone->save();

        $this->clear();

        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->clear();

        $this->phone_id = $id;

        $phone = Phone::find($id);

        $this->number = $phone->number;

        $this->activity = "edit";
    }

    public function update()
    {
        $phone = Phone::find($this->phone_id);

        $this->validate();

        $phone->number = $this->number;
        $phone->save();
        
        $this->activity = "create";
        $this->clear();

        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->phone_id = $id;
        $this->deleteModal = true;
    }

    public function delete()
    {
        $phone = Phone::find($this->phone_id);
        $phone->delete();

        $this->clear();
        $this->deleteModal = false;

        toast()
            ->success('Se elimino correctamente')
            ->push();
    }
    
    public function clear()
    {
        $this->reset(['number', 'phone_id']);
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
