#!/bin/bash -e
if test $# -eq 0
then
  echo "commit.sh: Meteme el mensaje para el comit entre comillas dobles \"\" "
  exit

else
  if test $# -gt 1
  then
    echo "demasiados argumentos"
    exit
  fi
fi

#echo $1
u=vendul0g
echo "Desafío:"

#Inicializamos
p=''
cmp='16670c18ae6b891d1c82351809c9fba7f069c1a95893e7b48a6df9ea74b1df39  -'

#Leemos la contraseña
read -p "Intoduce la contraseña del token github... " -s p

#Creamos el hash
h=$(echo -n "$p" | sha256sum)

#Comparamos
if [ "$h" != "$cmp" ]; then
	echo "KO"
	exit
fi
echo "OK"

#Token github
tc="U2FsdGVkX19pgHtNef9px3Yb2qZsgq9Pd+pMyb0bzWQfiX+pYsrnfmOpcUHCHHYh
mEq/GTIBH1xGRiMe5JVSIQ=="

echo $tc
#cifrado tc con:
#tc=$(echo -n "$cadena_a_cifrar" | openssl enc -aes-256-cbc -a -k "$clave" -pbkdf2)


#Desciframos
token=$(echo -n "$tc" | openssl enc -d -aes-256-cbc -a -k "$p" -pbkdf2)
#echo $token

# realizamos el commit
git add -A
git commit -m "$1"



# Arrancamos expect
./push.sh $u $token
