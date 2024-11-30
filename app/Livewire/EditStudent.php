<?php

namespace App\Livewire;

use App\Livewire\Forms\UpdateStudentForm;
use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Classes;
use App\Models\Student;

class EditStudent extends Component
{
    //route model binding kat livewire mancam ini
    public Student $student;

    public UpdateStudentForm $form;

    public $class_id;

    public $email;

    public function mount()
    {
        $this->form->setStudent($this->student);

        $this->fill($this->student->only([
            'class_id',
            'email',
        ]));
    }


    public function updateStudent()
    {
        $this->validate([
            'email' => 'required|email|unique:students,email,' . $this->student->id,
            'class_id' => 'required',
        ]);

        // dd('add student');
        $this->form->updateStudent($this->class_id, $this->email);

        // dd($student);
        return $this->redirect(route('students.index'));
    }

    public function updatedClassId($value)
    {
        // dd($value);
        $this->form->setSections($value);
    }

    public function render()
    {
        return view('livewire.edit-student', [
            'classes' => Classes::all(),
        ]);
    }
}
