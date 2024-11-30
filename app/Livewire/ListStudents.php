<?php

namespace App\Livewire;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Student;

class ListStudents extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.list-students', [
            'students' => Student::paginate(15),
        ]);
    }

    public function deleteStudent($studentId)
    {
        Student::find($studentId)->delete();
    }
}
