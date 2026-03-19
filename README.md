🥖 Vitrine de Padaria Cloud-Native

Meu Primeiro Contato com AWS & Linux
Este projeto documenta minha jornada de aprendizado prático, saindo do zero absoluto no Linux e na AWS. Desenvolvi um sistema CRUD (Create, Read, Update, Delete) para uma vitrine de padaria, utilizando uma arquitetura baseada em desacoplamento de storage.

🎯 O Desafio

O objetivo era construir uma aplicação funcional para cadastro de produtos com fotos. O detalhe crucial: as imagens não poderiam ficar armazenadas no servidor local (Amazon EC2); elas deveriam ser enviadas e recuperadas de forma segura através do Amazon S3.

🛠️ Tecnologias e Ferramentas

Cloud: AWS (EC2 e S3).
Sistema Operacional: Amazon Linux 2023.
Servidor Web: Apache (httpd).
Linguagem: PHP 8.x + AWS CLI.
IA Aided Development: Utilizei IA para auxiliar no diagnóstico de erros de infraestrutura e depuração de logs.

🧠 Aprendizados de Infraestrutura (Troubleshooting)

Como este foi meu primeiro contato com Linux e Cloud, enfrentei desafios fundamentais que moldaram minha visão sobre nuvem:

Segurança com IAM Roles:
Aprendi a importância de não expor credenciais (Access Keys) no código. Configurei uma IAM Role anexada à instância EC2, permitindo que o servidor se autentique no S3 de forma automática e segura seguindo o princípio de menor privilégio.

Vencendo o SELinux:
Enfrentei bloqueios onde o Apache não conseguia executar comandos externos. Aprendi a analisar logs em /var/log/httpd/error_log, entender o comportamento do SELinux (módulo de segurança do kernel) e ajustar as permissões do sistema.

Sanitização e Shell Scripting:
Entendi como o Linux lida com sistemas de arquivos. Implementei lógica em PHP para tratar nomes de arquivos (remover acentos e espaços), evitando erros de "path does not exist" na integração com o S3.

Gestão de Permissões:
Dominei comandos essenciais de administração de sistemas, como chmod e chown para permissões de pastas, e systemctl para gestão de serviços.

🚀 Funcionalidades
Upload Direto: Fotos enviadas via formulário são processadas e armazenadas no bucket S3.
Sincronização Cloud-Native: A vitrine consome os objetos diretamente da nuvem, garantindo que o servidor web permaneça stateless.
Interface Responsiva: Cards de produtos que se adaptam a diferentes dispositivos.

💡 Visão de Futuro
Mais do que "fazer um site", este projeto foi sobre entender como as peças de uma infraestrutura escalável se encaixam. Como desenvolvedor em início de carreira, meu foco é dominar a fundação da nuvem para construir soluções cada vez mais robustas e seguras.
