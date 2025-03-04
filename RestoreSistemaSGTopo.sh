#!/bin/bash

NOME_ARQUIVO="SGTOPO"
dirDestino="/sistema/sistemas/Backup/"
dirOrigem="/sistema/sistemas/SGTopo/"
dirCorrente=$(pwd)

# Configurações do Banco de Dados
DB_USER="sistema"
DB_PASSWORD="Qaz951357!"
DB_NAME="SGTopo"
DB_HOST="localhost"

# Restaurar arquivos do sistema
echo "Restaurando arquivos do sistema..."
cd "$dirDestino"

# Pegando o último backup do sistema
LATEST_BACKUP=$(ls -t "$NOME_ARQUIVO"*.tar.gz 2>/dev/null | head -1)

if [ -z "$LATEST_BACKUP" ]; then
    echo "Nenhum backup de sistema encontrado!"
    exit 1
fi

echo "Usando o backup: $LATEST_BACKUP"
tar -xzpvf "$LATEST_BACKUP" -C "$dirOrigem"

echo "Arquivos do sistema restaurados com sucesso!"

# Restaurar banco de dados
echo "Restaurando banco de dados..."

# Pegando o último backup do banco
LATEST_DB_BACKUP=$(ls -t "$NOME_ARQUIVO"-db.sql.gz 2>/dev/null | head -1)

if [ -z "$LATEST_DB_BACKUP" ]; then
    echo "Nenhum backup de banco de dados encontrado!"
    exit 1
fi

echo "Usando o backup do banco: $LATEST_DB_BACKUP"

# Descompactar e restaurar
gunzip -c "$LATEST_DB_BACKUP" | mysql -u$DB_USER -p$DB_PASSWORD -h $DB_HOST $DB_NAME

if [ $? -eq 0 ]; then
    echo "Banco de dados restaurado com sucesso!"
else
    echo "Erro ao restaurar o banco de dados!"
fi

cd "$dirCorrente"
echo "Restore concluído."
