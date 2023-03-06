<?php

namespace App\Http\Livewire;

use App\Models\Address;
use App\Models\Patient;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentAddress extends Component
{
    use WithPagination;
    use WireToast;

    public $activity;
    public $search;

    public $patient;

    public $ubication;
    public $address_id;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'ubication' => 'required|max:200',
    ];

    public function mount(Patient $patient)
    {
        $this->patient = $patient;
        $this->activity = 'create';
        $this->search = "";
        $this->deleteModal = false;
    }
    
    public function render()
    {
        $queryAddress = Address::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $queryAddress = $queryAddress->where('ubication', 'like', '%' . $this->search . '%');
        }
        $addresses = $queryAddress->where('addressable_id', $this->patient->id)->orderBy('id', 'DESC')->paginate(2);
        return view('livewire.component-address', compact('addresses'));
    }

    public function store()
    {
        $this->validate();

        $address = new Address();
        $address->ubication = $this->ubication;
        $address->addressable_id = $this->patient->id;
        $address->addressable_type = Patient::class;
        $address->save();

        $this->clear();

        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->clear();

        $this->address_id = $id;

        $address = Address::find($id);

        $this->ubication = $address->ubication;

        $this->activity = "edit";
    }

    public function update()
    {
        $address = Address::find($this->address_id);

        $this->validate();

        $address->ubication = $this->ubication;
        $address->save();
        
        $this->activity = "create";
        $this->clear();

        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->address_id = $id;
        $this->deleteModal = true;
    }

    public function delete()
    {
        $address = Address::find($this->address_id);
        $address->delete();

        $this->clear();
        $this->deleteModal = false;

        toast()
            ->success('Se elimino correctamente')
            ->push();
    }
    
    public function clear()
    {
        $this->reset(['ubication', 'address_id']);
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
