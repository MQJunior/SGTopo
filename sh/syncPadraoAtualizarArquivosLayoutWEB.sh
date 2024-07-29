#!/bin/bash
NOME_ARQUIVO='SGPadraoLayoutWEBUpdate'
HostServidor='kromus.com.br'
UserServidor='kromusco'
senhaServidor='k6Ro0o53Js'
dirOrigem='/sistema/www/Layout/'
dirDestino='/home/kromusco/z2.eti.br/Layout/'
dirCorrente=$(pwd)

cd $dirOrigem

echo 'Compactando...'
find . -iname "*.*" -mtime -90  -exec tar -prvf "$NOME_ARQUIVO".tar {} \;
rm "$NOME_ARQUIVO".tar.gz;
gzip "$NOME_ARQUIVO".tar;

echo 'Enviando ...';
sshpass -p "$senhaServidor" ssh -oStrictHostKeyChecking=no $UserServidor@$HostServidor "cd $dirDestino; rm $NOME_ARQUIVO.tar.gz; rm $NOME_ARQUIVO.tar"
sshpass -p "$senhaServidor" scp "$NOME_ARQUIVO".tar.gz $UserServidor@$HostServidor:$dirDestino

echo 'Descompactando...'
sshpass -p $senhaServidor ssh -oStrictHostKeyChecking=no  $UserServidor@$HostServidor "cd $dirDestino ; gunzip $NOME_ARQUIVO.tar.gz; tar -pxvf $NOME_ARQUIVO.tar; chgrp $UserServidor * -Rf; chmod 755 * -R;"
cd $dirCorrente
echo 'Pronto.'
