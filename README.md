
# Desafio Leadster

Bem-vindo ao repositório do desafio técnico de da empresa Gosat.

![App Screenshot](https://www.gosat.org/wp-content/uploads/2022/03/gosat-logo-1.png)



# Descrição do Projeto

O projeto em questão foi desenvolvido com Laravel sails e tinha como objetivo consumir uma API. O fluxo do projeto consistia em receber o CPF do usuário e enviar uma requisição para a API, que retornava as possíveis instituições de crédito e o tipo de modalidade disponíveis para o usuário.

Após receber essas informações, era necessário fazer outra requisição para um endpoint específico da API, passando o CPF, o ID da instituição e a modalidade de crédito selecionada. A finalidade dessa requisição era obter informações detalhadas sobre o crédito, tais como o valor a ser pago, taxa de juros e limites do crédito por último tinhamos que salvar esses dados numa base de dados.

Posteriormente, como parte do projeto, era necessário criar uma API que retornasse os três melhores resultados para o usuário, seguindo uma regra de negócio definida por nós. Essa regra de negócio estabelecia critérios específicos para a seleção das melhores opções de crédito, levando em consideração fatores como taxa de juros, valor a ser pago e limites do crédito. Por último temos de salvar esses dados numa base de dados de forma a persistirem.

Em resumo, o projeto desenvolvido em Laravel tinha como objetivo principal consumir uma API, utilizando o CPF do usuário como parâmetro, e retornar informações sobre as instituições de crédito disponíveis, bem como detalhes sobre as melhores opções de crédito com base em uma regra de negócio predefinida.




# Estrutura das rotas

**Rota**: http://0.0.0.0/api/offers/cpf

**Método**: POST

![App Screenshot](https://i.ibb.co/zsdvKzF/image.png)

**Descrição:**  Retorna as possíveis instituições de crédito e o tipo de modalidade disponíveis para o usuário, com base no CPF fornecido. Os dados também são salvos na base de dados para referência futura.


**Rota**: http://0.0.0.0/api/offer/details

**Método**: POST

![App Screenshot](https://i.ibb.co/pxSN9SX/image.png)

**Descrição:** 
Recebe o CPF, o ID da instituição e a modalidade de crédito selecionada. Essa rota busca informações detalhadas sobre o crédito, como o valor a ser pago, taxa de juros e limites do crédito. Em seguida, salva essas informações na base de dados para uso posterior.

**Rota**: http://0.0.0.0/api/offers/taxes

**Método**: POST

![App Screenshot](https://i.ibb.co/Kr8M2Pj/image.png)

**Descrição:**  Utiliza as ofertas gravadas na base de dados para calcular um valor médio de crédito (máximo valor de crédito somado ao menor valor de crédito) e para as parcelas. Em seguida, retorna os três registros com as menores taxas de juros, valor do empréstimo e valor a ser pago.

**Rota**: http://0.0.0.0/api/offers/credit

**Método**: POST

![App Screenshot](https://i.ibb.co/pfJB4rH/image.png)

**Descrição:**  Utiliza as ofertas gravadas na base de dados para calcular um valor médio de crédito (máximo valor de crédito somado ao menor valor de crédito) e para as parcelas. Em seguida, retorna os três registros com os maiores valores de crédito disponíveis, juntamente com as taxas de juros, valor do empréstimo e valor a ser pago.

**Rota**: http://0.0.0.0/api/offers/parcel

**Método**: POST

![App Screenshot](https://i.ibb.co/tqfYdcV/image.png)

**Descrição:**  Utiliza as ofertas gravadas na base de dados para calcular um valor médio de crédito (máximo valor de crédito somado ao menor valor de crédito) e para as parcelas. Em seguida, retorna os três registros com o menor número de parcelas a serem pagas, juntamente com as taxas de juros, valor do empréstimo e valor a ser pago.

**Rota**: http://0.0.0.0/api/offers

**Método**: POST

![App Screenshot](https://i.ibb.co/4pTnMFF/image.png)

**Descrição:**  Acessível via interface web, essa rota recebe um CPF como parâmetro e retorna as três melhores ofertas com a menor taxa de juros, as três melhores ofertas com o maior crédito disponível e as três melhores ofertas com o menor número de parcelas, com base nas ofertas gravadas na base de dados.

## Rodando localmente

### Antes de começar

Clone o projeto

```bash
  git clone git@github.com:FranciscoCosta/gosat.git
```

Entre no diretório do projeto

```bash
  cd gosat
```
Execute o seguinte comando para instalar as dependência do composer:

```bash
  composer install
```

Altere o nome de **.env.example**  para -> **.env**

Execute o seguinte comando para iniciar os contêineres do Laravel Sail:

```bash
  ./vendor/bin/sail up
```

Em caso de erro "Failed to open stream: Permission denied The exception occurred while attempting to log" pare a execução com CTR + C e execute o comando: 

```bash
  sudo chmod o+w ./storage/ -R
```

Volte a execute o seguinte comando para iniciar os contêineres do Laravel Sail:

```bash
  ./vendor/bin/sail up
```

Rodar a interface abra o seu navegador e coloque a seguinte rota: 

```bash
 http://localhost/
```




## Autor

- [Francisco Costa](https://github.com/FranciscoCosta/)

