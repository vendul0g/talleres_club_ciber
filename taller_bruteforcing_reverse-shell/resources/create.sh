#!/bin/bash

# Nombre del nuevo usuario y contraseña deseada
uss="javier"
pass="fuckyou"
path="/home/$nuevo_usuario/private_directory"

# Crear el nuevo usuario
#useradd -m $uss

# Asignarle una contraseña
#echo "$uss:$pass" | passwd

useradd -m -p "$(openssl passwd -6 $pass)" $uss

# Crear un directorio privado en /home
mkdir -p $path
chown $uss:$uss $path
chmod 700 $path

