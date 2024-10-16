<?php
include 'conexion.php';
$conexion = conexion();

// Obtener todas las salas
$ssql = "SELECT * FROM salas";
$result = $conexion->query($ssql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Salas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include 'menu.php'; ?>

<div class="container">
    <h1>Gestión de Salas</h1>
    
    <!-- Mostrar mensaje de éxito o error -->
    <?php if (isset($_GET['mensaje'])) { ?>
        <div class="alert alert-success"><?php echo $_GET['mensaje']; ?></div>
    <?php } elseif (isset($_GET['error'])) { ?>
        <div class="alert alert-danger"><?php echo $_GET['error']; ?></div>
    <?php } ?>

    <!-- Formulario para agregar nueva sala -->
    <form method="POST" action="salas_controller.php" class="form-inline my-3">
        <input type="text" class="form-control mr-2" name="nombre" placeholder="Nombre de la sala" required>
        <input type="number" class="form-control mr-2" name="sede_id" placeholder="ID de la sede" required>
        <button type="submit" class="btn btn-primary" name="crear_sala">Crear Sala</button>
    </form>
    
    <!-- Tabla de salas -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>ID de la Sede</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['sede_id']; ?></td>
                    <td>
                        <!-- Botón para eliminar -->
                        <a href="salas_controller.php?eliminar=<?php echo $row['id']; ?>" class="btn btn-danger">Eliminar</a>
                        
                        <!-- Botón para editar, que abre el modal -->
                        <button class="btn btn-warning" data-toggle="modal" data-target="#editModal" data-id="<?php echo $row['id']; ?>" data-nombre="<?php echo $row['nombre']; ?>" data-sede="<?php echo $row['sede_id']; ?>">Editar</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Modal para editar sala -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Editar Sala</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="salas_controller.php">
          <input type="hidden" id="id" name="id">
          <div class="form-group">
            <label for="nombre" class="col-form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre">
          </div>
          <div class="form-group">
            <label for="sede_id" class="col-form-label">ID de la Sede:</label>
            <input type="number" class="form-control" id="sede_id" name="sede_id">
          </div>
          <button type="submit" class="btn btn-primary" name="editar_sala">Actualizar</button>
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
        var sede = button.data('sede'); 
        
        var modal = $(this);
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #nombre').val(nombre);
        modal.find('.modal-body #sede_id').val(sede);
    });
</script>
</body>
</html>
