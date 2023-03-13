<?php

namespace App\Http\Livewire;

use App\Models\Treatment;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentTreatment extends Component
{
    use WithPagination;
    use WireToast;

    public $activity;
    public $search;

    public $name;
    public $description;
    public $price;

    public $treatment_id;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'name' => 'required|max:200',
        'description' => 'required|max:1000',
        'price' => 'required|decimal:0,2'
    ];

    public function mount()
    {
        $this->activity = 'create';
        $this->search = "";
        $this->deleteModal = false;
    }

    public function render()
    {
        $queryTreatment = Treatment::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $queryTreatment = $queryTreatment->where('name', 'like', '%' . $this->search . '%');
        }
        $treatments = $queryTreatment->orderBy('id', 'DESC')->paginate(5);
        return view('livewire.component-treatment', compact('treatments'));
    }

    public function store()
    {
        $this->validate();

        $treatment = new Treatment();
        $treatment->name = $this->name;
        $treatment->description = $this->description;
        $treatment->price = $this->price;
        $treatment->save();

        $this->clear();

        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->clear();

        $this->treatment_id = $id;

        $treatment = Treatment::find($id);

        $this->name = $treatment->name;
        $this->description = $treatment->description;
        $this->price = $treatment->price;

        $this->activity = "edit";
    }

    public function update()
    {
        $treatment = Treatment::find($this->treatment_id);

        $this->validate();

        $treatment->name = $this->name;
        $treatment->description = $this->description;
        $treatment->price = $this->price;
        $treatment->save();

        $this->activity = "create";
        $this->clear();

        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->treatment_id = $id;
        $this->deleteModal = true;
    }

    public function delete()
    {
        $treatment = Treatment::find($this->treatment_id);
        $treatment->delete();

        $this->clear();
        $this->deleteModal = false;

        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['name', 'description', 'price', 'treatment_id']);
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
