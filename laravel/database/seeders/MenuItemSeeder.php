<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuItem;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            // Platos Fuertes
            [
                'name' => 'Lomo Salteado Fusión Nikkei',
                'description' => 'Tiras de lomo fino salteadas al wok con soya premium, cebolla morada, ají amarillo y vegetales crocantes.',
                'price' => 22.50,
                'category' => 'Plato Fuerte',
                'is_available' => true,
            ],
            [
                'name' => 'Risotto de Hongos Silvestres y Trufa',
                'description' => 'Arroz arborio cremoso con variedad de hongos silvestres, mantequilla artesanal y un toque de aceite de trufa blanca.',
                'price' => 24.00,
                'category' => 'Plato Fuerte',
                'is_available' => true,
            ],
            [
                'name' => 'Salmón Glaseado con Miso y Jengibre',
                'description' => 'Filete de salmón fresco horneado a la perfección con glaseado de miso dulce, reducción de mirin y puré de camote.',
                'price' => 26.50,
                'category' => 'Plato Fuerte',
                'is_available' => true,
            ],
            [
                'name' => 'Ribeye a las Tres Pimientas (400g)',
                'description' => 'Corte madurado a la parrilla de carbón, bañado en salsa untuosa de pimienta verde, rosa y negra con papas rústicas.',
                'price' => 34.00,
                'category' => 'Plato Fuerte',
                'is_available' => true,
            ],
            [
                'name' => 'Magret de Pato con Reducción de Oporto',
                'description' => 'Pechuga de pato sellada a fuego lento con salsa de vino de Oporto, higos caramelizados y vegetales glaseados.',
                'price' => 28.00,
                'category' => 'Plato Fuerte',
                'is_available' => true,
            ],
            [
                'name' => 'Pardera de Mariscos al Carbón',
                'description' => 'Langostinos, calamares y mejillones marinados en mantequilla de ajo y finas hierbas, cocinados a la brasa.',
                'price' => 32.00,
                'category' => 'Plato Fuerte',
                'is_available' => false,
            ],

            // Entradas
            [
                'name' => 'Ceviche de Robalo al Maracuyá',
                'description' => 'Fresco robalo en leche de tigre de maracuyá, camote glaseado, cancha serrana y brotes microverdes.',
                'price' => 18.00,
                'category' => 'Entrada',
                'is_available' => true,
            ],
            [
                'name' => 'Pulpo a la Parrilla con Chimichurri Andino',
                'description' => 'Tentáculo de pulpo marinado y sellado al carbón, servido sobre puré de papas nativas y chimichurri andino.',
                'price' => 21.00,
                'category' => 'Entrada',
                'is_available' => true,
            ],
            [
                'name' => 'Tartar de Atún Rojo y Aguacate',
                'description' => 'Atún de aleta amarilla picado a cuchillo con aceite de sésamo, limón de pica, aguacate cremoso y tostadas artesanas.',
                'price' => 19.50,
                'category' => 'Entrada',
                'is_available' => true,
            ],
            [
                'name' => 'Empanadas de Carne Wagyu (3 unidades)',
                'description' => 'Empanadas horneadas artesanalmente rellenas de jugosa carne Wagyu picada con salsa de ají rocoto.',
                'price' => 15.00,
                'category' => 'Entrada',
                'is_available' => true,
            ],
            [
                'name' => 'Carpaccio de Res con Queso Parmesano',
                'description' => 'Láminas ultrafinas de lomo de res marinado con vinagreta de alcaparras, rúcual fresca y escamas de Parmigiano Reggiano.',
                'price' => 17.50,
                'category' => 'Entrada',
                'is_available' => true,
            ],

            // Postres
            [
                'name' => 'Volcán de Cacao 70% con Helado de Vainilla',
                'description' => 'Bizcocho tibio de chocolate fino de aroma con centro fluido, acompañado de helado de vainilla Bourbon.',
                'price' => 9.50,
                'category' => 'Postre',
                'is_available' => true,
            ],
            [
                'name' => 'Cheesecake de Frutos Rojos Silvestres',
                'description' => 'Tarta de queso estilo neoyorquino horneada sobre galleta crocante con coulis casero de moras y frambuesas.',
                'price' => 8.50,
                'category' => 'Postre',
                'is_available' => true,
            ],
            [
                'name' => 'Tiramisú Tradicional con Café Espresso',
                'description' => 'Capas de bizcochuelo de soletilla empapados en café espresso italiano y licor de Amaretto con crema de mascarpone.',
                'price' => 9.00,
                'category' => 'Postre',
                'is_available' => true,
            ],
            [
                'name' => 'Crème Brûlée de Maracuyá',
                'description' => 'Crema horneada infusada con pulpa natural de maracuyá y capa crujiente de azúcar caramelizada con soplete.',
                'price' => 8.00,
                'category' => 'Postre',
                'is_available' => true,
            ],
            [
                'name' => 'Milhojas de Manjar Blanco y Nuez',
                'description' => 'Láminas de hojaldre crocante intercaladas con manjar blanco artesanal y trozos de nueces tostadas.',
                'price' => 7.50,
                'category' => 'Postre',
                'is_available' => false,
            ],

            // Bebidas
            [
                'name' => 'Coctel Siglo XXI - Vino Tinto y Frutos Rojos',
                'description' => 'Mezcla artesanal de vino tinto reserva, infusión de frutos del bosque, cardamomo y especias aromáticas.',
                'price' => 12.00,
                'category' => 'Bebida',
                'is_available' => true,
            ],
            [
                'name' => 'Pisco Sour Tradicional Quebranta',
                'description' => 'El clásico coctel peruano preparado con pisco quebranta, jugo de limón sutil fresco, jarabe de goma y amargo de angostura.',
                'price' => 11.00,
                'category' => 'Bebida',
                'is_available' => true,
            ],
            [
                'name' => 'Gin Tonic Botánico de Lavanda y Romero',
                'description' => 'Gin destilado artesanalmente servido con tónica premium, rama de romero flameado y bayas de enebro.',
                'price' => 13.50,
                'category' => 'Bebida',
                'is_available' => true,
            ],
            [
                'name' => 'Limonada de Hierbabuena y Jengibre',
                'description' => 'Refrescante mezcla de limones sutiles recién exprimidos, hojas de hierbabuena fresca y un toque de extracto de jengibre.',
                'price' => 5.50,
                'category' => 'Bebida',
                'is_available' => true,
            ],
            [
                'name' => 'Infusión Fría de Cítricos y Flor de Jamaica',
                'description' => 'Bebida natural de flor de hibiscus reposada con rodajas de naranja, pomelo y miel de abejas orgánica.',
                'price' => 5.00,
                'category' => 'Bebida',
                'is_available' => true,
            ],
        ];

        foreach ($items as $item) {
            MenuItem::create($item);
        }
    }
}
