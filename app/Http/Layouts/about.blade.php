@extends('layouts.public')

@section('title', 'Acerca de EnergySmart')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h1 class="display-4 mb-4">Acerca de EnergySmart</h1>
            
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h2 class="h4 mb-3">Nuestra Misión</h2>
                    <p>En EnergySmart nos dedicamos a ayudar a los hogares y pequeñas empresas a optimizar su consumo de energía eléctrica, reduciendo costos y promoviendo prácticas sostenibles.</p>
                    <p>Creemos que el conocimiento es poder, y al proporcionar herramientas fáciles de usar y análisis detallados, empoderamos a nuestros usuarios para tomar decisiones informadas sobre su consumo energético.</p>
                </div>
            </div>
            
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h2 class="h4 mb-3">Cómo Funciona</h2>
                    <p>EnergySmart utiliza un enfoque innovador para estimar el consumo de energía sin necesidad de costosos medidores inteligentes:</p>
                    <ol>
                        <li>Registras los electrodomésticos y sistemas de iluminación de tu hogar</li>
                        <li>Indicas el uso aproximado de cada dispositivo</li>
                        <li>Nuestro sistema calcula el consumo estimado</li>
                        <li>Te proporcionamos recomendaciones personalizadas para ahorrar energía</li>
                    </ol>
                </div>
            </div>
            
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="h4 mb-3">Nuestro Equipo</h2>
                    <p>Somos un equipo de ingenieros y especialistas en energía comprometidos con la sostenibilidad y la innovación tecnológica.</p>
                    <p>Nuestra experiencia combinada en desarrollo de software, eficiencia energética y análisis de datos nos permite ofrecer una solución única en el mercado.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection