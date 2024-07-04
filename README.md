# Animeland V2

Bem-vindo ao projeto Animeland V2! Este projeto visa criar um servidor de animes usando Docker para facilitar o desenvolvimento e a execução do ambiente de desenvolvimento.

## Como Rodar o Projeto

Para começar a contribuir, siga os passos abaixo:

### Pré-requisitos

- **Docker**: Certifique-se de ter o Docker instalado e configurado em sua máquina. Para instalar o Docker, siga as instruções específicas para o seu sistema operacional em [Docker Documentation](https://docs.docker.com/get-docker/).

### Configuração do Ambiente

1. **Clone o repositório**:
    ```bash
    git clone https://github.com/joaoGabrielMendes/animelandv2.git
    cd animelandv2
    ```

2. **Construa as imagens Docker**:
    ```bash
    docker-compose build
    ```

3. **Inicie os containers**:
    ```bash
    docker-compose up
    ```

4. **Acesse a aplicação**:
    Abra seu navegador e visite [http://localhost:8080](http://localhost:8080) para visualizar a interface do servidor de animes.

## Estrutura do Projeto

O projeto está estruturado da seguinte forma:

- **php**: Serviço que hospeda a aplicação PHP, configurada para se conectar a um banco de dados PostgreSQL.
- **nginx**: Servidor web Nginx que atua como proxy reverso para o serviço PHP e serve os arquivos estáticos.
- **postgres**: Banco de dados PostgreSQL para armazenar os dados relacionados aos animes.
- **elasticsearch**: Elasticsearch para recursos de busca avançada, como pesquisa textual.

## Como Usar a Interface (Ainda em Desenvolvimento)

Atualmente, estamos trabalhando no desenvolvimento de uma interface administrativa para facilitar a adição e gerenciamento de animes no Animeland V2. Abaixo estão os passos básicos para acessar e utilizar esta funcionalidade:

### Acesso ao Admin Dashboard

1. Após iniciar o projeto conforme descrito na seção [Como Rodar o Projeto](#como-rodar-o-projeto), abra seu navegador e vá para:
   ```
   http://localhost/admin/dashboard
   ```

2. Você será redirecionado para a interface administrativa, onde poderá realizar diversas ações relacionadas aos animes, como adicionar novos títulos, editar informações existentes, e muito mais.

a está melhor estruturado e organizado, proporcionando uma visão clara de como começar a trabalhar com o projeto Animeland V2 e como utilizar a interface administrativa em desenvolvimento.
