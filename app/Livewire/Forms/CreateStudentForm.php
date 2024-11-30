<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Student;
use App\Models\Section;

class CreateStudentForm extends Form
{
    // default dia null/bole gak '' string empty
    #[Validate('required')]
    public $name;

    #[Validate('required|email|unique:students,email')]
    public $email;

    #[Validate('required')]
    public $section_id;
    //untuk kosongkan array function updated classid
    public $sections = [];

    public function storeStudent($class_id)
    {
        Student::create([
            'name' => $this->name,
            'email' => $this->email,
            'class_id' => $class_id,
            'section_id' => $this->section_id,
        ]);
    }

    public function setSections($class_id)
    {
        //ini declare dari array kosong, kalau ambil full dia jadi looping
        $this->sections = Section::where('class_id', $class_id)->get();
    }
}
