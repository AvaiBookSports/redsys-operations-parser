# avaibooksports/redsys-operations-parser

> **Warning** - this is still alpha software and the public API is still subject
> to change. Please use at your own risk.

## Introducción

`avaibooksports/redsys-operations-parser` es un paquete capaz de interpretar
ficheros de remesas de varios bancos.

Al interpretar un fichero mediante su parser correspondiente, obtenemos una
colección de clases. Actualmente, hay un intérprete para cada banco soportado:

- BVA: `AvaiBookSports\Component\RedsysOperationsParser\Bbva\OperationsParser`
- Sabadell: `AvaiBookSports\Component\RedsysOperationsParser\Sabadell
\OperationsParser`

Ambas clases extienden la clase `AvaiBookSports\Component\RedsysOperationsParser
\AbstractOperation\AbstractFile`,
que contiene todos los campos comunes o similares entre ambos bancos. De este
modo, para implementar un modelo para un banco nuevo solamente implica añadir
los datos que no formen parte de la interface, y se puede garantizar una API
común entre todas las entidades.

Puedes encontrar la documentación del formato de cada banco soportado en
resources/docs

## Testing

`make ci` ejecuta todos los tipos de test para avisar de errores en el proyecto.
