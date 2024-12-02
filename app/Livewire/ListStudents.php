<?php

namespace App\Livewire;

use App\Models\Student;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Exports\StudentsExport;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection\pluck;

class ListStudents extends Component
{
    use WithPagination;

    public string $search = '';
    #[Url]
    public string $sortColumn = 'created_at', $sortDirection = 'desc';

    public array $selectedStudentIds = [], $studentIdsOnPage = [];

    public function render()
    {
        $query = Student::query();

        $query = $this->applySearch($query);

        $query = $this->applySort($query);

        $students = $query->paginate(10);

        $this->studentIdsOnPage = $students->map(fn ($student) =>
          (string) $student->id)->toArray();

        // dd($this->studentIdsOnPage);

        return view('livewire.list-students', [
            'students' => $students ,
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
        if($this->selectedStudentIds && count($this->selectedStudentIds) === 1)
        {
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
}
