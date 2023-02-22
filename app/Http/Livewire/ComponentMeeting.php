<?php

namespace App\Http\Livewire;

use App\Models\Meeting;
use App\Models\Patient;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentMeeting extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $activity;
    public $iteration;
    public $search;

    public $patient;

    public $title;
    public $start;
    public $end;

    public $meeting_id;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'title' => 'required|max:200',
        'start' => 'required|date',
        'end' => 'nullable|max:200',
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
        $queryMeeting = Meeting::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $queryMeeting = $queryMeeting->where('title', 'like', '%' . $this->search . '%');
        }
        $meetings = $queryMeeting->where('patient_id', $this->patient->id)->whereNull('attended')->orderBy('id', 'DESC')->paginate(2);
        return view('livewire.component-meeting', compact('meetings'));
    }

    public function store()
    {
        $this->validate();

        $meeting = new meeting();
        $meeting->patient_id = $this->patient->id;
        $meeting->title = $this->title;
        $meeting->start = $this->start;
        $meeting->end = $this->end;
        $meeting->save();

        $this->clear();

        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->clear();

        $this->meeting_id = $id;

        $meeting = Meeting::find($id);

        $this->title = $meeting->title;
        $this->start = $meeting->start;
        $this->end = $meeting->end;

        $this->activity = "edit";
    }

    public function update()
    {
        $meeting = Meeting::find($this->meeting_id);

        $this->validate();

        $meeting->title = $this->title;
        $meeting->start = $this->start;
        $meeting->end = $this->end;
        $meeting->save();

        $this->activity = "create";
        $this->clear();

        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->meeting_id = $id;
        $this->deleteModal = true;
    }

    public function delete()
    {
        $meeting = Meeting::find($this->meeting_id);
        $meeting->delete();

        $this->clear();
        $this->deleteModal = false;

        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['title', 'start', 'end', 'meeting_id']);
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
