<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Student;
use App\Models\Section;

class UpdateStudentForm extends Form
{

    public ?Student $student;
    #[Validate('required')]
    public $name;
    #[Validate('required')]
    public $section_id;
    public $sections = [];

    public function setStudent(Student $student)
    {
        $this->student = $student;

        // ini dari route model binding guna fill method boleh pilih mana yang nak isi
        $this->fill($student->only([
            'name',
            'section_id',
        ]));

        //section ni dia akan follow dari class id punya foreign key student
        $this->sections = Section::where('class_id', $student->class_id)->get();
    }
    public function updateStudent($class_id, $email)
    {
        $this->validate([
            'section_id' => 'required|exists:sections,id',
        ]);

        // dd($this->student);
        $this->student->update([
            'name' => $this->name,
            'email' => $email,
            'class_id' => $class_id,
            'section_id' => $this->section_id,
        ]);

    }

    public function setSections($class_id)
    {
        //ini declare dari array kosong, kalau ambil full dia jadi looping ini untuk dynamic dpeendent
        $this->sections = Section::where('class_id', $class_id)->get();
    }
}
