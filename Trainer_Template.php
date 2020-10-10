  <!-- Sidebar -->
  <form method="POST">
  <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading"><?php echo $_SESSION['name'] ?> </div>
      
      <div class="list-group list-group-flush">
          <button class="btn btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown" 
                                      aria-haspopup="true" aria-expanded="false"><i class="fas fa-paste"></i>     
                                       CERTIFICACIONES</button>
            <div class="dropdown-menu">
            <button type="submit" formaction='Create_Certification.php' class="dropdown-item btn btn-outline-primary">
                    <i class="fas fa-plus-circle"></i>   CREAR</button>
            <button type="submit" formaction='Trainer_MainPage.php' class="dropdown-item btn btn-outline-primary">
            <i class="fas fa-eye"></i>      VER</button>
            </div>
          </div>


          <div class="list-group list-group-flush">
          <button class="btn btn-outline-success dropdown-toggle" type="button" data-toggle="dropdown" 
                                      aria-haspopup="true" aria-expanded="false"><i class="fas fa-paste"></i>
                                            RECERTIFICACIONES</button>
            <div class="dropdown-menu">
            <button type="submit" formaction='Create_Recertification.php' class="dropdown-item btn btn-outline-primary">
            <i class="fas fa-plus-circle"></i>   CREAR</button>
            <button type="submit" formaction='Trainer_RecertPage.php' class="dropdown-item btn btn-outline-primary">
            <i class="fas fa-eye"></i>      VER</button>
            </div>
           </div>

           <div class="list-group list-group-flush">
          <button class="btn btn-outline-success dropdown-toggle" type="button" data-toggle="dropdown" 
                                      aria-haspopup="true" aria-expanded="false"><i class="fas fa-paste"></i>
                                            RECERT ESPECIAL</button>
            <div class="dropdown-menu">
            <button type="submit" formaction='Create_SP_Recert.php' class="dropdown-item btn btn-outline-primary">
            <i class="fas fa-plus-circle"></i>   CREAR</button>
            <button type="submit" formaction='Trainer_SP_Recert.php' class="dropdown-item btn btn-outline-primary">
            <i class="fas fa-eye"></i>      VER</button>
            </div>
           </div>


           <div class="list-group list-group-flush">
            <button type="submit" formaction='Change_Cert_From_Trainers.php' name="LogOut" class="btn btn-sm btn-outline-danger">
            <i class="fas fa-edit"></i> GESTION DE CERTIFICACIONES</button>         
       
          </div>

          <div class="list-group list-group-flush">
          <button class="btn btn-outline-dark dropdown-toggle" type="button" data-toggle="dropdown" 
                                      aria-haspopup="true" aria-expanded="false"><i class="fas fa-paste"></i>
                                            CHECKLIST</button>
            <div class="dropdown-menu">
            <button type="submit" formaction='Create_Emp_For_Checklist.php' class="dropdown-item btn btn-outline-primary">
            <i class="fas fa-plus-circle"></i>   REGISTRAR EMPLEADO</button>
            <button type="submit" formaction='See_Checklist.php' class="dropdown-item btn btn-outline-primary">
            <i class="fas fa-eye"></i>      VER CHECKLIST</button>
            </div>
           </div>

           
           <div class="list-group list-group-flush">
           <br>
            <button type="submit" formaction='index.php' name="LogOut" class="btn btn-sm btn-warning"><i class="fas fa-sign-out-alt"></i> CERRAR SESION</button>         
       
          </div>


          </div>
 
  </form>
    <!-- /#sidebar-wrapper -->