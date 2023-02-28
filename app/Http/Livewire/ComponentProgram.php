<?php

namespace App\Http\Livewire;

use App\Models\Meeting;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentProgram extends Component
{
    use WithPagination;
    use WireToast;

    public $search;

    public $attended;
    public $meeting_id; 

    public $day;

    public $attendedModal;

    public function mount()
    {
        $this->day = Carbon::now();
        $this->attendedModal = false;
    }

    public function render()
    {
        $queryMeeting = Meeting::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $queryMeeting = $queryMeeting->whereHas('patient', function(Builder $query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });
        }
        $meetings = $queryMeeting->whereDate('start', $this->day)->whereNull('attended')->orderBy('id', 'DESC')->paginate(15);
        return view('livewire.component-program', compact('meetings'));
    }

    public function modalAttended($id)
    {
        $this->meeting_id = $id;
        $this->attendedModal = true;
    }

    public function updateAttendance()
    {
        $meeting = Meeting::find($this->meeting_id);

        $this->validate([
            'attended' => 'required',
        ]);

        $meeting->attended = $this->attended;
        $meeting->save();

        $this->attendedModal = false;

        $this->clear();

        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['attended', 'meeting_id']);
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
