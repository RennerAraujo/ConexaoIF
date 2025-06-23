Projeto PIBIT Ultilando Laravel e Docker\
Configurações para windows e pré requisitos:
1. Abra o PowerShell como Administrador, digite e execute: wsl --install
2. Reinicie o computador.
3. Para verificar se foi instalado o wsl, execute novamente o power shell como administrador e digite: wsl --list --verbose, irá aparecer o programa e sua versão.
4. Baixe e instale o Git
5. Baixe e instale o Docker Desktop: https://www.docker.com/products/docker-desktop/
6. Relize a clonagem do repositório no terminal com:\
git clone https://github.com/RennerAraujo/ConexaoIF.git \
cd ConexaoIF
7. Suba os containers do Docker com o comando:\ 
docker compose up -d --build
8. Copie e configure o arquivo .env: copy src\.env.example src\.env \
notepad src\.env 
9. modifique o arquivo Adicionando:\
DB_CONNECTION=mysql\
DB_HOST=db\
DB_PORT=3306\
DB_DATABASE=laravel\
DB_USERNAME=laravel\
DB_PASSWORD=secret\
Feche e salve o arquivo.\
Execute os seguintes comandos no power shell:
docker compose exec app bash\
composer install\
php artisan key:generate\
exit\
docker compose exec app php artisan migrate\
Assim todas as dependências serão instaladas e os comandos de inicialização de servidor executado.\
O Docker é uma plataforma que cria ambientes isolados chamados containers, onde sua aplicação e todas as dependências são empacotadas em uma imagem imutável. Isso garante que, ao executar essa imagem em qualquer máquina com Docker, o software funcione da mesma forma, simplificando desenvolvimento, testes e implantação.
O docker simplifica o trabalho do programador, pois ele sabe o que e quando inciar algumas configurações, fazendo com que o programador não necessite realizar isso manualmente. Por exemplo o desenvolvedor deve ligar o mysql e realizar algumas configurações para iniciar o servidor e isso de forma manualmente. O docker faz isso de forma automática e rápida.
