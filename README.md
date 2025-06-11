<h1>CTP Dulce Nombre</h1>
<p>
    Es una plataforma desarrollada con <strong>Laravel 12</strong>.
</p>

![ctp_dulce_nombre](https://github.com/user-attachments/assets/cdafb97d-1932-416a-a682-b2ba4320559d)

<h2>Tecnologías Utilizadas</h2>
<ul>
    <li><strong>Framework:</strong> Laravel 12</li>
    <li><strong>Data Base:</strong> MySQL</li>
    <li><strong>Dependency Management:</strong> Composer</li>
    <li><strong>Frontend:</strong> Node.js, NPM, Livewire, TailwindCSS y MaryUI</li>
</ul>
    
<h1>Correr el proyecto de forma local:</h1>

<h2>Requisitos Previos</h2>
<p>Asegúrate de tener instalados los siguientes programas en tu sistema:</p>
<ul>
    <li>PHP >= 8.1</li>
    <li>Composer</li>
    <li>Node.js y NPM</li>
    <li>MySQL</li>
</ul>
    
<h2>Pasos para Configurar el Proyecto</h2>
<strong>Clonar el repositorio:</strong>
       
    git clone https://github.com/CTPDulceNombre/ctp_dulce_nombre_oficial.git
    cd ctp_dulce_nombre_oficial

<strong>Instalar dependencias del backend y frontend:</strong>

    composer install
    npm install
    composer require spatie/laravel-permission

<strong>Configurar el archivo .env:</strong>

    php -r "file_exists('.env') || copy('.env.example', '.env');"
    php artisan key:generate

<strong>Ejecutar las migraciones y seeders:</strong>

    php artisan migrate
    php artisan db:seed

<strong>Optimizar el proyecto:</strong>

    php artisan optimize:
    php artisan optimize

<strong>Iniciar el servidor de desarrollo:</strong>

    php artisan serve
    npm run dev

<p>La aplicación estará disponible en 
    <a href="http://localhost:8000" target="_blank">http://localhost:8000<a>.
</p> 
    
