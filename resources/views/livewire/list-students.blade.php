<div class="w-full p-6 mx-auto mb-8">
    <div class="flex justify-between my-4">
        <h2 class="mb-4 text-2xl font-semibold text-gray-800">Student List</h2>
        <a wire:navigate href="{{ route('students.create') }}"
            class="p-2 text-white bg-blue-800 rounded-lg hover:bg-blue-600">Add Student</a>
    </div>

    <div wire:loading class="absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
        <div class="inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-current border-e-transparent align-[-0.125em] text-primary motion-reduce:animate-[spin_1.5s_linear_infinite]"
            role="status">
            <span
                class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span>
        </div>
    </div>

    <div class="relative flex justify-between pt-2 mx-auto mb-2 text-gray-600">
        <input wire:model.live.debounce.800ms="search"
            class="h-10 px-5 pr-16 text-sm bg-white border-2 border-gray-300 rounded-lg focus:outline-none" type="text"
            name="search" placeholder="Search">
        <div x-show="$wire.selectedStudentIds.length > 0" class="flex items-center">
            <div class="flex items-center gap-2 p-2"><span x-text="$wire.selectedStudentIds.length"></span>
                <span>selected</span>|
            </div>
            <form wire:submit="deleteStudents" wire:confirm="Are you sure you want to delete these records?"> <button
                    type="submit"
                    class="inline-flex items-center px-3 py-2 mr-2 text-sm font-medium leading-4 text-white bg-red-600 rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <i class="mr-2 fas fa-trash"></i> Delete
                </button>
            </form>
            <form wire:submit="exportExcel">
                <button type="submit"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-white bg-green-600 rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <i class="mr-2 fas fa-download"></i> Export Excel
                </button>
            </form>
        </div>
    </div>

    {{-- {{ var_dump($selectedStudentIds) }} --}}
    <table class="min-w-full text-center bg-white border-collapse rounded-lg shadow-md table-auto">
        <thead>
            <tr class="text-gray-700 bg-gray-200">
                <th class="px-4 py-2 border">
                   <x-check-all />
                </th>
                <th class="px-4 py-2 border">
                    <button wire:click="sortBy('id')">ID
                        <span class="ml-2 sort-icon">
                            @if ($sortColumn === 'id')
                            @if ($sortDirection === 'asc')
                            <i class="fas fa-sort-up"></i>
                            @else
                            <i class="fas fa-sort-down"></i>
                            @endif
                            @else
                            <i class="fas fa-sort-down"></i>
                            <i class="fas fa-sort-up"></i>
                            @endif
                        </span>
                    </button>
                </th>
                <th class="px-4 py-2 border">
                    <button wire:click="sortBy('name')">Name
                        <span class="ml-2 sort-icon">
                            @if ($sortColumn === 'name')
                            @if ($sortDirection === 'asc')
                            <i class="fas fa-sort-up"></i>
                            @else
                            <i class="fas fa-sort-down"></i>
                            @endif
                            @else
                            <i class="fas fa-sort-down"></i>
                            <i class="fas fa-sort-up"></i>
                            @endif
                        </span>
                    </button>
                </th>
                <th class="px-4 py-2 border">Email</th>
                <th class="px-4 py-2 border">Class</th>
                <th class="px-4 py-2 border">Section</th>
                <th class="px-4 py-2 border">Created At</th>
                <th class="px-4 py-2 border">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
            <tr wire:key="{{ $student->id }}" class="odd:bg-gray-50">
                <td class="px-4 py-2 border">
                    <input wire:model="selectedStudentIds" type="checkbox" value="{{ $student->id }}">
                </td>
                <td class="px-4 py-2 border">{{ $student->id }}</td>
                <td class="px-4 py-2 border">{{ $student->name }}</td>
                <td class="px-4 py-2 border">{{ $student->email }}</td>
                <td class="px-4 py-2 border">{{ $student->class->name }}</td>
                <td class="px-4 py-2 border">{{ $student->section->name }}</td>
                <td class="px-4 py-2 border">{{ $student->created_at }}</td>
                <td class="px-4 py-2 border">
                    <a href="{{ route('students.edit', $student->id) }}" class="text-blue-500 hover:underline">Edit</a>
                    <span>|</span>
                    <button wire:confirm wire:click="deleteStudent({{ $student->id }})"
                        class="text-red-500 hover:underline">
                        Delete
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="my-4">
        {{ $students->links() }}
    </div>

</div>
