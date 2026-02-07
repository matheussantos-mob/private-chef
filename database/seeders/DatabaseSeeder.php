<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Recipe;
use App\Models\Comment;
use App\Models\Rating;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Cria os 4 Usuários
        $admin = User::factory()->create(['name' => 'Admin Sistema', 'email' => 'admin@teste.com']);
        $joao = User::factory()->create(['name' => 'João Silva', 'email' => 'joao@teste.com']);
        $maria = User::factory()->create(['name' => 'Maria Oliveira', 'email' => 'maria@teste.com']);
        $pedro = User::factory()->create(['name' => 'Pedro Santos', 'email' => 'pedro@teste.com']);

        $users = collect([$admin, $joao, $maria, $pedro]);

        // Lista de comentários
        $possibleComments = [
            'Receita maravilhosa, fiz aqui em casa e todos amaram!',
            'Muito fácil de fazer e o sabor ficou incrível. Parabéns!',
            'Fiz para o almoço de domingo e não sobrou nada!',
            'Explicação muito clara, até quem não cozinha consegue fazer.',
            'Dica: Adicionei um toque de pimenta e ficou sensacional!',
            'Melhor versão dessa receita que já encontrei na internet.'
        ];

        // Lista de Receitas
        $recipesList = [
            [
                'title' => 'Feijoada Tradicional',
                'description' => 'Clássico da culinária brasileira, feito com feijão preto e carnes suínas.',
                'ingredients' => ['1 kg de feijão preto', '300g de carne seca', '200g de costela', 'Linguiça calabresa', 'Paio', 'Cebola, alho e louro'],
                'steps' => "1. Deixe as carnes de molho.\n2. Cozinhe o feijão com as carnes.\n3. Refogue temperos e junte ao feijão.\n4. Cozinhe até encorpar.",
                'image' => 'recipes/feijoada.jpg',
            ],
            [
                'title' => 'Coxinha de Frango',
                'description' => 'O salgado mais amado do Brasil, com massa macia e recheio cremoso.',
                'ingredients' => ['500ml caldo de frango', '2 xícaras farinha', 'Manteiga', 'Peito de frango desfiado', 'Requeijão'],
                'steps' => "1. Faça a massa com caldo e farinha.\n2. Refogue o frango com temperos.\n3. Modele as coxinhas e recheie.\n4. Empane e frite.",
                'image' => 'recipes/coxinha.jpg',
            ],
            [
                'title' => 'Arroz e Feijão',
                'description' => 'A base da alimentação brasileira, simples e nutritiva.',
                'ingredients' => ['1 xícara feijão carioca', '2 xícaras arroz', 'Cebola e alho', 'Óleo e sal'],
                'steps' => "1. Cozinhe o feijão na pressão.\n2. Refogue o feijão com alho.\n3. Refogue o arroz.\n4. Cozinhe até secar a água.",
                'image' => 'recipes/arroz-feijao.jpg',
            ],
            [
                'title' => 'Pudim de Leite Condensado',
                'description' => 'Sobremesa clássica, cremosa e com calda de caramelo irresistível.',
                'ingredients' => ['1 lata leite condensado', 'Leite integral', '3 ovos', '1 xícara de açúcar'],
                'steps' => "1. Faça o caramelo na forma.\n2. Bata os ingredientes no liquidificador.\n3. Asse em banho-maria por 1h.\n4. Desenforme gelado.",
                'image' => 'recipes/pudim.jpg',
            ],
        ];

        // Salvar Receitas e Gerar Interações
        foreach ($recipesList as $recipeData) {
            // Criamos a receita associando a um usuário aleatório
            $recipe = Recipe::create(array_merge($recipeData, [
                'user_id' => $users->random()->id
            ]));

            // Criar 3 comentários por receita, cada um de um usuário diferente
            $commentingUsers = $users->random(3);

            foreach ($commentingUsers as $commenter) {
                Comment::create([
                    'recipe_id' => $recipe->id,
                    'user_id' => $commenter->id,
                    'body' => $possibleComments[array_rand($possibleComments)]
                ]);

                //criamos a nota para esse usuário também
                Rating::create([
                    'recipe_id' => $recipe->id,
                    'user_id' => $commenter->id,
                    'score' => rand(4, 5)
                ]);
            }
        }
    }
}