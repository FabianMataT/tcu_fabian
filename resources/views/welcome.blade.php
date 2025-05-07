<x-layouts.guest>

    <!-- Hero Banner -->
    <div class="relative bg-gray-900 text-white">
        <div class="absolute inset-0 bg-black opacity-60"></div>
        <div class="container mx-auto px-4 py-24 relative z-10">
            <div class="max-w-3xl">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Formando líderes para el mundo del mañana</h1>
                <p class="text-xl mb-8">Educación integral de calidad con enfoque técnico y valores humanos</p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#admisiones"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 text-center">Proceso
                        de Admisión</a>
                    <a href="#programas"
                        class="bg-transparent border-2 border-white hover:bg-white hover:text-gray-900 text-white font-bold py-3 px-6 rounded-lg transition duration-300 text-center">Explorar
                        Programas</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-16">
        <!-- Sección Nosotros -->
        <section id="nosotros" class="mb-16">
            <div class="flex flex-col md:flex-row items-center gap-12">        
                <img src="{{ asset('images/cpt.jpg') }}" alt="logo"
                    class="w-full md:w-1/2 h-auto rounded-xl shadow-xl object-cover">
                <div class="w-full md:w-1/2">
                    <div
                        class="inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold mb-4">
                        Sobre Nosotros</div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-6 border-b-2 border-blue-500 pb-2 inline-block">
                        Nuestra Historia e Identidad</h2>

                    <div class="mb-8">
                        <h3 class="text-2xl font-bold text-gray-700">Nuestra Visión</h3>
                        <p class="text-gray-600 mt-2 text-lg">Ser una institución educativa de excelencia que forme
                            líderes con valores y conocimientos para transformar positivamente nuestra sociedad y
                            enfrentar los desafíos del futuro.</p>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-2xl font-bold text-gray-700">Nuestra Misión</h3>
                        <p class="text-gray-600 mt-2 text-lg">Brindar educación integral de calidad, fomentando el
                            desarrollo académico, técnico, social y cultural de nuestros estudiantes mediante
                            metodologías innovadoras y un equipo docente altamente calificado.</p>
                    </div>

                    <div>
                        <h3 class="text-2xl font-bold text-gray-700">Nuestros Valores</h3>
                        <div class="grid grid-cols-2 gap-4 mt-3">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-check-circle text-blue-500"></i>
                                <span class="text-gray-700">Respeto</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-check-circle text-blue-500"></i>
                                <span class="text-gray-700">Responsabilidad</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-check-circle text-blue-500"></i>
                                <span class="text-gray-700">Excelencia</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-check-circle text-blue-500"></i>
                                <span class="text-gray-700">Innovación</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-check-circle text-blue-500"></i>
                                <span class="text-gray-700">Solidaridad</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-check-circle text-blue-500"></i>
                                <span class="text-gray-700">Integridad</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Estadísticas -->
        <section class="mb-16 bg-blue-800 text-white py-12 rounded-xl shadow-lg px-6">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold">Nuestras Cifras</h2>
                <p class="text-blue-200 mt-2">Años formando profesionales de excelencia</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-5xl font-bold mb-2">25+</div>
                    <div class="text-blue-200 text-lg">Años de experiencia</div>
                </div>
                <div>
                    <div class="text-5xl font-bold mb-2">95%</div>
                    <div class="text-blue-200 text-lg">Índice de graduación</div>
                </div>
                <div>
                    <div class="text-5xl font-bold mb-2">50+</div>
                    <div class="text-blue-200 text-lg">Docentes calificados</div>
                </div>
                <div>
                    <div class="text-5xl font-bold mb-2">1,200+</div>
                    <div class="text-blue-200 text-lg">Estudiantes activos</div>
                </div>
            </div>
        </section>

        <!-- Programas Académicos -->
        <section id="programas" class="mb-16">
            <div class="text-center mb-12">
                <div class="inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">
                    Programas Académicos</div>
                <h2 class="text-3xl font-bold text-gray-800 mt-2">Oferta Educativa</h2>
                <p class="text-gray-600 mt-2 max-w-3xl mx-auto">Nuestros programas académicos están diseñados para
                    brindar una formación integral con enfoque técnico y humano.</p>
            </div>

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

            <div class="text-center mt-8">
                <a href="#"
                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-300">Ver
                    todos los programas</a>
            </div>
        </section>

        <!-- Proceso de Admisión -->
        <section id="admisiones" class="mb-16">
            <div class="bg-gray-100 rounded-xl p-8 shadow-lg">
                <div class="text-center mb-10">
                    <div class="inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">
                        Admisiones</div>
                    <h2 class="text-3xl font-bold text-gray-800 mt-2">Proceso de Matrícula</h2>
                    <p class="text-gray-600 mt-2 max-w-3xl mx-auto">Te guiamos paso a paso en el proceso de admisión
                        para formar parte de nuestra familia educativa.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-white p-6 rounded-lg shadow border-t-4 border-blue-500 text-center">
                        <div class="bg-blue-100 w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-4">
                            <span class="text-blue-600 font-bold text-2xl">1</span>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Solicitud en línea</h3>
                        <p class="text-gray-600">Completa el formulario de solicitud disponible en nuestra página web.
                        </p>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow border-t-4 border-blue-500 text-center">
                        <div class="bg-blue-100 w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-4">
                            <span class="text-blue-600 font-bold text-2xl">2</span>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Entrevista</h3>
                        <p class="text-gray-600">Programamos una entrevista con el estudiante y sus padres o
                            encargados.</p>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow border-t-4 border-blue-500 text-center">
                        <div class="bg-blue-100 w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-4">
                            <span class="text-blue-600 font-bold text-2xl">3</span>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Evaluación diagnóstica</h3>
                        <p class="text-gray-600">Realización de pruebas para determinar el nivel académico del
                            estudiante.</p>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow border-t-4 border-blue-500 text-center">
                        <div class="bg-blue-100 w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-4">
                            <span class="text-blue-600 font-bold text-2xl">4</span>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Matrícula</h3>
                        <p class="text-gray-600">Formalización de la matrícula y entrega de documentación requerida.
                        </p>
                    </div>
                </div>

                <div class="mt-10 bg-blue-50 p-6 rounded-lg border border-blue-200">
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Documentos requeridos:</h3>
                    <ul class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <li class="flex items-center gap-2"><i class="fas fa-file-alt text-blue-500"></i> Certificado
                            de nacimiento</li>
                        <li class="flex items-center gap-2"><i class="fas fa-file-alt text-blue-500"></i>
                            Calificaciones del último año</li>
                        <li class="flex items-center gap-2"><i class="fas fa-file-alt text-blue-500"></i> Constancia
                            de conducta</li>
                        <li class="flex items-center gap-2"><i class="fas fa-file-alt text-blue-500"></i> Fotografías
                            recientes</li>
                        <li class="flex items-center gap-2"><i class="fas fa-file-alt text-blue-500"></i>
                            Identificación de los padres</li>
                        <li class="flex items-center gap-2"><i class="fas fa-file-alt text-blue-500"></i> Comprobante
                            de domicilio</li>
                    </ul>
                </div>

                <div class="mt-8 text-center">
                    <a href="#"
                        class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-300">Iniciar
                        proceso de admisión</a>
                </div>
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

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="group relative overflow-hidden rounded-xl shadow-lg">
                    <img src="/api/placeholder/400/300" alt="Laboratorios"
                        class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6">
                        <div>
                            <h3 class="text-white text-xl font-bold">Laboratorios de Ciencias</h3>
                            <p class="text-gray-200 mt-2">Equipados con tecnología de última generación para
                                experimentación práctica.</p>
                        </div>
                    </div>
                </div>

                <div class="group relative overflow-hidden rounded-xl shadow-lg">
                    <img src="/api/placeholder/400/300" alt="Biblioteca"
                        class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6">
                        <div>
                            <h3 class="text-white text-xl font-bold">Biblioteca y Centro de Estudios</h3>
                            <p class="text-gray-200 mt-2">Amplio espacio con recursos bibliográficos físicos y
                                digitales.</p>
                        </div>
                    </div>
                </div>

                <div class="group relative overflow-hidden rounded-xl shadow-lg">
                    <img src="/api/placeholder/400/300" alt="Áreas deportivas"
                        class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6">
                        <div>
                            <h3 class="text-white text-xl font-bold">Áreas Deportivas</h3>
                            <p class="text-gray-200 mt-2">Canchas multiusos, gimnasio y áreas verdes para actividades
                                físicas.</p>
                        </div>
                    </div>
                </div>

                <div class="group relative overflow-hidden rounded-xl shadow-lg">
                    <img src="/api/placeholder/400/300" alt="Aulas"
                        class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6">
                        <div>
                            <h3 class="text-white text-xl font-bold">Aulas Inteligentes</h3>
                            <p class="text-gray-200 mt-2">Espacios cómodos con tecnología educativa integrada.</p>
                        </div>
                    </div>
                </div>

                <div class="group relative overflow-hidden rounded-xl shadow-lg">
                    <img src="/api/placeholder/400/300" alt="Laboratorio de computación"
                        class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6">
                        <div>
                            <h3 class="text-white text-xl font-bold">Laboratorios de Informática</h3>
                            <p class="text-gray-200 mt-2">Equipados con computadoras modernas y software especializado.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="group relative overflow-hidden rounded-xl shadow-lg">
                    <img src="/api/placeholder/400/300" alt="Auditorio"
                        class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6">
                        <div>
                            <h3 class="text-white text-xl font-bold">Auditorio</h3>
                            <p class="text-gray-200 mt-2">Espacio para eventos académicos, culturales y conferencias.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonios -->
        <section class="mb-16">
            <div class="text-center mb-12">
                <div class="inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">
                    Testimonios</div>
                <h2 class="text-3xl font-bold text-gray-800 mt-2">Lo que dicen nuestros estudiantes</h2>
                <p class="text-gray-600 mt-2 max-w-3xl mx-auto">Experiencias de quienes forman parte de nuestra
                    comunidad educativa.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-500">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6 italic">"El ambiente académico es excelente. Los profesores están muy
                        bien preparados y siempre están dispuestos a ayudar. Me siento muy bien preparado para la
                        universidad."</p>
                    <div class="flex items-center">
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-800">Carlos Rodríguez</h4>
                            <p class="text-gray-500 text-sm">Estudiante de Bachillerato</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-500">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6 italic">"La formación técnica que recibí me permitió conseguir un buen
                        empleo apenas me gradué. Los laboratorios están bien equipados y aprendemos con práctica real."
                    </p>
                    <div class="flex items-center">
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-800">María Fernández</h4>
                            <p class="text-gray-500 text-sm">Graduada en Técnico en Informática</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-500">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6 italic">"Como padre, valoro mucho la formación integral que recibe mi
                        hijo. No solo aprende contenidos académicos, sino también valores y habilidades para la vida."
                    </p>
                    <div class="flex items-center">
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-800">Roberto Méndez</h4>
                            <p class="text-gray-500 text-sm">Padre de familia</p>
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
