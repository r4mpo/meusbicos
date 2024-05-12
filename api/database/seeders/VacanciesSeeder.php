<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VacanciesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('vacancies')->insert([
            [
                'short_description' => 'Desenvolvimento de site institucional',
                'long_description' => 'Precisamos de um desenvolvedor para criar um site institucional responsivo utilizando HTML, CSS e JavaScript. Deve ser entregue em 2 semanas.',
                'wage' => 1500,
                'zip_code' => '12345678',
                'user_id' => 1,
            ],
            [
                'short_description' => 'Design de logo para empresa',
                'long_description' => 'Estamos procurando um designer gráfico para criar um logotipo moderno e criativo para nossa empresa de tecnologia. Preferencialmente com experiência em Adobe Illustrator.',
                'wage' => 500,
                'zip_code' => '87654321',
                'user_id' => 2,
            ],
            [
                'short_description' => 'Redação de artigo sobre marketing digital',
                'long_description' => 'Precisamos de um redator experiente para escrever um artigo de blog sobre estratégias de marketing digital. O artigo deve ter pelo menos 1000 palavras e ser otimizado para SEO.',
                'wage' => 300,
                'zip_code' => '56789012',
                'user_id' => 3,
            ],
            [
                'short_description' => 'Garçom para evento de casamento',
                'long_description' => 'Precisamos de um garçom para servir bebidas e aperitivos durante um evento de casamento para 50 pessoas. Experiência anterior em eventos similares é preferível.',
                'wage' => 200,
                'zip_code' => '13579024',
                'user_id' => 1,
            ],
            [
                'short_description' => 'Cuidador de idosos por período noturno',
                'long_description' => 'Procuramos um cuidador de idosos para cuidar de um paciente durante a noite. O candidato deve ser paciente, responsável e ter experiência em cuidados de idosos.',
                'wage' => 250,
                'zip_code' => '98765432',
                'user_id' => 2,
            ],
            // Add more vacancies as needed
        ]);
    }
}
