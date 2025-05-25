<x-layouts.guest>
    <div class="min-h-screen p-6 flex flex-col items-center justify-start space-y-8 mb-18">

        {{-- Imagen principal --}}
        <div class="w-full max-w-4xl overflow-hidden rounded-3xl shadow-xl animate-fade-in">
            <img src="{{ $specialtie->image }}" alt="Imagen de la especialidad" class="w-full h-70 object-cover" />
        </div>

        {{-- Contenedor de información --}}
        <div
            class="w-full max-w-4xl bg-white/80 backdrop-blur-md p-6 rounded-3xl shadow-xl space-y-6 slide-left animate-visible">
            <div class="space-y-1">
                <p class="text-gray-800 text-4xl">{{ $specialtie->name }}</p>
            </div>

            <div class="space-y-1">
                <p class="text-lg font-semibold text-indigo-700">{{ __('Descripción:') }}</p>
                <p class="text-gray-700">{{ $specialtie->description }}</p>
            </div>
        </div>

        {{-- Materias asociadas --}}
        <div
            class="w-full max-w-4xl bg-white/70 backdrop-blur-lg p-6 rounded-3xl shadow-md slide-right animate-visible">
            <h2 class="text-2xl font-bold text-indigo-800 mb-4">Materias asociadas</h2>

            @forelse ($specialtie->subject as $subject)
                <div
                    class="p-4 bg-indigo-50 rounded-xl shadow-sm mb-2 border border-indigo-100 hover:bg-indigo-100 transition-all">
                    <p class="font-medium text-indigo-900">{{ $subject->name }}</p>
                </div>
            @empty
                <div class="p-4 text-gray-500 dark:text-gray-400 italic animate-fade-in fade-on-scroll">
                    {{ __('No hay materias asociadas por el momento.') }}
                </div>
            @endforelse
        </div>
    </div>

    <section class="mb-24">
        <div class="justify-items-center">
            <div class="inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold mb-4">
                Contacto
            </div>
            <h2 class="text-3xl font-bold text-gray-800 mb-6">¿Tienes alguna pregunta?</h2>
            <p class="text-gray-600 mb-8">
                Estamos aquí para ayudarte. Comunícate con nosotros a través de cualquiera de estos medios o
                visítanos en nuestras instalaciones.
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start lg:justify-items-center mr-5 ml-5 md:mx-20 mt-10">
            {{-- Teléfono --}}
            <div class="flex items-start gap-4">
                <img src="{{ asset('images/phone_logo.png') }}" alt="phone_logo" class="w-8 h-8">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Teléfono</h3>
                    <p class="text-gray-600 mt-1">(+506) 2553-6190</p>
                    <p class="text-gray-600">Horario: Lunes a Viernes de 7:00 AM a 4:00 PM</p>
                </div>
            </div>

            {{-- Facebook --}}
            <a href="https://www.facebook.com/ctpdulcenombrecartago" target="_blank">
                <div class="flex items-start gap-4">
                    <img src="{{ asset('images/facebook_logo.png') }}" alt="facebook_logo" class="w-8 h-8">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Facebook</h3>
                        <p class="text-gray-600 mt-1">
                            CTP Dulce Nombre Oficial
                        </p>
                    </div>
                </div>
            </a>

            {{-- WhatsApp --}}
            {{--
            <a href="https://wa.me/50612345678" target="_blank">
                <div class="flex items-start gap-4">
                    <img src="{{ asset('images/whatsapp_logo.png') }}" alt="whatsapp_logo" class="w-8 h-8">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">WhatsApp</h3>
                        <p class="text-gray-600 mt-1">
                            (+506) 1234-5678
                        </p>
                    </div>
                </div>
            </a>
            --}}
        </div>
    </section>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.fade-on-scroll').forEach(el => {
                    el.classList.add('animate-visible');
                });
            });
        </script>
    @endpush
</x-layouts.guest>
