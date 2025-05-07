<div class="space-y-10">
    <x-mary-card title="{{ $specialtie->name }}" shadow separator
        class="border-gray-200 border-2 dark:border-gray-800 dark:bg-gray-800">

        <div class="flex justify-center mb-6">
            <img class="rounded-xl shadow-md max-h-80 object-cover w-auto" src="{{ $specialtie->image }}"
                alt="Imagen de la especialidad">
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-gray-700 dark:text-gray-200">
            <div>
                <span class="font-semibold">{{ __('Acrónimo:') }}</span>
                <p class="mt-1">{{ $specialtie->acronym }}</p>
            </div>
            <div>
                <span class="font-semibold">{{ __('Nombre de la especialidad:') }}</span>
                <p class="mt-1">{{ $specialtie->name }}</p>
            </div>
            <div class="md:col-span-2">
                <span class="font-semibold">{{ __('Descripción:') }}</span>
                <p class="mt-1 whitespace-pre-line">{{ $specialtie->description }}</p>
            </div>
        </div>

        <x-slot:actions class="flex justify-end gap-4 mt-6">
            @haspermission('specialties.edit')
                <x-mary-button link="{{ route('specialties.edit', $specialtie->id) }}" label="{{ __('Editar') }}"
                    class="btn bg-blue-500 text-white hover:bg-blue-600" />
            @endhaspermission

            <x-mary-button link="{{ route('specialties.index') }}" label="{{ __('Volver') }}"
                class="btn bg-gray-500 text-white hover:bg-gray-600" />
        </x-slot:actions>
    </x-mary-card>

    <x-mary-card title="{{ __('Materias asociadas a la especialidad') }}" shadow separator
        class="border-gray-200 border-2 dark:border-gray-800 dark:bg-gray-800">

        @forelse ($specialtie->subject as $subject)
            <div class="p-4 border rounded-lg mb-3 bg-gray-100 dark:bg-gray-900">
                <p class="font-semibold text-gray-800 dark:text-gray-100">{{ $subject->name }}</p>
            </div>
        @empty
            <div class="p-4 text-gray-500 dark:text-gray-400 italic">
                {{ __('No hay materias asociadas por el momento.') }}
            </div>
        @endforelse
    </x-mary-card>
</div>
