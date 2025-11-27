<?php
function sistema_menu($modulo,$interfaz,$origen) 
{    
    $conn = conexionSQL();
    $Global = new ModelGlobal();
    $sql = "SELECT * FROM gb_modulo WHERE gb_estatus='1' ORDER BY gb_id_modulo ASC";
    $resultado = sqlsrv_query($conn, $sql);
?>
<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <ul class="nav side-menu">
            <?php
            while ($fila = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) {
                /** PERFIL ADMINISTRADOR **/
                if ($_SESSION["gb_perfil"]==1) {
                    $isActive = ($modulo == $fila['gb_id_modulo']);
            ?>
                    <li <?php echo $isActive ? 'class="active"' : ''; ?>>
                        <a>
                            <i class="<?php echo $fila['gb_icono_modulo']; ?>"></i>
                            <?php echo $fila['gb_nombre_modulo']; ?>
                            <span class="fa fa-chevron-<?php echo $isActive ? 'up' : 'down'; ?>"></span>
                        </a>
                        <ul class="nav child_menu" <?php echo $isActive ? 'style="display: block;"' : ''; ?>>
                            <?php
                            $sql_menu = "SELECT * FROM gb_menu WHERE gb_id_modulo ='".$fila['gb_id_modulo']."' AND gb_estatus='1'";
                            $resultado_menu = sqlsrv_query($conn, $sql_menu);
                            
                            while ($fila_menu = sqlsrv_fetch_array($resultado_menu, SQLSRV_FETCH_ASSOC)) {
                                if($origen == 0) {
                                    $ext = $fila_menu['gb_raiz'].'/';
                                } else {
                                    $ext = '';
                                }
                                
                                $isMenuActive = ($interfaz == $fila_menu['gb_id_menu']);
                            ?>
                                <li <?php echo $isMenuActive ? 'class="current-page"' : ''; ?>>
                                    <a href="<?php echo $ext; ?>./index.php?opc=<?php echo $fila_menu['gb_archivo']; ?>">
                                        <i class="fa fa-circle-o"></i>
                                        <?php echo $fila_menu['gb_nombre_menu']; ?>
                                    </a>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </li>
            <?php
                } 
                /** NO ES PERFIL ADMINISTRADOR **/
                else {
                    if($_SESSION["gb_id_user"] == 24) {
                        if($fila['gb_id_modulo'] == 3) {
                            $validacion = false;
                        } else {
                            $validacion = true;
                        }
                    } else {
                        $validacion = $Global->modulo_permitido($fila['gb_id_modulo'], $_SESSION["gb_perfil"]) == 1;
                    }

                    if($validacion) {
                        $isActive = ($modulo == $fila['gb_id_modulo']);
            ?>
                        <li <?php echo $isActive ? 'class="active"' : ''; ?>>
                            <a>
                                <i class="<?php echo $fila['gb_icono_modulo']; ?>"></i>
                                <?php echo $fila['gb_nombre_modulo']; ?>
                                <span class="fa fa-chevron-<?php echo $isActive ? 'up' : 'down'; ?>"></span>
                            </a>
                            <ul class="nav child_menu" <?php echo $isActive ? 'style="display: block;"' : ''; ?>>
                                <?php
                                $sql_menu = "SELECT * FROM gb_menu WHERE gb_id_modulo ='".$fila['gb_id_modulo']."' AND gb_estatus='1'";
                                $resultado_menu = sqlsrv_query($conn, $sql_menu);
                                
                                while ($fila_menu = sqlsrv_fetch_array($resultado_menu, SQLSRV_FETCH_ASSOC)) {
                                    if($origen == 0) {
                                        $ext = $fila_menu['gb_raiz'].'/';
                                    } else {
                                        $ext = '';
                                    }
                                    
                                    $isMenuActive = ($interfaz == $fila_menu['gb_id_menu']);
                                ?>
                                    <li <?php echo $isMenuActive ? 'class="current-page"' : ''; ?>>
                                        <a href="<?php echo $ext; ?>./index.php?opc=<?php echo $fila_menu['gb_archivo']; ?>">
                                            <i class="fa fa-circle-o"></i>
                                            <?php echo $fila_menu['gb_nombre_menu']; ?>
                                        </a>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </li>
            <?php
                    }
                }
            }
            ?>
        </ul>
    </div>
</div>
<!-- /sidebar menu -->
<?php
}
?>