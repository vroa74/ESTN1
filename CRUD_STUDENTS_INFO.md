# CRUD de Estudiantes (Students)

## ✅ Archivos Creados

### 1. **Migración**
- `database/migrations/2025_10_11_181313_create_students_table.php`
- **Estado**: ✅ Ejecutada

#### Campos de la tabla `students`:
- `id` - ID único autoincremental
- `matricula` - Matrícula del estudiante (nullable, unique)
- `grado` - Grado del estudiante (1-9, nullable)
- `grupo` - Grupo (enum: A-L, mayúsculas)
- `Fnom` - Campo Fnom (nullable)
- `nombres` - Nombres del estudiante (nullable)
- `apa` - Apellido paterno (nullable)
- `ama` - Apellido materno (nullable)
- `fnac` - Fecha de nacimiento (nullable)
- `curp` - CURP (18 caracteres, nullable, unique)
- `sexo` - Sexo (enum: F, M, default: F)
- `sex` - Sexo booleano (default: 1 = masculino)
- `email` - Email (nullable, unique)
- `telefono` - Teléfono (nullable)
- `estatus` - Estatus (enum: activo, inactivo, egresado, baja, default: activo)
- `observaciones` - Observaciones (text, nullable)
- `status` - Estado activo/inactivo (boolean, default: 1)
- `timestamps` - created_at, updated_at

---

### 2. **Modelo**
- `app/Models/Student.php`

#### Características:
- **Fillable**: Todos los campos configurados
- **Casts**: Conversión automática de fechas y booleanos
- **Relaciones**:
  - `hasMany(Bitacora::class)` - Relación con bitácoras
- **Accessor**: 
  - `getFullNameAttribute()` - Retorna nombre completo del estudiante

---

### 3. **Controlador Resource**
- `app/Http/Controllers/StudentController.php`

#### Métodos implementados:

| Método | Ruta | Descripción |
|--------|------|-------------|
| `index()` | GET /students | Lista todos los estudiantes (ordenados por grado, grupo, apellido) |
| `create()` | GET /students/create | Formulario para crear estudiante |
| `store()` | POST /students | Guarda un nuevo estudiante |
| `show($id)` | GET /students/{id} | Muestra detalles de un estudiante |
| `edit($id)` | GET /students/{id}/edit | Formulario para editar estudiante |
| `update($id)` | PUT/PATCH /students/{id} | Actualiza un estudiante |
| `destroy($id)` | DELETE /students/{id} | Elimina un estudiante |

#### Validaciones implementadas:
- Matrícula: única, máximo 20 caracteres
- Grado: entre 1 y 9
- Grupo: debe ser A-L (mayúsculas)
- CURP: 18 caracteres exactos, único
- Email: formato email, único
- Sexo: F o M

---

### 4. **Vistas Blade**

#### `resources/views/admin/students/index.blade.php`
- Lista de estudiantes con paginación
- Tabla responsiva con dark mode
- Botones de acción: Ver, Editar, Eliminar
- Indicadores de estado con colores
- Mensajes de éxito/error

#### `resources/views/admin/students/create.blade.php`
- Formulario completo para crear estudiante
- Organizado en secciones:
  - Información Básica
  - Datos Personales
  - Datos de Contacto
  - Estado y Observaciones
- Validación del lado del cliente
- Dark mode compatible

#### `resources/views/admin/students/edit.blade.php`
- Formulario de edición pre-llenado
- Misma estructura que create
- Validación de campos únicos considerando el registro actual

#### `resources/views/admin/students/show.blade.php`
- Vista detallada del estudiante
- Información organizada por secciones
- Botones de acción: Editar, Volver, Eliminar
- Badges de estado con colores
- Información de timestamps

---

### 5. **Rutas**
Agregadas en `routes/web.php`:

```php
Route::resource('students', StudentController::class)->names('students');
```

#### Rutas disponibles:

| Método | URI | Nombre | Acción |
|--------|-----|--------|--------|
| GET | /students | students.index | Listar estudiantes |
| POST | /students | students.store | Crear estudiante |
| GET | /students/create | students.create | Formulario crear |
| GET | /students/{student} | students.show | Ver estudiante |
| PUT/PATCH | /students/{student} | students.update | Actualizar estudiante |
| DELETE | /students/{student} | students.destroy | Eliminar estudiante |
| GET | /students/{student}/edit | students.edit | Formulario editar |

---

## 🎨 Características del CRUD

### ✅ Funcionalidades implementadas:
- ✅ Paginación (15 registros por página)
- ✅ Ordenamiento por grado, grupo y apellido
- ✅ Validación completa en backend
- ✅ Mensajes de éxito/error
- ✅ Confirmación antes de eliminar
- ✅ Dark mode completo
- ✅ Diseño responsivo (mobile-first)
- ✅ Componentes reutilizables de Laravel
- ✅ Indicadores visuales de estado
- ✅ Formularios organizados por secciones
- ✅ Manejo de errores de validación

### 🎨 UI/UX:
- Tailwind CSS para estilos
- Iconos SVG para acciones
- Badges de colores para estados
- Transiciones suaves
- Layout consistente con el resto del sistema

---

## 🚀 Uso

### Acceder al CRUD:
```
http://localhost/students
```

### Crear un estudiante:
1. Acceder a `/students`
2. Click en "Crear Estudiante"
3. Llenar el formulario
4. Click en "Crear Estudiante"

### Editar un estudiante:
1. Acceder a `/students`
2. Click en el icono de editar (lápiz)
3. Modificar los campos necesarios
4. Click en "Actualizar Estudiante"

### Ver detalles:
1. Acceder a `/students`
2. Click en el icono de ver (ojo)

### Eliminar estudiante:
1. Acceder a `/students`
2. Click en el icono de eliminar (papelera)
3. Confirmar la eliminación

---

## 📊 Base de Datos

### Estado de las migraciones:
```
✅ 2025_10_11_181313_create_students_table - Ejecutada
✅ 2025_10_11_181326_create_bitacoras_table - Ejecutada
```

### Relaciones:
- `students` → `bitacoras` (hasMany)
- Los registros de bitácoras se eliminarán en cascada si se elimina un estudiante

---

## 🔒 Seguridad

- Todas las rutas están protegidas con middleware `auth:sanctum` y `verified`
- Validación en backend para todos los datos
- Confirmación antes de eliminar registros
- Protección CSRF en formularios
- Campos únicos validados (matrícula, CURP, email)

---

## 📝 Notas Adicionales

### Grupos disponibles:
A, B, C, D, E, F, G, H, I, J, K, L (MAYÚSCULAS)

### Estados de estudiante:
- **activo**: Estudiante actualmente inscrito
- **inactivo**: Estudiante temporalmente inactivo
- **egresado**: Estudiante que ha completado sus estudios
- **baja**: Estudiante que ha causado baja

### Campos booleanos:
- `status`: 1 = activo, 0 = inactivo (estado general)
- `sex`: 1 = masculino, 0 = femenino (por convención)

---

## 🎯 Próximos pasos sugeridos:

1. Agregar búsqueda y filtros en la lista de estudiantes
2. Exportar a Excel/PDF
3. Importar estudiantes masivamente (CSV/Excel)
4. Sistema de fotografías para estudiantes
5. Historial de cambios usando la tabla bitacoras
6. Reportes estadísticos por grado/grupo
7. API REST para integración con otros sistemas

---

**Fecha de creación**: 11 de octubre de 2025
**Estado**: ✅ Completado y funcional

