#!/bin/bash

# Perguntar o nome da instalação
read -p "Digite o nome da instalação (padrão: SGTOPO): " NOME_INSTALACAO
NOME_INSTALACAO=${NOME_INSTALACAO:-SGTOPO}

# Perguntar o diretório de destino
read -p "Digite o diretório de destino (padrão: /sistema/sistemas/): " dirBaseDestino
dirBaseDestino=${dirBaseDestino:-/sistema/sistemas/}

dirDestino="$dirBaseDestino$NOME_INSTALACAO/"

# Perguntar o diretório de origem (onde está o backup)
read -p "Digite o diretório de origem dos arquivos de instalação (padrão: /sistema/sistemas/Backup/): " dirOrigem
dirOrigem=${dirOrigem:-/sistema/sistemas/Backup/}

# Buscar o backup mais recente do sistema
cd "$dirOrigem"
LATEST_BACKUP=$(ls -t *.tar.gz 2>/dev/null | head -1)

if [ -z "$LATEST_BACKUP" ]; then
    echo "Nenhum backup do sistema encontrado em $dirOrigem!"
    exit 1
fi

echo "Backup do sistema encontrado: $LATEST_BACKUP"

# Perguntar configurações do Banco de Dados
read -p "Digite o nome do banco de dados (padrão: $NOME_INSTALACAO): " DB_NAME
DB_NAME=${DB_NAME:-$NOME_INSTALACAO}

read -p "Digite o usuário do banco de dados (padrão: root): " DB_USER
DB_USER=${DB_USER:-root}

read -sp "Digite a senha do banco de dados: " DB_PASSWORD
echo ""

read -p "Digite o host do banco de dados (padrão: localhost): " DB_HOST
DB_HOST=${DB_HOST:-localhost}

dirCorrente=$(pwd)

# Criar diretório de instalação, se não existir
echo "Criando diretório do sistema em: $dirDestino"
mkdir -p "$dirDestino"

# Restaurar arquivos do sistema
echo "Extraindo arquivos..."
tar -xzpvf "$dirOrigem/$LATEST_BACKUP" -C "$dirDestino"

echo "Arquivos do sistema restaurados com sucesso em $dirDestino!"

# Verificar e instalar dependências essenciais
echo "Verificando dependências..."
if ! command -v mysql &> /dev/null; then
    echo "MySQL não encontrado! Instalando..."
    sudo apt update && sudo apt install -y mysql-client
fi

if ! command -v php &> /dev/null; then
    echo "PHP não encontrado! Instalando..."
    sudo apt update && sudo apt install -y php
fi

# Perguntar se deseja restaurar o banco de dados
read -p "Deseja restaurar o banco de dados? (s/n) " RESTAURAR_DB
if [[ "$RESTAURAR_DB" =~ ^[Ss]$ ]]; then
    # Buscar o backup mais recente do banco de dados
    LATEST_DB_BACKUP=$(ls -t *.sql.gz 2>/dev/null | head -1)

    if [ -z "$LATEST_DB_BACKUP" ]; then
        echo "Nenhum backup de banco de dados encontrado em $dirOrigem!"
        exit 1
    fi

    echo "Backup do banco encontrado: $LATEST_DB_BACKUP"

    # Criar banco de dados, se não existir
    echo "Criando banco de dados: $DB_NAME"
    mysql -u$DB_USER -p$DB_PASSWORD -h $DB_HOST -e "CREATE DATABASE IF NOT EXISTS $DB_NAME;"

    # Remover `USE` e `CREATE DATABASE` do backup antes de restaurar
    echo "Preparando backup para importação..."
    gunzip -c "$dirOrigem/$LATEST_DB_BACKUP" | sed -E '/^USE /d; /^CREATE DATABASE /d' > "$dirOrigem/cleaned_db.sql"

    # Restaurar banco de dados
    echo "Restaurando banco de dados..."
    mysql -u$DB_USER -p$DB_PASSWORD -h $DB_HOST $DB_NAME < "$dirOrigem/cleaned_db.sql"

    if [ $? -eq 0 ]; then
        echo "Banco de dados $DB_NAME restaurado com sucesso!"
    else
        echo "Erro ao restaurar o banco de dados!"
    fi

    # Remover arquivo temporário
    rm -f "$dirOrigem/cleaned_db.sql"
fi

# Configurar permissões do sistema
echo "Ajustando permissões..."
chown -R $USER:$USER "$dirDestino"
chmod -R 755 "$dirDestino"

cd "$dirCorrente"
echo "Instalação concluída com sucesso!"
echo "O sistema foi instalado em: $dirDestino"
echo "Banco de dados utilizado: $DB_NAME"
