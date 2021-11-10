# Plugin Lumertz Express

Lumertz é uma floricultura localizada na cidade de Porto Alegre-RS.

O Plugin será responsável pela implementação do sistema de agendamento de entregas. As opções de agendamento ficaram disponíveis no checkout com base em datas e horários configurados a partir da dashboard admin. Datas e horários poderam ser "linkadas" a respectiva classe de entrega. 

Na dashboard o administrador poderá configurar datas, horários e adicionar classes de entrega. Também será possível setar qual classe de entrega estará habilitada por data e horário.

### Por exemplo. suponhamos que sejam dois tipos/classes de entrega:
- Expressa: Entrega em até 3 horas.
    - Período: 09:00 AM - 18:00 PM
    - Valor: R$10,00
    > Disponível para agendamento de no mínimo um dia antes.
- Comercial: Sem tempo definido
    - Período: 09:00 AM - 18:00 PM
    - Valor: 00,00(Grátis)

> Classes de entrega disponíveis apenas nas cidades de Porto Alegre-RS e Alvorada-RS.

## Características do sistema
* Interface para configuração de datas e horários
* Adição de Classes de entrega Woocommerce
* Integração entre classes de entrega e datas/horários
* Alterações no front-end da página de Checkout

## Instalação
1) Faça o upload no diretório ou instale o plugin de forma comum pelo painel do wordpress

## Documentações
* [WP Plugin Handbook](https://developer.wordpress.org/plugins/)
* [Woocommerce Documentation](https://woocommerce.com/documentation/)
* [Framework Front-End UiKit](https://getuikit.com/docs/introduction)

-----------

* Contributors: @jnz93
* Tags: #realstate, #importproperties
* Requires at least: 3.0.1
* Tested up to: 3.4
* Stable tag: 4.3
* License: GPLv2 or later
* License URI: http://www.gnu.org/licenses/gpl-2.0.html
