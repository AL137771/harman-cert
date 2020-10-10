  <!-- Sidebar -->
  <form method="POST">
  <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading"><?php echo $_SESSION['nameAdmin'] ?> </div>
         
      <div class="list-group list-group-flush">
          <button class="btn btn-outline-dark dropdown-toggle" type="submit" data-toggle="dropdown" 
                                      aria-haspopup="true" aria-expanded="false"><i class="fas fa-users-cog"></i>    ADMINISTRADOR</button>
            <div class="dropdown-menu">
            <button type="submit" formaction='Create_Admin.php' class="dropdown-item btn btn-outline-primary"><i class="fas fa-plus-circle"></i>   CREAR ENTRENADOR</button>
            <button type="submit" formaction='Visualize_Admins.php' class="dropdown-item btn btn-outline-primary"><i class="fas fa-eye"></i>      VER ENTRENADORES</button>
            </div>
            </div>

          <div class="list-group list-group-flush">
          <button class="btn btn-outline-success dropdown-toggle" type="submit" data-toggle="dropdown" 
                                      aria-haspopup="true" aria-expanded="false"><i class="fas fa-users"></i>    ENTRENADOR</button>
            <div class="dropdown-menu">
            <button type="submit" formaction='Create_Trainer.php' class="dropdown-item btn btn-outline-primary"><i class="fas fa-plus-circle"></i>   CREAR ENTRENADOR</button>
            <button type="submit" formaction='Visualize_Trainers.php' class="dropdown-item btn btn-outline-primary"><i class="fas fa-eye"></i>      VER ENTRENADORES</button>
            </div>
            </div>

            <div class="list-group list-group-flush">
          <button class="btn btn-outline-danger dropdown-toggle" type="button" data-toggle="dropdown" 
                                      aria-haspopup="true" aria-expanded="false">
                                      <i class="fas fa-building"></i>      AREA</button>
            <div class="dropdown-menu">
            <button type="submit" formaction='Create_Area.php' class="dropdown-item btn btn-outline-primary"><i class="fas fa-plus-circle"></i>   CREAR AREA</button>
            <button type="submit" formaction='Visualize_Areas.php' class="dropdown-item btn btn-outline-primary"><i class="fas fa-eye"></i>      VER AREAS</button>
            </div>
          </div>

            <div class="list-group list-group-flush">
        <button class="btn btn-outline-info dropdown-toggle" type="button" data-toggle="dropdown" 
                                      aria-haspopup="true" aria-expanded="false">
                                      <i class="fas fa-screwdriver"></i>       OPERACION</button>
            <div class="dropdown-menu">
            <button type="submit" formaction='Create_Operation.php' class="dropdown-item btn btn-outline-primary"><i class="fas fa-plus-circle"></i>   CREAR OPERACION</button>
            <button type="submit" formaction='Visualize_Operations.php' class="dropdown-item btn btn-outline-primary">
            <i class="fas fa-eye"></i>      VER OPERACIONES</button>
            </div>
            
              
          <button type="submit" formaction='See_Employees.php' class="btn btn-outline-secondary">
          <i class="fas fa-people-carry"></i>   EMPLEADOS</button>
                          

            <div class="list-group list-group-flush">
          <button class="btn btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown" 
                                      aria-haspopup="true" aria-expanded="false"><i class="fas fa-sticky-note"></i>      CERTIFICACIONES</button>
            <div class="dropdown-menu">
            <button type="submit" formaction='Admin_MainPage.php' class="dropdown-item btn btn-outline-primary"><i class="fas fa-eye"></i>   VER CERTIFICACIONES</button>
            <button type="submit" formaction='Admin_RecertPage.php' class="dropdown-item btn btn-outline-primary"><i class="fas fa-eye"></i>      VER RECERTIFICACIONES</button>
            <button type="submit" formaction='Admin_SP_Page.php' class="dropdown-item btn btn-outline-primary"><i class="fas fa-eye"></i>      VER RECERTIFICACIONES SP</button>

            </div>
          </div>

          <div class="list-group list-group-flush">
          <button class="btn btn-outline-info dropdown-toggle" type="submit" data-toggle="dropdown" 
                                      aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-graduate"></i>     EXAMENES</button>
            <div class="dropdown-menu">
            <button type="submit" formaction='Create_Test.php' class="dropdown-item btn btn-outline-primary"><i class="fas fa-plus-circle"></i>   CREAR EXAMEN</button>
            <button type="submit" formaction='Visualize_Test.php' class="dropdown-item btn btn-outline-primary"><i class="fas fa-eye"></i>      VER EXAMENES</button>
            </div>
            </div>
          
          
          <button type="submit" formaction='Show_Graph.php' class="btn btn-outline-secondary">
                           <i class="fas fa-chart-bar"></i>   GRAFICAS</button>
                          
     
                           <button type="submit" formaction='Show_Graph_Test.php' class="btn btn-outline-secondary">
                           <i class="fas fa-chart-bar"></i>   GRAFICAS TEST</button>
                          
          <button type="submit" formaction='Turn_Trainer_Change_Cert.php' class="btn btn-outline-warning">
          <i class="fas fa-edit"></i></i>   CAMBIO DE TURNO</button>
          <div class="list-group list-group-flush">


        <button class="btn btn-outline-dark dropdown-toggle" type="button" data-toggle="dropdown" 
                                      aria-haspopup="true" aria-expanded="false">
                                      <i class="fas fa-screwdriver"></i>       CHECKLIST</button>
            <div class="dropdown-menu">
            <button type="submit" formaction='Admin_Checklist.php' class="dropdown-item btn btn-outline-primary">
            <i class="fas fa-eye"></i>   VER CHECKLIST (AREA, FECHA, TURNO)</button>
            <button type="submit" formaction='Admin_Whole_Checklist.php' class="dropdown-item btn btn-outline-primary">
            <i class="fas fa-eye"></i>      VER CHECKLIST (EMPLEADO)</button>
            </div>
            </div>

  <br><br>

  
  
            <button type="submit" formaction='index.php' name="LogOut" class="btn btn-sm btn-warning">
            <i class="fas fa-sign-out-alt"></i> CERRAR SESION</button>         
       

             </div>
        </div>
        </form>
