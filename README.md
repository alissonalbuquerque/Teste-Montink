
<div style="display:flex; justify-content:center;">
    <a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a>
</div>

## Teste Técnico - Mini ERP

- O teste consiste em Criar mini ERP para controle de Pedidos, Produtos, Cupons e Estoque

## Tecnologia

- [x] **8.2**
- [x] **MySQL**
- [x] **Bootstrap**
- [x] **Laravel 12**

## Instruções : Rodar o Projeto



## Instruções

- []⁠ Crie um banco de dados com 4 tabelas: pedidos, produtos, cupons, estoque
- []⁠ ⁠Crie uma tela simples, que permita a criação de produtos, com as seguintes informações: Nome, Preço, Variações e Estoque. O resultado do cadastro, deve gerar associações entre as tabelas produtos e estoques.
- [] Permitir o cadastro de variações, e o controle de seus estoques, é um bônus.
- [] ⁠Na mesma tela, permita a opção de update dos dados do produto e do estoque.
- [] ⁠Com o produto salvo, adicione na mesma tela um botão de Comprar. Ao clicar nesse botão, gerencie um carrinho em sessão, controlando o estoque e valores do pedido. Caso o subtotal do pedido tenha entre R$52,00 e R$166,59, o frete do pedido deve ser R$15,00. Caso o subtotal seja maior que R$200,00, frete grátis. Para outros valores, o frete deve custar R$20,00.
- [] ⁠Adicione uma verificação de CEP, utilizando o https://viacep.com.br/

## Adicionais

•⁠  ⁠Crie cupons que podem ser gerenciados por uma tela ou migração. Os cupons devem ter validade e regras de valores mínimos baseadas no subtotal do carrinho.

•⁠  ⁠Adicione um script de envio de e-mail ao finalizar o pedido, com o endereço preenchido pelo cliente.

•⁠  ⁠Crie um webhook que receberá o ID e o status do Pedido. Caso o status seja cancelado, remova o pedido. Caso o status seja outro, atualize o status em seu pedido.

## Considerações
•⁠  ⁠A parte visual não será eliminatória, mas uma boa visualização contará pontos

•⁠  ⁠Utilize MVC, código limpo e boas práticas. Código simples e prático, que resolva o problema e tenha fácil manutenção. Cuidado com o Overengineering.

•⁠  ⁠Durante o desenvolvimento, pense em situações corriqueiras que podem acontecer com sua aplicação, e preveja possíveis situações