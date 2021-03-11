# Instalação
1. Rode o comando ``composer install`` para instalar as dependencias do projeto.
2. Na raiz do projeto , copie o conteúdo do arquivo **.env.example** , e crie na raiz um arquivo chamado .env , e cole seu conteúdo.
3. Rode o comando ``php artisan key:generate`` , para gerar uma chave para aplicação no .env .
4. No arquivo .env , das variaveis com nome **DB** , insira as configurações do banco que será utilizado pela aplicação.
5. Rode o comando ``php artisan migrate`` , para migrar para as tabelas que serão utilizadas pela aplicação , para seu banco.
6. Rode o comando ``php artisan db:seed`` , para inserir na tabela status os status disponíveis.
7. Rode o comando `` npm install ``, para instalar as dependencias no projeto.
8. Rode o comando ``npm run dev `` , para compilar os assets na aplicação.
9. Para o disparo de e-mails funcionar , configure os drivers de e-mail no .env . Para os testes utilizei o mailgun.

# Utilização
1. Rode o comando ``php artisan serve`` , para utilizar a aplicação localmente.


### Enjoy :)
