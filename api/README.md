**
    Procedimento instalação do sistema:**

- `<command>` git clone `<repositorio>`				// clona repositório do projeto
- `<command>` cp .env.example .env				// após isso deve configurar os dados de acesso
- `<command>` composer install					// instala todas dependências
- `<command>` composer update					// atualiza todas dependências
- `<command>` php artisan migrate					// roda todas as migrations na base de dados
- `<command>` php artisan jwt:secret 				// gera uma credencial para o json web tokens
- `<command>` php artisan db:seed UsersSeeder 		// popula usuários fictícios na tabela
- `<command>` php artisan db:seed VacanciesSeeder 	// popula vagas fictícias na tabela
- `<command>` php artisan db:seed InfosSeeder 		// popula informações de users fictícias na tabela
- `<command>` php artisan test 					// executa todos os testes unitários na api
- `<command>` php artisan l5-swagger:generate		// gera documentação swagger
- `<command>` php artisan migrate:refresh			// reseta o banco de dados da aplicação
- `<command>` php artisan optimize:clear			// limpa cache, sessões e configurações
