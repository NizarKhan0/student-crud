<div class="mx-auto mt-8 mb-8 w-fit">
    <div class="flex justify-between my-4">
        <h2 class="mb-4 text-2xl font-semibold text-gray-800">Student List</h2>
        <a wire:navigate href="{{ route('students.create') }}" class="p-2 text-white bg-blue-800 rounded-lg hover:bg-blue-600">Add
            Student</a>
    </div>

    <table class="min-w-full bg-white border-collapse rounded-lg shadow-md table-auto">
        <thead>
            <tr class="text-gray-700 bg-gray-200">
                <th class="px-4 py-2 border">SL</th>
                <th class="px-4 py-2 border">Name</th>
                <th class="px-4 py-2 border">Email</th>
                <th class="px-4 py-2 border">Class</th>
                <th class="px-4 py-2 border">Section</th>
                <th class="px-4 py-2 border">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr class="odd:bg-gray-50">
                    <td class="px-4 py-2 border">{{ $student->id }}</td>
                    <td class="px-4 py-2 border">{{ $student->name }}</td>
                    <td class="px-4 py-2 border">{{ $student->email }}</td>
                    <td class="px-4 py-2 border">{{ $student->class->name }}</td>
                    <td class="px-4 py-2 border">{{ $student->section->name }}</td>
                    <td class="px-4 py-2 border">
                        <a href="{{ route('students.edit', $student->id) }}"
                            class="text-blue-500 hover:underline">Edit</a>
                            <span>|</span>
                        <button wire:confirm wire:click="deleteStudent({{ $student->id }})" class="text-red-500 hover:underline">
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
