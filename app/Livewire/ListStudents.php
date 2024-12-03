<?php

namespace App\Livewire;

use App\Models\Student;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use App\Traits\Searchable;
use App\Traits\Sortable;
use Livewire\WithPagination;
use App\Exports\StudentsExport;
use Filament\Notifications\Notification;

#[Lazy]
class ListStudents extends Component
{
    use WithPagination, Searchable, Sortable;

    public array $selectedStudentIds = [], $studentIdsOnPage = [], $allStudentIds = [];

    //ini untuk single delete
    public function deleteStudent(Student $student)
    {
        //Auth check
        $student->delete();
    }

    // ini utnutk bulk delete
    public function deleteStudents()
    {
        $students = Student::find($this->selectedStudentIds);

        foreach ($students as $student) {
            $this->deleteStudent($student);
        }

        // Send notification only if any students were deleted
        if ($this->selectedStudentIds && count($this->selectedStudentIds) === 1) {
            Notification::make()
                ->title('Student Deleted Successfully')
                ->success()
                ->send();
        } else {
            Notification::make()
                ->title('Selected Records Deleted Successfully')
                ->success()
                ->send();
        }
    }

    public function exportExcel()
    {
        return (new StudentsExport($this->selectedStudentIds))->download(now() . '- students.xlsx');
    }

    public function queryString()
    {
        return [
            'sortColumn',
            'sortDirection',
        ];
    }

    public function render()
    {
        sleep(2);
        $query = Student::query();

        $query = $this->applySearch($query);

        $query = $this->applySort($query);

        // ini untuk buat select all
        $this->allStudentIds = $query->pluck('id')->map(fn($id) => (string) $id)->toArray();
        // dd($this->allStudentIds);

        $students = $query->paginate(5);

        $this->studentIdsOnPage = $students->map(fn($student) =>
        (string) $student->id)->toArray();

        // dd($this->studentIdsOnPage);

        return view('livewire.list-students', [
            'students' => $students,
        ]);
    }

    public function placeholder()
    {
        return view('components.table-placeholder');
    }
}
