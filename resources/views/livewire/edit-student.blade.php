<div class="mx-auto mt-8 mb-8 w-fit">
    <h2 class="p-4 my-2 text-3xl font-extrabold text-center">
        Edit Student Information
    </h2>
    <form wire:submit="updateStudent">
        <div class="flex flex-wrap mb-6 -mx-3">
            <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-first-name">
                    Name
                </label>
                <input id="name" type="text" placeholder="Enter student name" wire:model="form.name"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight
                        @error('form.name')
                            border-red-300 text-red-900 focus:border-red-500 focus:ring-red-500
                        @enderror
                        focus:outline-none focus:bg-white">
                @error('form.name')
                    <p class="text-xs italic text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-first-name">
                    Email
                </label>
                <input id="name" type="email" placeholder="Enter student email" wire:model="email"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight
                        @error('email')
                            border-red-300 text-red-900 focus:border-red-500 focus:ring-red-500
                        @enderror
                        focus:outline-none focus:bg-white">
                @error('email')
                    <p class="text-xs italic text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="flex flex-wrap mb-6 -mx-3">
            <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">
                    Class
                </label>
                <select
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline @error('class_id') border-red-500 @enderror"
                    wire:model.live="class_id">
                    <option>Select a Class</option>
                    @foreach ($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                </select>
                @error('class_id')
                    <p class="text-xs italic text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full px-3 md:w-1/2">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">
                    Section
                </label>
                <select
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline @error('form.section_id') border-red-500 @enderror"
                    wire:model="form.section_id">
                    <option>Select a Section</option>
                    @foreach ($form->sections as $section)
                        <option value="{{ $section->id }}">{{ $section->name }}/{{ $section->class->name }}</option>
                    @endforeach
                </select>
                @error('form.section_id')
                    <p class="text-xs italic text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="flex justify-between">
            <button
                class="flex-shrink-0 px-2 py-1 text-sm text-white bg-teal-500 border-4 border-teal-500 rounded hover:bg-teal-700 hover:border-teal-700"
                type="submit">
                Update
            </button>
            <a wire:navigate href="{{ route('students.index') }}"
                class="p-2 text-white bg-red-800 rounded-lg hover:bg-red-600">Cancel</a>
        </div>
    </form>
</div>
