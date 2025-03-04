#!/bin/bash
NOME_ARQUIVO='SGTOPO'
UserServidor='sistema'
dirOrigem='/sistema/sistemas/SGTopo/'
dirDestino='/sistema/sistemas/Backup/'
dirCorrente=$(pwd)
TELEGRAM_BOT_TOKEN="7542505813:AAEMO-MVZ5NXNVW_c9SipYVpfpjkscNiSWE"
TELEGRAM_CHAT_ID="-1002392426350"

# Configurações do Banco de Dados
DB_USER="sistema"
DB_PASSWORD="Qaz951357!"
DB_NAME="SGTopo"
DB_HOST="localhost"

# Criar diretório de backup se não existir
mkdir -p "$dirDestino"

# Fazer backup do banco de dados
echo "Realizando backup do banco de dados..."
mysqldump -u$DB_USER -p$DB_PASSWORD -h $DB_HOST --databases $DB_NAME | gzip > "$dirDestino$NOME_ARQUIVO-db.sql.gz"

echo "Compactando arquivos do sistema..."

cd "$dirOrigem"

# Remover backup mais antigo se houver mais de dois
cd "$dirDestino"
NUM_BACKUPS=$(ls -t "$NOME_ARQUIVO"*.tar.gz 2>/dev/null | wc -l)

if [ "$NUM_BACKUPS" -ge 2 ]; then
    OLDEST_FILE=$(ls -t "$NOME_ARQUIVO"*.tar.gz | tail -1)
    echo "Removendo backup antigo: $OLDEST_FILE"
    rm -f "$OLDEST_FILE"
fi

# Criar novo backup do sistema
cd "$dirOrigem"
rm -f "$NOME_ARQUIVO".tar
find . -type f \( -iname "*" ! -path "./tmp/*" ! -path "./.git/*" ! -path "./Backup/*" \) -exec tar -prvf "$NOME_ARQUIVO".tar {} \;

rm -f "$NOME_ARQUIVO".tar.gz
gzip "$NOME_ARQUIVO".tar

# Mover arquivos para o diretório de backup
mv "$NOME_ARQUIVO".tar.gz "$dirDestino"

cd "$dirCorrente"
echo "Backup concluído."

# Enviar backup do banco para o Telegram
echo "Enviando backup do banco de dados para o Telegram..."
curl -F "chat_id=$TELEGRAM_CHAT_ID" -F document=@"$dirDestino$NOME_ARQUIVO-db.sql.gz" "https://api.telegram.org/bot$TELEGRAM_BOT_TOKEN/sendDocument"

# Enviar backup do sistema para o Telegram
echo "Enviando backup do sistema para o Telegram..."
curl -F "chat_id=$TELEGRAM_CHAT_ID" -F document=@"$dirDestino$NOME_ARQUIVO.tar.gz" "https://api.telegram.org/bot$TELEGRAM_BOT_TOKEN/sendDocument"

echo "Backup enviado com sucesso!"
