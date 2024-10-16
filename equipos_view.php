<?php
include 'conexion.php';
$conexion = conexion();

// Obtener todos los equipos
$ssql = "SELECT * FROM equipos";
$result = $conexion->query($ssql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Equipos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include 'menu.php'; ?>

<div class="container">
    <h1>Gestión de Equipos</h1>
    
    <!-- Mostrar mensaje de éxito o error -->
    <?php if (isset($_GET['mensaje'])) { ?>
        <div class="alert alert-success"><?php echo $_GET['mensaje']; ?></div>
    <?php } elseif (isset($_GET['error'])) { ?>
        <div class="alert alert-danger"><?php echo $_GET['error']; ?></div>
    <?php } ?>

    <!-- Formulario para agregar nuevo equipo -->
    <form method="POST" action="equipos_controller.php" class="form-inline my-3">
        <input type="text" class="form-control mr-2" name="nombre" placeholder="Nombre del equipo" required>
        <input type="number" class="form-control mr-2" name="marca_id" placeholder="ID de la marca" required>
        <input type="number" class="form-control mr-2" name="sala_id" placeholder="ID de la sala" required>
        <input type="date" class="form-control mr-2" name="fecha_mantenimiento" required>
        <input type="text" class="form-control mr-2" name="estado" placeholder="Estado" required>
        <button type="submit" class="btn btn-primary" name="crear_equipo">Crear Equipo</button>
    </form>
    
    <!-- Tabla de equipos -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>ID de Marca</th>
                <th>ID de Sala</th>
                <th>Fecha de Mantenimiento</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['marca_id']; ?></td>
                    <td><?php echo $row['sala_id']; ?></td>
                    <td><?php echo $row['fecha_mantenimiento']; ?></td>
                    <td><?php echo $row['estado']; ?></td>
                    <td>
                        <!-- Botón para eliminar -->
                        <a href="equipos_controller.php?eliminar=<?php echo $row['id']; ?>" class="btn btn-danger">Eliminar</a>
                        
                        <!-- Botón para editar, que abre el modal -->
                        <button class="btn btn-warning" data-toggle="modal" data-target="#editModal" data-id="<?php echo $row['id']; ?>" data-nombre="<?php echo $row['nombre']; ?>" data-marca="<?php echo $row['marca_id']; ?>" data-sala="<?php echo $row['sala_id']; ?>" data-fecha="<?php echo $row['fecha_mantenimiento']; ?>" data-estado="<?php echo $row['estado']; ?>">Editar</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Modal para editar equipo -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Editar Equipo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="equipos_controller.php">
          <input type="hidden" id="id" name="id">
          <div class="form-group">
            <label for="nombre" class="col-form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre">
          </div>
          <div class="form-group">
            <label for="marca_id" class="col-form-label">ID de Marca:</label>
            <input type="number" class="form-control" id="marca_id" name="marca_id">
          </div>
          <div class="form-group">
            <label for="sala_id" class="col-form-label">ID de Sala:</label>
            <input type="number" class="form-control" id="sala_id" name="sala_id">
          </div>
          <div class="form-group">
            <label for="fecha_mantenimiento" class="col-form-label">Fecha de Mantenimiento:</label>
            <input type="date" class="form-control" id="fecha_mantenimiento" name="fecha_mantenimiento">
          </div>
          <div class="form-group">
            <label for="estado" class="col-form-label">Estado:</label>
            <input type="text" class="form-control" id="estado" name="estado">
          </div>
          <button type="submit" class="btn btn-primary" name="editar_equipo">Actualizar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Scripts de Bootstrap y JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    // Llenar el modal con los datos correspondientes
    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var id = button.data('id'); 
        var nombre = button.data('nombre'); 
        var marca = button.data('marca'); 
        var sala = button.data('sala'); 
        var fecha = button.data('fecha'); 
        var estado = button.data('estado'); 
        
        var modal = $(this);
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #nombre').val(nombre);
        modal.find('.modal-body #marca_id').val(marca);
        modal.find('.modal-body #sala_id').val(sala);
        modal.find('.modal-body #fecha_mantenimiento').val(fecha);
        modal.find('.modal-body #estado').val(estado);
    });
</script>
</body>
</html>
