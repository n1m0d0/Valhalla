<?php

namespace App\Http\Livewire;

use App\Models\Meeting;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentConsultation extends Component
{
    use WithPagination;
    use WireToast;

    public $search;
    
    public $meeting_id; 

    public $day;

    public $diagnosticModal;

    public function mount()
    {
        $this->day = Carbon::now();
        $this->diagnosticModal = false;
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
        $meetings = $queryMeeting->whereDate('start', $this->day)->where('attended', 1)->whereNull('finalized')->orderBy('id', 'DESC')->paginate(15);
        return view('livewire.component-consultation', compact('meetings'));
    }

    public function modalDiagnostic($id)
    {
        $this->meeting_id = $id;
        $this->diagnosticModal = true;
    }

    public function diagnostic()
    {
        $meeting = Meeting::find($this->meeting_id);

        $meeting->finalized = 1;
        $meeting->save();
     
        $this->diagnosticModal = false;

        toast()
            ->success('Se guardo correctamente')
            ->push();

            redirect()->route('page.diagnostic', $meeting->patient);
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