<?php

namespace App\Livewire;

use App\Models\Classes;
use App\Models\Student;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Filament\Notifications\Notification;
use App\Livewire\Forms\UpdateStudentForm;

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
            'class_id' => 'required|exists:classes,id',
            'email' => 'required|email|unique:students,email,' . $this->student->id,
        ]);

        // dd('add student');
        $this->form->updateStudent($this->class_id, $this->email);

        Notification::make()
        ->title('Student Update Successfully')
        ->info()
        ->color('info')
        ->send();
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
