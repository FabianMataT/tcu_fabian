<x-layouts.guest>
    <!-- bg gradient del (Formando Lideres) -->
    <div class="relative flex items-start justify-center text-center overflow-hidden pt-8 min-h-screen">
        <div class="absolute inset-0 z-0 mask-radial-fade">
            <div class="w-full h-full bg-gradient-radial blur-2xl opacity-90"></div>
        </div>
        <div class="container mx-auto px-6 mt-2 sm:mt-2 md:mt-6 lg:mt-18 relative z-10">
            <div class="max-w-3xl mx-auto">
                <img src="{{ asset('images/CTP_DN_Logo.jpg') }}" alt="Logo CTP"
                    class="mx-auto mb-6 h-22 w-22 rounded-2xl shadow-md object-cover animate-fade-in" />
                <h1 class="text-5xl md:text-6xl font-extrabold text-gray-800 mb-6 opacity-0 animate-fade-in">
                    Formando líderes para el mundo del mañana
                </h1>
                <p class="text-xl md:text-2xl text-gray-700 mb-10 animate-fade-in">
                    Educación integral de calidad con enfoque técnico y valores humanos
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4 items-center animate-fade-in">
                    <a href="#admisiones"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-xl transition duration-300 shadow-lg">
                        Proceso de Admisión
                    </a>
                    <a href="#programas"
                        class="bg-white bg-opacity-70 hover:bg-opacity-100 text-gray-800 border border-gray-300 hover:border-gray-400 font-semibold py-3 px-6 rounded-xl transition duration-300 shadow">
                        Especialidades Técnicas
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <!-- Sección Sobre Nosotros -->
        <section id="nosotros" class="mb-20">
            <div
                class="flex flex-col md:flex-row items-center gap-12 fade-on-scroll transition-all duration-700 ease-out opacity-0 translate-y-2">
                <img src="{{ asset('images/cpt.jpg') }}" alt="logo"
                    class="w-full md:w-1/2 h-auto rounded-xl shadow-xl object-cover transition-all duration-1000 ease-out opacity-0 translate-y-4 animate-[fadeInUp_2s_ease-out_forwards]" />
                <div class="w-full md:w-1/2 space-y-8">
                    <div
                        class="inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold transition-all duration-700 ease-out opacity-0 translate-y-2 animate-[fadeInUp_2s_0.2s_ease-out_forwards]">
                        Sobre Nosotros
                    </div>
                    <h2
                        class="text-3xl font-bold text-gray-800 border-b-2 border-blue-500 pb-2 inline-block transition-all duration-700 ease-out opacity-0 translate-y-2 animate-[fadeInUp_2s_0.3s_ease-out_forwards]">
                        Nuestra Historia e Identidad
                    </h2>
                    <div
                        class="transition-all duration-700 ease-out opacity-0 translate-y-2 animate-[fadeInUp_2s_0.4s_ease-out_forwards]">
                        <h3 class="text-2xl font-bold text-gray-700">Nuestra Visión</h3>
                        <p class="text-gray-600 mt-2 text-lg">
                            Ser una institución educativa de excelencia que forme líderes con valores...
                        </p>
                    </div>
                    <div
                        class="transition-all duration-700 ease-out opacity-0 translate-y-2 animate-[fadeInUp_2s_0.5s_ease-out_forwards]">
                        <h3 class="text-2xl font-bold text-gray-700">Nuestra Misión</h3>
                        <p class="text-gray-600 mt-2 text-lg">
                            Brindar educación integral de calidad, fomentando el desarrollo académico...
                        </p>
                    </div>
                    <div
                        class="transition-all duration-700 ease-out opacity-0 translate-y-2 animate-[fadeInUp_2s_0.6s_ease-out_forwards]">
                        <h3 class="text-2xl font-bold text-gray-700">Nuestros Valores</h3>
                        <div class="grid grid-cols-2 gap-4 mt-3">
                            @foreach (['Respeto', 'Responsabilidad', 'Excelencia', 'Innovación', 'Solidaridad', 'Integridad'] as $valor)
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-check-circle text-blue-500"></i>
                                    <span class="text-gray-700">{{ $valor }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Estadísticas -->
        <section id="cifras" class="mb-16 bg-blue-800 text-white py-12 rounded-xl shadow-lg px-6">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold">Nuestras Cifras</h2>
                <p class="text-blue-200 mt-2">Años formando profesionales de excelencia</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-5xl font-bold mb-2 counter" data-target="25">0</div>
                    <div class="text-blue-200 text-lg">Años de experiencia</div>
                </div>
                <div>
                    <div class="text-5xl font-bold mb-2 counter" data-target="95">0</div>
                    <div class="text-blue-200 text-lg">Índice de graduación</div>
                </div>
                <div>
                    <div class="text-5xl font-bold mb-2 counter" data-target="50">0</div>
                    <div class="text-blue-200 text-lg">Docentes calificados</div>
                </div>
                <div>
                    <div class="text-5xl font-bold mb-2 counter" data-target="1200">0</div>
                    <div class="text-blue-200 text-lg">Estudiantes activos</div>
                </div>
            </div>
        </section>

        <!-- Especialidades -->
        <section id="programas" class="mb-16">
            <div class="text-center mb-5">
                <div class="inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">
                    Especialidades</div>
                <h2 class="text-3xl font-bold text-gray-800 mt-2">Especialidades Técnicas</h2>
                <p class="text-gray-600 mt-2 max-w-3xl mx-auto">Nuestras Especialidades.</p>
            </div>

            <x-mary-carousel :slides="$slides" autoplay class="!h-120" />
            {{--

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div
                    class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:shadow-xl hover:-translate-y-2">
                    <div class="h-48 bg-blue-200 relative">
                        <img src="/api/placeholder/400/300" alt="Programa de Bachillerato"
                            class="w-full h-full object-cover">
                        <div class="absolute top-0 left-0 bg-blue-600 text-white py-1 px-4 rounded-br-lg">Básico</div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Bachillerato Académico</h3>
                        <p class="text-gray-600 mb-4">Formación integral con énfasis en ciencias, matemáticas, lenguaje
                            y humanidades. Prepara para el ingreso a la universidad.</p>
                        <a href="#" class="text-blue-600 font-semibold hover:text-blue-800 flex items-center">
                            Ver detalles <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>

                <div
                    class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:shadow-xl hover:-translate-y-2">
                    <div class="h-48 bg-green-200 relative">
                        <img src="/api/placeholder/400/300" alt="Programa Técnico en Informática"
                            class="w-full h-full object-cover">
                        <div class="absolute top-0 left-0 bg-green-600 text-white py-1 px-4 rounded-br-lg">Técnico
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Técnico en Informática</h3>
                        <p class="text-gray-600 mb-4">Formación especializada en programación, redes, diseño web y
                            mantenimiento de sistemas informáticos.</p>
                        <a href="#" class="text-blue-600 font-semibold hover:text-blue-800 flex items-center">
                            Ver detalles <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>

                <div
                    class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:shadow-xl hover:-translate-y-2">
                    <div class="h-48 bg-yellow-200 relative">
                        <img src="/api/placeholder/400/300" alt="Programa Técnico en Administración"
                            class="w-full h-full object-cover">
                        <div class="absolute top-0 left-0 bg-yellow-600 text-white py-1 px-4 rounded-br-lg">Técnico
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Técnico en Administración</h3>
                        <p class="text-gray-600 mb-4">Formación en gestión empresarial, contabilidad, mercadeo y
                            recursos humanos para el mundo de los negocios.</p>
                        <a href="#" class="text-blue-600 font-semibold hover:text-blue-800 flex items-center">
                            Ver detalles <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
--}}
            <div class="text-center mt-8">
                <a href="#"
                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-300">Ver
                    todas las especialidades</a>
            </div>
        </section>

        <!-- Instalaciones -->
        <section id="instalaciones" class="mb-16">

            <div class="text-center mb-12">
                <div class="inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">
                    Instalaciones</div>
                <h2 class="text-3xl font-bold text-gray-800 mt-2">Nuestro Campus</h2>
                <p class="text-gray-600 mt-2 max-w-3xl mx-auto">Contamos con modernas instalaciones diseñadas para
                    proporcionar un ambiente óptimo de aprendizaje.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center justify-center">
                <div class="group relative overflow-hidden rounded-xl shadow-lg slide-left fade-on-scroll">
                    <img src="/api/placeholder/400/300" alt="Biblioteca"
                        class="w-full h-70 object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6">
                        <div>
                            <h3 class="text-white text-xl font-bold">Biblioteca y Centro de Estudios</h3>
                            <p class="text-gray-200 mt-2">Amplio espacio con recursos bibliográficos físicos y
                                digitales.</p>
                        </div>
                    </div>
                </div>

                <div class="group relative overflow-hidden rounded-xl shadow-lg animate-fade-in fade-on-scroll">
                    <img src="/api/placeholder/400/300" alt="Áreas deportivas"
                        class="w-full h-70 object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6">
                        <div>
                            <h3 class="text-white text-xl font-bold">Áreas Deportivas</h3>
                            <p class="text-gray-200 mt-2">Canchas multiusos, gimnasio y áreas verdes para actividades
                                físicas.</p>
                        </div>
                    </div>

                </div>

                <div class="group relative overflow-hidden rounded-xl shadow-lg slide-right fade-on-scroll">
                    <img src="/api/placeholder/400/300" alt="Laboratorio de computación"
                        class="w-full h-70 object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6">
                        <div>
                            <h3 class="text-white text-xl font-bold">Laboratorios de Informática</h3>
                            <p class="text-gray-200 mt-2">Equipados con computadoras modernas y software especializado.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6 items-center justify-center max-w-4xl mx-auto">
                <div class="group relative overflow-hidden rounded-xl shadow-lg slide-left fade-on-scroll">
                    <img src="/api/placeholder/400/300" alt="Auditorio"
                        class="w-full h-70 object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6">
                        <div>
                            <h3 class="text-white text-xl font-bold">Aulas</h3>
                            <p class="text-gray-200 mt-2">Ambientes modernos y funcionales diseñados para favorecer el
                                aprendizaje.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="group relative overflow-hidden rounded-xl shadow-lg slide-right fade-on-scroll">
                    <img src="{{ asset('images/CTP_DN_Logo.jpg') }}" alt="Biblioteca"
                        class="w-full h-70 object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6">
                        <div>
                            <h3 class="text-white text-xl font-bold">Comenor</h3>
                            <p class="text-gray-200 mt-2">Espacio cómodo y limpio donde los estudiantes pueden
                                disfrutar de sus alimentos.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contacto -->
        <section id="contacto" class="mb-16">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <div
                        class="inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold mb-4">
                        Contacto</div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">¿Tienes alguna pregunta?</h2>
                    <p class="text-gray-600 mb-8">Estamos aquí para ayudarte. Comunícate con nosotros a través de
                        cualquiera de estos medios o visítanos en nuestras instalaciones.</p>

                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="bg-blue-100 p-3 rounded-full text-blue-600">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Ubicación</h3>
                                <p class="text-gray-600 mt-1">Avenida Central #123, San José, Costa Rica</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="bg-blue-100 p-3 rounded-full text-blue-600">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Teléfono</h3>
                                <p class="text-gray-600 mt-1">(+506) 1234-5678</p>
                                <p class="text-gray-600">Horario: Lunes a Viernes de 7:00 AM a 4:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-layouts.guest>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-visible');
                    observer.unobserve(entry
                        .target); 
                }
            });
        }, {
            threshold: 0.1,
        });

        document.querySelectorAll('.fade-on-scroll').forEach(el => {
            observer.observe(el);
        });
    });

    document.addEventListener('DOMContentLoaded', () => {
        const counters = document.querySelectorAll('.counter');
        let hasAnimated = false;

        const countUp = (el) => {
            const target = +el.getAttribute('data-target');
            const isPercentage = el.textContent.includes('%');
            const isPlus = el.textContent.includes('+');
            const duration = 2000;
            const stepTime = 10;
            const steps = duration / stepTime;
            let current = 0;
            const increment = target / steps;

            const updateCounter = () => {
                current += increment;
                if (current < target) {
                    el.textContent = Math.floor(current) + (isPlus ? '+' : '') + (isPercentage ? '%' :
                        '');
                    setTimeout(updateCounter, stepTime);
                } else {
                    el.textContent = target.toLocaleString() + (isPlus ? '+' : '') + (isPercentage ?
                        '%' : '');
                }
            };
            updateCounter();
        };

        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !hasAnimated) {
                    counters.forEach(counter => countUp(counter));
                    hasAnimated = true;
                    obs.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.3
        });

        const cifrasSection = document.querySelector('#cifras');
        if (cifrasSection) {
            observer.observe(cifrasSection);
        }
    });
</script>
