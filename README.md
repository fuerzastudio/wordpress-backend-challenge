# WordPress Backend Challenge

Desafio WordPress para programadores back-end interessados em trabalhar na Fuerza.

## Introdução

Desenvolva um plugin em WordPress para a divulgação de cursos em qualquer tema que esteja sendo utilizado no site onde o plugin for ativado.

## Escopo

É necessário que o plugin habilite um novo tipo de conteúdo no WordPress chamado Cursos Fuerza com os campos de Título, Editor clássico do WordPress, Resumo e Imagem destacada. Também é necessário que na tela de inclusão e edição de um curso seja possível para o administrador definir facilmente um link de inscrição no curso, a carga horária e a data limite de inscrições.

Na single de um curso, deve ser exibido antes do conteúdo da postagem as informações de Carga Horária e a data limite das inscrições. Quando essa data já tiver passado, em seu lugar deve ser exibida uma mensagem informando que as inscrições já se encerraram.

Ainda na single do curso, mas após todo o conteúdo, deve ser exibido um formulário com o título "Tenho Interesse" e os campos de Nome e E-mail. O submit desse formulário deve enviar os dados capturados sem o recarregamento da página, consumindo uma rota na WP Rest Api para salvá-los em uma tabela personalizada do banco de dados que deve armazenar em cada registro além do nome e e-mail preenchidos, a data e hora do preenchimento e o curso de interesse. Após a inclusão com sucesso de um registro o usuário deve ser redirecionado para o link de inscrição configurado para o curso. Não deve ser permitido que um mesmo e-mail seja cadastrado mais de uma vez no curso. Caso a data limite de inscrições já tenha passado, o formulário não será mais exibido e em seu lugar apenas um botão (link) que redirecione o usuário para o link de inscrição. Ah, não se esqueça de apresentar feedbacks das ações do formulário para o usuário.

Também é necessário que o administrador possa ver na tela de edição do curso uma listagem com os dados (Nome, e-mail, data e hora) dos interessados naquele curso. Na tela de listagem dos cursos na administração do WordPress seria interessante a inclusão de uma coluna para mostrar o número de interessados em cada curso.

**Requisitos Avaliados:**:

* Funcionalidade
* Uso correto de hooks, funções e classes do WordPress
* Segurança
* Performance
* Organização de Código

## Instruções

1. Efetue o fork deste repositório e crie um branch com o seu nome e sobrenome. (exemplo: joao-santos)
2. Após finalizar o desafio, crie um Pull Request.
3. Aguarde alguem da nossa equipe realizar o code review.

## Pré-requisitos

* PHP >= 7.4
* WordPress mais recente quando da data da realização do desafio
* Orientado a objetos

## Dúvidas

Em caso de dúvidas, crie uma issue.
