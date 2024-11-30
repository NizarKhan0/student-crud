<div class="mx-auto mt-8 mb-8 w-fit">
    <h2 class="text-center font-extrabold text-3xl p-4 my-2">
        Edit Student Information
    </h2>
    <form wire:submit="updateStudent">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    Name
                </label>
                <input id="name" type="text" placeholder="Enter student name" wire:model="form.name"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight
                        @error('form.name')
                            border-red-300 text-red-900 focus:border-red-500 focus:ring-red-500
                        @enderror
                        focus:outline-none focus:bg-white">
                @error('form.name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    Email
                </label>
                <input id="name" type="email" placeholder="Enter student email" wire:model="email"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight
                        @error('email')
                            border-red-300 text-red-900 focus:border-red-500 focus:ring-red-500
                        @enderror
                        focus:outline-none focus:bg-white">
                @error('email')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
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
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
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
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="flex justify-between">
            <button
                class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded"
                type="submit">
                Update
            </button>
            <a wire:navigate href="{{ route('students.index') }}"
                class="p-2 text-white bg-red-800 rounded-lg hover:bg-red-600">Cancel</a>
        </div>
    </form>
</div>
