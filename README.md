

# Documentación

Enlaces de autenticación y gestión de empleados, categorías y publicaciones

### Referencia

#### Registrarse

```http
POST /api/register
```

| Parámetro | Tipo     | Descripción            |
| :-------- | :------- | :------------------------- |
| `name` | `string` | Nombres |
| `email` | `string` | Correo electrónico único |
| `password` | `string` | Contraseña |

#### Iniciar sesión

```http
POST /api/login
```

| Parámetro | Tipo     | Descripción            |
| :-------- | :------- | :------------------------- |
| `email` | `string` | Correo electrónico único |
| `password` | `string` | Contraseña |

#### Refrescar tokens

```http
POST /api/refresh
```

#### Empleados

```http
RESOURCE /api/employees
```

#### Categorías

```http
RESOURCE /api/categories
```

#### Publicaciones

```http
RESOURCE /api/posts
```

#### Cerrar sesión

```http
POST /api/logout
```

