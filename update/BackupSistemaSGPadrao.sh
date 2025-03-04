#!/bin/bash
NOME_ARQUIVO='SGPADRAO'
UserServidor='sistema'
dirOrigem='/sistema/sistemas/SGPadrao/'
dirDestino='/sistema/sistemas/Backup/'
dirCorrente=$(pwd)

cd $dirOrigem

echo 'Compactando...'

rm "$NOME_ARQUIVO".tar;
find . -type f \( -iname "*" ! -path "./tmp/*" ! -path "./.git/*" \) -exec tar -prvf "$NOME_ARQUIVO".tar {} \;


rm "$NOME_ARQUIVO".tar.gz;
gzip "$NOME_ARQUIVO".tar;

#echo 'Enviando ...';
cd $dirDestino; rm $NOME_ARQUIVO.tar.gz; rm $NOME_ARQUIVO.tar

cd $dirOrigem
cp "$NOME_ARQUIVO".tar.gz $dirDestino
rm "$NOME_ARQUIVO".tar.gz;

cd $dirCorrente;
echo 'Pronto.'
