**🥖 Vitrine de Padaria Cloud-Native**

**Arquitetura de Redes, Computação e Storage na AWS**
Este projeto documenta minha jornada de aprendizado prático, saindo do zero absoluto no Linux e na AWS. Desenvolvi um sistema CRUD para uma vitrine de padaria, focando no desacoplamento de recursos e no isolamento de rede para criar uma infraestrutura moderna e escalável.

⚠️** Nota do Projeto:** Implementado em ambiente Sandbox AWS, com ciclo de vida temporário (3 horas) para fins de laboratório e validação de arquitetura.

**🎯 O Desafio Técnico**

O objetivo era construir uma aplicação funcional onde o servidor web (Amazon EC2) permanecesse "limpo" (stateless). O detalhe crucial: as imagens não poderiam ocupar espaço no disco do servidor; elas deveriam ser enviadas, armazenadas e lidas diretamente de forma segura através do Amazon S3.

**🛠️ Tecnologias e Ferramentas**

Networking: AWS VPC (Subnets, Internet Gateway, Route Tables).
Computação: Amazon EC2 (Amazon Linux 2023).
Storage: Amazon S3 (Bucket de objetos).
Segurança: IAM Roles (Princípio de menor privilégio) e Security Groups.
Web Stack: Apache (httpd) + PHP 8.x + AWS CLI.
Acesso & Dev: PowerShell (SSH Nativo) e Editor Nano.

**⚙️ Implementação Passo a Passo (Hands-on)**

1. Fundação de Rede e Segurança

Em vez de usar a rede padrão, configurei uma VPC dedicada para isolar a aplicação:
Criação de Internet Gateway e Route Tables para gerenciar o tráfego.
Definição de Security Groups permitindo apenas as portas 80 (HTTP) e 22 (SSH restrito).
IAM Roles: Configurei uma Role anexada à EC2 para que o servidor se autenticasse no S3 automaticamente, eliminando o uso de senhas ou Access Keys no código.

3. Provisionamento e Setup via Terminal

Acesse o servidor via PowerShell e gerenciei o ambiente integralmente via linha de comando:
Instalação: sudo dnf install -y httpd php php-cli.
Gestão de Serviços: Configuração do Apache via systemctl para garantir a persistência.
Storage CLI: Criação e teste do bucket S3 via terminal para validar as permissões da Role.

4. Desenvolvimento "Terminal-First"

O código foi escrito no diretório /var/www/html utilizando o editor Nano.
Sanitização: Implementei lógica em PHP para tratar nomes de arquivos (removendo acentos e espaços), evitando erros de path no Linux/S3.
Sincronização Cloud-Native: O sistema processa o upload e utiliza o AWS CLI para mover o objeto para a nuvem.

**🧠 Aprendizados e Troubleshooting**

Como este foi meu primeiro contato com o ecossistema, enfrentei desafios fundamentais:
Vencendo o SELinux: O Apache inicialmente não conseguia executar comandos externos. Aprendi a analisar logs em /var/log/httpd/error_log e ajustar o estado do sistema para permitir as operações.
Gestão de Permissões: Visitei comandos de administração como chmod e chown para garantir que o servidor web pudesse manipular os diretórios necessários.
Ciclo de Vida Sandbox: Adaptação ao gerenciamento de tempo e recursos em um ambiente de laboratório com tempo limitado.

**🚀 Funcionalidades**

Upload Automático: Fotos enviadas via formulário vão direto para o bucket S3.
Arquitetura Stateless: A vitrine consome os objetos da nuvem, permitindo que o servidor seja descartado ou escalado sem perda de arquivos.
Interface Responsiva: Cards de produtos que se ajustam a qualquer tamanho de tela.

**💡 Visão de Futuro**
Este projeto não foi apenas sobre "fazer um site", mas sobre entender como as peças de uma infraestrutura escalável se encaixam. Mesclar e aplicar meus conhimentos, além de estar pela primeira vez, acrescentando algo ao meu portfólio.
