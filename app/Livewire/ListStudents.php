<?php

namespace App\Livewire;

use App\Models\Student;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Exports\StudentsExport;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;

class ListStudents extends Component
{
    use WithPagination;

    public string $search = '';
    #[Url]
    public string $sortColumn = 'created_at', $sortDirection = 'desc';

    public array $selectedStudentIds = [];

    public function render()
    {
        $query = Student::query();

        $query = $this->applySearch($query);

        $query = $this->applySort($query);

        return view('livewire.list-students', [
            'students' => $query->paginate(10),
        ]);
    }

    protected function applySort(Builder $query): Builder
    {
        return $query->orderBy($this->sortColumn, $this->sortDirection);
    }

    public function sortBy(String $column)
    {
        if ($this->sortColumn === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
            $this->sortColumn = $column;
        }
    }

    public function applySearch(Builder $query): Builder
    {
        return $query->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orWhereHas('class', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });
    }

    public function deleteStudent(Student $student)
    {
        //Auth check
        $student->delete();

        Notification::make()
        ->title('Student Deleted Successfully')
        ->success()
        ->send();
    }

    public function deleteStudents()
    {
        $students = Student::find($this->selectedStudentIds);

        foreach ($students as $student) {
            $this->deleteStudent($student);
        }

        Notification::make()
        ->title('Selected Records Deleted Successfully')
        ->success()
        ->send();
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
}
