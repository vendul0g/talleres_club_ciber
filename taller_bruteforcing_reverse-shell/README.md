# Usage
Para poder montar el docker seguimos los siguientes pasos
1. Construcción de la imagen docker
```
docker build -t taller2 .
```

2. Ejecutamos el contenedor
```
docker run -dit --name taller2 taller2
```

3. Comprobamos que se ejecuta correctamente
```
docker ps
```

4. Comprobamos qué interfaz ha cogido el docker. Normalmente suele ser la `172.17.0.0/24` y se asigna la IP `172.17.0.2`

En caso de no ser esta red, podemos ejecutar el comando `ifconfig` para buscar la interfaz en la que se ha creado
