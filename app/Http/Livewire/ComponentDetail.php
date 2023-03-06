<?php

namespace App\Http\Livewire;

use App\Models\Detail;
use App\Models\Patient;
use App\Models\Question;
use App\Models\Record;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentDetail extends Component
{
    use WithPagination;
    use WireToast;

    public $activity;
    public $search;

    public $patient;
    public $questions;

    public $record;

    public $question_id;
    public $description;
    public $detail_id;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'question_id' => 'required',
        'description' => 'nullable|max:1000'
    ];

    public function mount(Patient $patient)
    {
        $this->patient = $patient;
        $this->questions = Question::all();
        $this->record = Patient::find($this->patient->id)->record;
        if ($this->record == null || $this->record->count() == 0) {
            $this->record = new Record();
            $this->record->patient_id = $this->patient->id;
            $this->record->save();
        }
        $this->activity = 'create';
        $this->search = "";
        $this->deleteModal = false;
    }

    public function render()
    {
        $queryDetail = Detail::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $queryDetail = $queryDetail->where('description', 'like', '%' . $this->search . '%');
        }

        $details = $queryDetail->where('record_id', $this->record->id)->orderBy('id', 'DESC')->paginate(2);
        return view('livewire.component-detail', compact('details'));
    }

    public function store()
    {
        $this->validate();

        $detail = new Detail();

        $detail->record_id = $this->record->id;
        $detail->question_id = $this->question_id;
        $detail->description = $this->description;
        $detail->save();

        $this->clear();

        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->clear();

        $this->detail_id = $id;

        $detail = Detail::find($id);

        $this->question_id = $detail->question_id;
        $this->description = $detail->description;

        $this->activity = "edit";
    }

    public function update()
    {
        $detail = Detail::find($this->detail_id);

        $this->validate();

        $detail->question_id = $this->question_id;
        $detail->description = $this->description;
        $detail->save();

        $this->activity = "create";
        $this->clear();

        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->detail_id = $id;
        $this->deleteModal = true;
    }

    public function delete()
    {
        $detail = Detail::find($this->detail_id);
        $detail->delete();

        $this->clear();
        $this->deleteModal = false;

        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['question_id', 'description', 'detail_id']);
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
