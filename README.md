# Hotware

Descrição do projeto e funcionalidades.

## Pré-requisitos

Antes de executar o projeto, você precisará ter os seguintes requisitos instalados:

- **PHP** 8+
- **MySQL**
- **Redis**

## Configuração do Ambiente

1. Clone o repositório para sua máquina local:
   ```bash
   git clone <URL-do-repositório>
   ```

2. Navegue até o diretório do projeto:
   ```bash
   cd nome-do-projeto
   ```

3. Instale as dependências do Composer:
   ```bash
   composer install
   ```

4. Copie o arquivo `.env.example` para `.env`:
   ```bash
   cp .env.example .env
   ```

5. Gere a chave de aplicação:
   ```bash
   php artisan key:generate
   ```

6. Configure suas credenciais do banco de dados e outras variáveis no arquivo `.env`.

7. Execute as migrações para criar as tabelas no banco de dados:
   ```bash
   php artisan migrate
   ```

## Executando a Aplicação

Para rodar a aplicação, você precisará executar os seguintes comandos em terminais separados:

1. **Para processar filas**:
   ```bash
   php artisan queue:work
   ```

2. **Para iniciar o WebSocket**:
   ```bash
   php artisan websockets:serve
   ```

3. **Para construir os assets do frontend**: caso altere o arquivo que faz a
busca das mensagens no PUSHER que fica em resources/js/boogtstrap.js rode
   ```bash
   npm run build
   ```
3. ** Caso tenha problema em acesso aos arquivos gerados plo build 
verifique vite.confi.js e veja se ele esta gerando os arquivos .css e .js 
caso não esteja verifique se os arquivos não estão vazios

## Acesso

Após seguir os passos acima, você pode acessar a aplicação em seu navegador através do endereço `http://localhost`.

## COnfiguração

A sincronização de mensagens esta sendo feita com o PUSHER
para isso é preciso configurar as variaveis .env dessa forma exemplo:
```bash
PUSHER_APP_ID=1889545
PUSHER_APP_KEY=5e0f258ac3d04df29404
PUSHER_APP_SECRET=295baad241c29d184bec
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=sa1
   ```
Foi preciso descomentar o em config/app.php
```bash
App\Providers\BroadcastServiceProvider::class,
   ```

Precisamos criar um Job para executar um listener que faz o envio da mensagem ao PUSHER
```bash
QueueCompleted.php
   ```
## Licença

Informe a licença do projeto, se aplicável.
