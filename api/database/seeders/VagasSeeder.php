<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VagasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vagas')->insert([
            [
                'descricao_curta' => 'Desenvolvimento de site institucional',
                'descricao_longa' => 'Precisamos de um desenvolvedor para criar um site institucional responsivo utilizando HTML, CSS e JavaScript. Deve ser entregue em 2 semanas.',
                'remuneracao' => 1500,
                'cep' => '12345678',
                'user_id' => 1,
            ],
            [
                'descricao_curta' => 'Design de logo para empresa',
                'descricao_longa' => 'Estamos procurando um designer gráfico para criar um logotipo moderno e criativo para nossa empresa de tecnologia. Preferencialmente com experiência em Adobe Illustrator.',
                'remuneracao' => 500,
                'cep' => '87654321',
                'user_id' => 2,
            ],
            [
                'descricao_curta' => 'Redação de artigo sobre marketing digital',
                'descricao_longa' => 'Precisamos de um redator experiente para escrever um artigo de blog sobre estratégias de marketing digital. O artigo deve ter pelo menos 1000 palavras e ser otimizado para SEO.',
                'remuneracao' => 300,
                'cep' => '56789012',
                'user_id' => 3,
            ],
            [
                'descricao_curta' => 'Garçom para evento de casamento',
                'descricao_longa' => 'Precisamos de um garçom para servir bebidas e aperitivos durante um evento de casamento para 50 pessoas. Experiência anterior em eventos similares é preferível.',
                'remuneracao' => 200,
                'cep' => '13579024',
                'user_id' => 1,
            ],
            [
                'descricao_curta' => 'Cuidador de idosos por período noturno',
                'descricao_longa' => 'Procuramos um cuidador de idosos para cuidar de um paciente durante a noite. O candidato deve ser paciente, responsável e ter experiência em cuidados de idosos.',
                'remuneracao' => 250,
                'cep' => '98765432',
                'user_id' => 2,
            ],
            // Adicione mais vagas conforme necessário
        ]);
    }
}
