<?php

namespace App\Http\Livewire;

use App\Models\Question;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentQuestion extends Component
{
    use WithPagination;
    use WireToast;

    public $activity;
    public $search;

    public $description;

    public $question_id;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'description' => 'required|max:1000'
    ];

    public function mount()
    {
        $this->activity = 'create';
        $this->search = "";
        $this->deleteModal = false;
    }

    public function render()
    {
        $queryQuestion = Question::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $queryQuestion = $queryQuestion->where('description', 'like', '%' . $this->search . '%');
        }
        $questions = $queryQuestion->orderBy('id', 'DESC')->paginate(5);
        return view('livewire.component-question', compact('questions'));
    }

    public function store()
    {
        $this->validate();

        $question = new Question();
        $question->description = $this->description;
        $question->save();

        $this->clear();

        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->clear();

        $this->question_id = $id;

        $question = Question::find($id);

        $this->description = $question->description;

        $this->activity = "edit";
    }

    public function update()
    {
        $question = Question::find($this->question_id);

        $this->validate();

        $question->description = $this->description;
        $question->save();

        $this->activity = "create";
        $this->clear();

        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->question_id = $id;
        $this->deleteModal = true;
    }

    public function delete()
    {
        $question = Question::find($this->question_id);
        $question->delete();

        $this->clear();
        $this->deleteModal = false;

        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['description', 'question_id']);
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
