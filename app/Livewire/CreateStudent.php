<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Classes;
use App\Livewire\Forms\CreateStudentForm;


class CreateStudent extends Component
{
    public CreateStudentForm $form;

    #[Validate('required')]
    public $class_id;

    public function addStudent()
    {
        // dd('add student');
        $this->validate();

        $this->form->storeStudent($this->class_id);

        return $this->redirect(route('students.index'));
    }

    public function updatedClassId($value)
    {
        // dd($value);
        $this->form->setSections($value);
    }
    public function render()
    {
        return view('livewire.create-student', [
            'classes' => Classes::all(),
        ]);
    }
}
