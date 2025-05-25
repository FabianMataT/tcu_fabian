<x-layouts.guest>
    <h1 class="text-center font-bold text-gray-800 text-4xl mt-8 mb-10 slide-left fade-on-scroll">Nuestras Especialidades
    </h1>
    <section class="mb-24 sm:m-5 md:m-10 lg:m-16">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($specialties as $index => $specialtie)
                @php
                    $animationClass = match ($index % 3) {
                        0 => 'slide-left fade-on-scroll',
                        1 => 'animate-fade-in fade-on-scroll',
                        2 => 'slide-right fade-on-scroll',
                    };
                @endphp
                <a href="{{ route('guest.specialties.show', $specialtie) }}" class="h-full">
                    <div
                        class="flex flex-col h-full bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:shadow-xl hover:-translate-y-2 {{ $animationClass }}">
                        <div class="h-48 bg-blue-200 relative">
                            <img src="{{ $specialtie->image }}" alt="Programa de Bachillerato"
                                class="w-full h-full object-cover">
                            <div class="absolute top-0 left-0 bg-blue-600 text-white py-1 px-4 rounded-br-lg">
                                Técnico Medio
                            </div>
                        </div>
                        <div class="p-6 flex flex-col justify-between flex-grow">
                            <div>
                                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $specialtie->name }}</h3>
                                <p class="text-gray-600 mb-4">{{ Str::limit($specialtie->description, 200, '...') }}</p>
                            </div>
                            <p class="text-blue-600 font-semibold hover:text-blue-800 flex items-center mt-auto">
                                Ver detalles
                            </p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

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
