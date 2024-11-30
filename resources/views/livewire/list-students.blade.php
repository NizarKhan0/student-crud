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

    <div class="relative pt-2 mx-auto mb-2 text-gray-600">
        <input wire:model.live.debounce.1000ms="search" class="h-10 px-5 pr-16 text-sm bg-white border-2 border-gray-300 rounded-lg focus:outline-none"
            type="text" name="search" placeholder="Search">
    </div>

    <table class="min-w-full bg-white border-collapse rounded-lg shadow-md table-auto">
        <thead>
            <tr class="text-gray-700 bg-gray-200">
                <th class="px-4 py-2 border">ID</th>
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
