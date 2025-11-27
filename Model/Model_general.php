<?php
class ModelGeneral
{

/*=============================================
TABLE USER
=============================================*/
    public function table_general()
    {
        $mysqli      = conexionMySQL();
        $data        = array();
        $sql         = "SELECT * FROM  proceso";
        $resultado   = $mysqli->query($sql);
        $a           = 1;
        while ($fila = $resultado->fetch_assoc()) {
            

            
            $fila['proceso']     = $fila['nombre'];
            $fila['descripcion'] = '<strong>API : </strong>'. $fila['api'].'<br> <strong>Hora :</strong>'.$fila['hora'];
           
           
           if($fila['estatus'] == 1)
           {
                if($fila['estado'] == 0)
                {    
                    $estatus = '<button type="button" class="btn btn-xs" style="background-color: #FA5F5F; border-color: #0000ff; color: #ffffff;" ><acronym title="Estado Proceso!" lang="es"><i class=""><strong>EJECUTADO</strong></i></acronym></button>
                                <button type="button" estatus="'.$a.'" proceso="'.$a.'" class="btn btn-xs btn_manual_process" style="background-color: #0000ff; border-color: #0000ff; color: #ffffff;" ><acronym title="Ejecutar Proceso!" lang="es"><i class=""><strong>EJECUTAR</strong></i></acronym></button>';
                }
                else
                {
                    $estatus = '<button type="button" class="btn btn-xs" style="background-color: #FA5F5F; border-color: #0000ff; color: #ffffff;" ><acronym title="Estado Proceso!" lang="es"><i class=""><strong>EJECUTADO</strong></i></acronym></button>';
                }
            
           }
           else
           {
                $estatus = '<button type="button" class="btn btn-xs" style="background-color: #0000ff; border-color: #0000ff; color: #ffffff;" ><acronym title="Estado Proceso" lang="es"><i class="fa fa-arrow-up"><strong>EN PROCESO</strong></i></acronym></button>';
           }
           
           
            $fila['estatus']     = '<strong>Ultima Fecha Ejecución : </strong>'.$fila['fecha_ejecucion'] .'<br><strong>Estatus : </strong>'.$estatus;

            $data[]   = $fila;
            $a++;
        }
        $mysqli->close();
        return $data;
    }


    /*=============================================
    ACTUALIZAR ESTATUS
    =============================================*/
    public function actualizar_estatus($i)
    {
        $dataxr       = array();
        $mysqli       = conexionMySQL();
        $Global       = new ModelGlobal();


        $ssql      = "UPDATE proceso SET estado=1";
        $resultado = $mysqli->query($ssql);
        if ($resultado) {
          
        } else {
            $Global->salir_json(2, "ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
        }

        if($i == 4)
        {
            $ssql      = "UPDATE proceso SET estatus=2,estado=1,fecha_ejecucion='".date('d-m-Y')."' WHERE id ='".$i."' ";
        }
        else
        {
            $ssql      = "UPDATE proceso SET estatus=2,estado=1,fecha_ejecucion='".date('d-m-Y')."' WHERE id ='".$i."' ";
        }

        
        $resultado = $mysqli->query($ssql);
        if ($resultado) {
            $Global->salir_json(1,"");
        } else {
            $Global->salir_json(2, "ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
        }
    }


    /*=============================================
    PROCESO 1
    =============================================*/
    public function proceso1($txt_contador)
    {
        $dataxr       = array();
        $mysqli       = conexionMySQL();
        $Global       = new ModelGlobal();
        $concatenar   = '';
	

        set_time_limit(60000);

        for($i = 1; $i <= 100000; $i++)
        {

            $headers = array(
                'Content-Type:application/json',
                'Authorization: QEQZGLXMQ0AGtil1rW70UxsEfw4QKgLQgmzFkDwE6Pw'
            );

            $process = curl_init('https://api.contifico.com/sistema/api/v1/producto/?result_size=5000&estado=A&result_page='.$i);
            curl_setopt($process, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($process, CURLOPT_HEADER, 1);
            curl_setopt($process, CURLOPT_TIMEOUT, 3000);
            curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
            $return = curl_exec($process);
            curl_close($process);

            if($return =='')
            {
                $txt_contador = $txt_contador+ 1;
                $Global->salir_json(1,"");
            }

            $strln = explode("SAMEORIGIN",$return);
            $datosbancos = json_decode($strln[1], true);
            
            $conteo =  strlen($strln[1]);
			
			//var_dump($return);
            /** *VERIFICAMOS SI EXISTEN DATOS**/
            if($conteo > 6)
            {
                foreach ($datosbancos as $cliente) {    
            
                    
                        $concatenar = '';
                        /** *VERIFICAMOS SI EXISTE EL PRODUCTO **/
                        $cod =$cliente['id'];
                        $sql = 'SELECT * FROM productos WHERE id = "' . $cod . '"';
                        $resultado = $mysqli->query($sql);
                        $n = $resultado->num_rows;
                        if ($n > 0) {
    
                        while($row = mysqli_fetch_assoc($resultado)) {
    
                        $cantidad_stock   = $row["cantidad_stock"];
                        $pvp3             = $row["pvp3"];
                        $pvp2             = $row["pvp2"];
                        $pvp1             = $row["pvp1"];
                        $produc           = $this->sanear_string($row["descripcion"]);
                        $tipo             = $row["tipo"];
                        $tipo_producto    = $row["tipo_producto"];
                        $pvp_manual       = $row["pvp_manual"];
                        $nombre           = $this->sanear_string($row["nombre"]);
                        $categoria_id     = $row["categoria_id"];
                        $estado           = $row["estado"];
                        $marca_id         = $row["marca_id"];
                        $codigo           = $row["codigo"];
                        $costo_maximo     = $row["costo_maximo"];
                        $imagen           = $row["imagen"];
                        $codigo_proveedor = $row["codigo_proveedor"];
                        $validar          = 'SI';
                        
                        }
                    }
                    else
                    {
                        $validar = '';
                    }
    
                    /** INSERTAMOS SI NO EXISTE **/
                    if ($validar==''){
    
                        $ssql = "INSERT INTO productos 
                        (
                        `porcentaje_iva`,
                        `costo_maximo`, 
                        `imagen`, 
                        `minimo`, 
                        `descripcion`,
                        `id`, 
                        `cuenta_costo_id`, 
                        `pvp2`,
                        `tipo`,
                        `tipo_producto`, 
                        `pvp3`, 
                        `pvp1`,
                        `pvp_manual`, 
                        `variantes`, 
                        `nombre`, 
                        `codigo_barra`,
                        `cuenta_venta_id`, 
                        `categoria_id`, 
                        `peso_hasta`, 
                        `pvp_peso`,
                        `nombre_producto_base`, 
                        `marca_id`,   
                        `estado`, 
                        `para_pos`,
                        `codigo`, 
                        `personalizado1`,   
                        `peso_desde`, 
                        `personalizado2`,
                        `producto_base_id`,  
                        `cuenta_compra_id`, 
                        `cantidad_stock`,
                        codigo_proveedor,
						fecha_registro,
						hora_registro
                        ) 
                        VALUES 
                        (
                        '".$cliente['porcentaje_iva']."',
                        '".$cliente['costo_maximo']."',
                        '".$cliente['imagen']."',
                        '".$cliente['minimo']."',
                        '".$this->sanear_string($cliente['descripcion'])."',
                        '".$cliente['id']."',
                        '".$cliente['cuenta_costo_id']."',
                        '".$cliente['pvp2']."',
                        '".$cliente['tipo']."',
                        '".$cliente['tipo_producto']."',
                        '".$cliente['pvp3']."',
                        '".$cliente['pvp1']."',
                        '".$cliente['pvp_manual']."',
                        '".$cliente['variantes']."',
                        '".$this->sanear_string($cliente['nombre'])."',
                        '".$cliente['codigo_barra']."',
                        '".$cliente['cuenta_venta_id']."',
                        '".$cliente['categoria_id']."',
                        '".$cliente['peso_hasta']."',
                        '".$cliente['pvp_peso']."',
                        '".$cliente['nombre_producto_base']."',
                        '".$cliente['marca_id']."',
                        '".$cliente['estado']."',
                        '".$cliente['para_pos']."',
                        '".$cliente['codigo']."',
                        '".$cliente['personalizado1']."',
                        '".$cliente['peso_desde']."',
                        '".$cliente['personalizado2']."',
                        '".$cliente['producto_base_id']."',
                        '".$cliente['cuenta_compra_id']."',
                        '".$cliente['cantidad_stock']."',
                        '".$cliente['codigo_proveedor']."',
						'".date('Y-m-d')."',
						'".date("g:i:s-a")."')";
                        $resultado = $mysqli->query($ssql);
                        if ($resultado) {
							//echo 'oka';
                        }
                        else
                        {
                          //  $Global->salir_json(2,"ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
                          echo $ssql;
                        }
                    }
                    else
                    {
                        /** ACTUALIZAMOS EL PRODUCTO**/
                        if ($cliente['cantidad_stock'] <> $cantidad_stock) {
                            $concatenar = $concatenar . " `cantidad_stock`='".$cliente['cantidad_stock']."',";
                        }
                        if ($cliente['pvp2'] <> $pvp2  && $cliente['pvp2']<>'') {
                            $concatenar = $concatenar . " `pvp2`='".$cliente['pvp2']."',";
                        }
                        if ($cliente['pvp1'] <> $pvp1  && $cliente['pvp1']<>'') {
                            $concatenar = $concatenar . " `pvp1`='".$cliente['pvp1']."',";
                        }
                        if ($cliente['descripcion'] <> $produc) {
                            $concatenar = $concatenar . " `descripcion`='".$this->sanear_string($cliente['descripcion'])."',";
                        }
                        if ($cliente['tipo'] <> $tipo) {
                            $concatenar = $concatenar . " `tipo`='".$cliente['tipo']."',";
                        }
                        if ($cliente['tipo_producto'] <> $tipo_producto) {
                            $concatenar = $concatenar . " `tipo_producto`='".$cliente['tipo_producto']."',";
                        }
                        if ($cliente['pvp_manual'] <> $pvp_manual  && $cliente['pvp_manual']<>'') {
                            $concatenar = $concatenar . " `pvp_manual`='".$cliente['pvp_manual']."',";
                        }
                        if ($cliente['nombre'] <> $nombre) {
                            $concatenar = $concatenar . " `nombre`='".$this->sanear_string($cliente['nombre'])."',";
                        }
                        if ($cliente['categoria_id'] <> $categoria_id) {
                            $concatenar = $concatenar . " `categoria_id`='".$cliente['categoria_id']."',";
                        }
                        
                        if ($cliente['estado'] <> $estado) {
                            $concatenar = $concatenar . " `estado`='".$cliente['estado']."',";
                        }
                        if ($cliente['marca_id'] <> $marca_id) {
                            $concatenar = $concatenar . " `marca_id`='".$cliente['marca_id']."',";
                        }
                        if ($cliente['codigo'] <> $codigo) {
                            $concatenar = $concatenar . " `codigo`='".$cliente['codigo']."',";
                        }
                        if ($cliente['costo_maximo'] <> $costo_maximo && $cliente['costo_maximo']<>'') {
                            $concatenar = $concatenar . " `costo_maximo`='".$cliente['costo_maximo']."',";
                        }
                        if ($cliente['imagen'] <> $imagen) {
                            $concatenar = $concatenar . " `imagen`='".$cliente['imagen']."',";
                        }
                        if ($cliente['codigo_proveedor'] <> $codigo_proveedor) {
                            $concatenar = $concatenar . " `codigo_proveedor`='".$cliente['codigo_proveedor']."',";
                        }
                        
                        $concatenar =  trim($concatenar, ',');   
                        if ($concatenar!=''){

                        } else {
                            $concatenar=" estado=estado ";
                        }
                        $ssql = "UPDATE productos SET  $concatenar,fecha_registro='".date('Y-m-d')."',hora_registro='".date("g:i:s-a")."'  WHERE id ='".$cliente['id']."' "; 
                        $resultado = $mysqli->query($ssql);
                        if ($resultado) {

                        }
                        else
                        {
                        $Global->salir_json(2,"ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
                        }
						
                    } 
                    
                    

                }

            }
            else
            {
                $i = 1000001;
            }
            

            
        }
        $Global->salir_json(1,"ok");
  
    $mysqli->close();
 }




  /*=============================================
    PROCESO 2
    =============================================*/
    public function proceso2($txt_contador)
    {
        $dataxr       = array();
        $mysqli       = conexionMySQL();
        $Global       = new ModelGlobal();
        $concatenar   = '';
        set_time_limit(6000);


        
        $ssql      = "UPDATE proceso SET estado=1";
        $resultado = $mysqli->query($ssql);
        if ($resultado) {
          
        } else {
            $Global->salir_json(2, "ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
        }
        $ssql      = "UPDATE proceso SET estatus=2,estado=1,fecha_ejecucion='".date('d-m-Y')."' WHERE id ='".$txt_contador."' ";
        $resultado = $mysqli->query($ssql);
        if ($resultado) {
           
        } else {
            $Global->salir_json(2, "ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
        }

        for($i = 1; $i <= 5; $i++)
        {

         
          
            $headers = array(
                'Content-Type:application/json',
                'Authorization: QEQZGLXMQ0AGtil1rW70UxsEfw4QKgLQgmzFkDwE6Pw'
            );

            $process = curl_init('https://api.contifico.com/sistema/api/v1/categoria/?result_size=100&result_page='.$i);
            curl_setopt($process, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($process, CURLOPT_HEADER, 1);
            curl_setopt($process, CURLOPT_TIMEOUT, 300);
            curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
            $return = curl_exec($process);
            curl_close($process);

            if($return =='')
            {
                $txt_contador = $txt_contador+ 1;
                $Global->salir_json_contador(1,"",$txt_contador);
            }

            $strln = explode("SAMEORIGIN",$return);
            $datosbancos = json_decode($strln[1], true);
			//echo $datosbancos.lenght;

            $conteo =  strlen($strln[1]);
            /** *VERIFICAMOS SI EXISTEN DATOS**/
            if($conteo > 6)
            {
                foreach ($datosbancos as $cliente) { 
                    
                
                        /** VACIAMOS LA TABLA DE CATEGORIAS **/
                        if ($i == '1') {
                            $ssql      = "TRUNCATE TABLE categorias";
                            $resultado = $mysqli->query($ssql);
                            if ($resultado) {
                            } else {
                                $Global->salir_json(2, "ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
                            }
                        }

                        $sql = 'SELECT * FROM categorias WHERE id = "' . $cliente['id'] . '"';
                        $resultadoc= $mysqli->query($sql);
                        $n = $resultadoc->num_rows;
                        if ($n <= 0) {

                            $ssql = "INSERT INTO categorias 
                            (
                                `padre_id`,
                                `cuenta_compra`,
                                `tipo_producto`,
                                `cuenta_venta`, 
                                `agrupar`, 
                                `nombre`, 
                                `id`, 
                                `cuenta_inventario`,
								`fecha_registro`,
								`hora_registro`
                            ) 
                            VALUES 
                            (
                                '".$cliente['padre_id']."',
                                '".$cliente['cuenta_compra']."',
                                '".$cliente['tipo_producto']."',
                                '".$cliente['cuenta_venta']."',
                                '".$cliente['agrupar']."',
                                '".$cliente['nombre']."',
                                '".$cliente['id']."',
                                '".$cliente['cuenta_inventario']."',
								'".date('Y-m-d')."',
								'".date("g:i:s-a")."'
                            )";
                            $resultado1 = $mysqli->query($ssql);
                            if ($resultado1) {
        
                            }
                            else
                            {
                                $Global->salir_json(2,"ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
                            }

                        }
                }
            }
            else
            {
                $i = 100001;
            }
   
        }
        /** ACTUALIZAMOS FECHA EJECUCION**/

        $ssql      = "UPDATE proceso SET estado=0";
        $resultado = $mysqli->query($ssql);
        if ($resultado) {
          
        } else {
            $Global->salir_json(2, "ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
        }


        $ssql      = "UPDATE proceso SET estatus=1 WHERE id ='2' ";
        $resultado = $mysqli->query($ssql);
        if ($resultado) {
        } else {
            $Global->salir_json(2, "ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
        }
         
        $txt_contador = $txt_contador+ 1;
        $Global->salir_json_contador(1,"",$txt_contador);
    $mysqli->close();
 }




 /*=============================================
    PROCESO 3
    =============================================*/
    public function proceso3($txt_contador)
    {
        $dataxr       = array();
        $mysqli       = conexionMySQL();
        $Global       = new ModelGlobal();
        $concatenar   = '';
        set_time_limit(6000);

        $ssql      = "UPDATE proceso SET estado=1";
        $resultado = $mysqli->query($ssql);
        if ($resultado) {
          
        } else {
            $Global->salir_json(2, "ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
        }
        $ssql      = "UPDATE proceso SET estatus=2,estado=1,fecha_ejecucion='".date('d-m-Y')."' WHERE id ='".$txt_contador."' ";
        $resultado = $mysqli->query($ssql);
        if ($resultado) {
           
        } else {
            $Global->salir_json(2, "ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
        }

        for($i = 1; $i <= 10000; $i++)
        {
          
            
            $headers = array(
                'Content-Type:application/json',
                'Authorization: QEQZGLXMQ0AGtil1rW70UxsEfw4QKgLQgmzFkDwE6Pw'
            );

            $process = curl_init('https://api.contifico.com/sistema/api/v1/persona/?result_size=100&result_page='.$i);
            curl_setopt($process, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($process, CURLOPT_HEADER, 1);
            curl_setopt($process, CURLOPT_TIMEOUT, 300);
            curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
            $return = curl_exec($process);
            curl_close($process);


            if($return =='')
            {
                $txt_contador = $txt_contador+ 1;
                $Global->salir_json_contador(1,"",$txt_contador);
            }
            $strln = explode("SAMEORIGIN",$return);
            $datosbancos = json_decode($strln[1], true);

            $conteo =  strlen($strln[1]);


            /** *VERIFICAMOS SI EXISTEN DATOS**/
            if($conteo > 6)
            {
            
                foreach ($datosbancos as $cliente) {   
                    
                
                        $cod =$cliente['id'];
                        $concatenar   = '';
                        /** *VERIFICAMOS SI EXISTE LA PERSONA **/
                        $cod =$cliente['id'];
                        $sql = 'SELECT * FROM personas WHERE id = "' . $cod . '"';
                        $resultado = $mysqli->query($sql);
                        $n = $resultado->num_rows;
                        if ($n > 0) {
                            while($row = mysqli_fetch_assoc($resultado)) {

                                $adicional1_cliente   = $row["adicional1_cliente"];
                                $personaasociada_id   = $row["personaasociada_id"];
                                $direccion            = $row["direccion"];
                                $es_vendedor          = $row["es_vendedor"];
                                $tipo                 = $row["tipo"];
                                $razon_social         = $row["razon_social"];
                                $nombre_comercial     = $row["nombre_comercial"];
                                $es_corporativo       = $row["es_corporativo"];
                                $porcentaje_descuento = $row["porcentaje_descuento"];
                                $origen               = $row["origen"];
                                $ruc                  = $row["ruc"];
                                $banco_codigo_id      = $row["banco_codigo_id"];
                                $email                = $row["email"];
                                $adicional3_cliente   = $row["adicional3_cliente"];
                                $es_cliente           = $row["es_cliente"];
                                $adicional1_proveedor = $row["adicional1_proveedor"];
                                $numero_tarjeta       = $row["numero_tarjeta"];
                                $adicional3_proveedor = $row["adicional3_proveedor"];
                                $aplicar_cupo         = $row["aplicar_cupo"];
                                $adicional2_cliente   = $row["adicional2_cliente"];
                                $es_empleado          = $row["es_empleado"];
                                $es_extranjero        = $row["es_extranjero"];
                                $es_proveedor         = $row["es_proveedor"];
                                $telefonos            = $row["telefonos"];
                                $adicional4_proveedor = $row["adicional4_proveedor"];
                                $tipo_cuenta          = $row["tipo_cuenta"];
                                $adicional4_cliente   = $row["adicional4_cliente"];
                                $placa                = $row["placa"];
                                $adicional2_proveedor = $row["adicional2_proveedor"];
                                $cedula               = $row["cedula"];
                                $validar              = 'SI';
                            }
                        }
                        else
                        {
                            $validar = '';
                        }  


                        /** ISERTAMOS SI NO EXISTE LA PERSONA**/
                        if ($validar==''){ 

                                $ssql = "INSERT INTO personas 
                                (
                                    adicional1_cliente,
                                    personaasociada_id,
                                    direccion,
                                    id,
                                    es_vendedor,
                                    tipo,
                                    razon_social,
                                    nombre_comercial,
                                    es_corporativo,
                                    porcentaje_descuento,
                                    origen,
                                    ruc,
                                    banco_codigo_id,
                                    email,
                                    adicional3_cliente,
                                    es_cliente,
                                    adicional1_proveedor,
                                    numero_tarjeta,
                                    adicional3_proveedor,
                                    aplicar_cupo,
                                    adicional2_cliente,
                                    es_empleado,
                                    es_extranjero,
                                    es_proveedor,
                                    telefonos,
                                    adicional4_proveedor,
                                    tipo_cuenta,
                                    adicional4_cliente,
                                    placa,
                                    adicional2_proveedor,
                                    cedula,
									fecha_registro,
									hora_registro
                                )
                                VALUES 
                                (
                                    '".$cliente['adicional1_cliente']."',
                                    '".$cliente['personaasociada_id']."',
                                    '".$cliente['direccion']."',
                                    '".$cliente['id']."',
                                    '".$cliente['es_vendedor']."',
                                    '".$cliente['tipo']."',
                                    '".$cliente['razon_social']."',
                                    '".$cliente['nombre_comercial']."',
                                    '".$cliente['es_corporativo']."',
                                    '".$cliente['porcentaje_descuento']."',
                                    '".$cliente['origen']."',
                                    '".$cliente['ruc']."',
                                    '".$cliente['banco_codigo_id']."',
                                    '".$cliente['email']."',
                                    '".$cliente['adicional3_cliente']."',
                                    '".$cliente['es_cliente']."',
                                    '".$cliente['adicional1_proveedor']."',
                                    '".$cliente['numero_tarjeta']."',
                                    '".$cliente['adicional3_proveedor']."',
                                    '".$cliente['aplicar_cupo']."',
                                    '".$cliente['adicional2_cliente']."',
                                    '".$cliente['es_empleado']."',
                                    '".$cliente['es_extranjero']."',
                                    '".$cliente['es_proveedor']."',
                                    '".$cliente['telefonos']."',
                                    '".$cliente['adicional4_proveedor']."',
                                    '".$cliente['tipo_cuenta']."',
                                    '".$cliente['adicional4_cliente']."',
                                    '".$cliente['placa']."',
                                    '".$cliente['adicional2_proveedor']."',
                                    '".$cliente['cedula']."',
									'".date('Y-m-d')."',
									'".date("g:i:s-a")."'
                                )";
                                $resultado1 = $mysqli->query($ssql);
                                if ($resultado1) {
            
                                }
                                else
                                {
                                    $Global->salir_json(2,"ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
                                }

                        }
                        /** ACTUALIZAMOS REGISTO**/
                        else
                        {
                            if ($cliente['adicional1_cliente'] <> $adicional1_cliente) {
                                $concatenar = $concatenar . " `adicional1_cliente`='".$cliente['adicional1_cliente']."',";
                            }
                            if ($cliente['personaasociada_id'] <> $personaasociada_id) {
                                $concatenar = $concatenar . " `personaasociada_id`='".$cliente['personaasociada_id']."',";
                            }
                            if ($cliente['direccion'] <> $direccion) {
                                $concatenar = $concatenar . " `direccion`='".$cliente['direccion']."',";
                            }
                            if ($cliente['es_vendedor'] <> $es_vendedor) {
                                $concatenar = $concatenar . " `es_vendedor`='".$cliente['es_vendedor']."',";
                            }
                            if ($cliente['tipo'] <> $tipo) {
                                $concatenar = $concatenar . " `tipo`='".$cliente['tipo']."',";
                            }
                            if ($cliente['razon_social'] <> $razon_social) {
                                $concatenar = $concatenar . " `razon_social`='".$cliente['razon_social']."',";
                            }
                            if ($cliente['nombre_comercial'] <> $nombre_comercial) {
                                $concatenar = $concatenar . " `nombre_comercial`='".$cliente['nombre_comercial']."',";
                            }
                            if ($cliente['es_corporativo'] <> $es_corporativo) {
                                $concatenar = $concatenar . " `es_corporativo`='".$cliente['es_corporativo']."',";
                            }
                            if ($cliente['porcentaje_descuento'] <> $porcentaje_descuento) {
                                $concatenar = $concatenar . " `porcentaje_descuento`='".$cliente['porcentaje_descuento']."',";
                            }
                            
                            if ($cliente['origen'] <> $origen) {
                                $concatenar = $concatenar . " `origen`='".$cliente['origen']."',";
                            }
                            if ($cliente['ruc'] <> $ruc) {
                                $concatenar = $concatenar . " `ruc`='".$cliente['ruc']."',";
                            }
                            if ($cliente['banco_codigo_id'] <> $banco_codigo_id) {
                                $concatenar = $concatenar . " `banco_codigo_id`='".$cliente['banco_codigo_id']."',";
                            }
                            if ($cliente['email'] <> $email) {
                                $concatenar = $concatenar . " `email`='".$cliente['email']."',";
                            }
                            if ($cliente['adicional3_cliente'] <> $adicional3_cliente) {
                                $concatenar = $concatenar . " `adicional3_cliente`='".$cliente['adicional3_cliente']."',";
                            }
                            if ($cliente['es_cliente'] <> $es_cliente) {
                                $concatenar = $concatenar . " `es_cliente`='".$cliente['es_cliente']."',";
                            }
                            if ($cliente['adicional1_proveedor'] <> $adicional1_proveedor) {
                                $concatenar = $concatenar . " `adicional1_proveedor`='".$cliente['adicional1_proveedor']."',";
                            }
                            if ($cliente['numero_tarjeta'] <> $numero_tarjeta) {
                                $concatenar = $concatenar . " `numero_tarjeta`='".$cliente['numero_tarjeta']."',";
                            }
                            if ($cliente['adicional3_proveedor'] <> $adicional3_proveedor) {
                                $concatenar = $concatenar . " `adicional3_proveedor`='".$cliente['adicional3_proveedor']."',";
                            }
                            if ($cliente['aplicar_cupo'] <> $aplicar_cupo) {
                                $concatenar = $concatenar . " `aplicar_cupo`='".$cliente['aplicar_cupo']."',";
                            }
                            if ($cliente['adicional2_cliente'] <> $adicional2_cliente) {
                                $concatenar = $concatenar . " `adicional2_cliente`='".$cliente['adicional2_cliente']."',";
                            }
                            if ($cliente['es_empleado'] <> $es_empleado) {
                                $concatenar = $concatenar . " `es_empleado`='".$cliente['es_empleado']."',";
                            }
                            if ($cliente['es_extranjero'] <> $es_extranjero) {
                                $concatenar = $concatenar . " `es_extranjero`='".$cliente['es_extranjero']."',";
                            }
                            if ($cliente['es_proveedor'] <> $es_proveedor) {
                                $concatenar = $concatenar . " `es_proveedor`='".$cliente['es_proveedor']."',";
                            }
                            if ($cliente['telefonos'] <> $telefonos) {
                                $concatenar = $concatenar . " `telefonos`='".$cliente['telefonos']."',";
                            }
                            if ($cliente['adicional4_proveedor'] <> $adicional4_proveedor) {
                                $concatenar = $concatenar . " `adicional4_proveedor`='".$cliente['adicional3_proveedor']."',";
                            }
                            if ($cliente['tipo_cuenta'] <> $tipo_cuenta) {
                                $concatenar = $concatenar . " `tipo_cuenta`='".$cliente['tipo_cuenta']."',";
                            }
                            if ($cliente['adicional4_cliente'] <> $adicional4_cliente) {
                                $concatenar = $concatenar . " `adicional4_cliente`='".$cliente['adicional4_cliente']."',";
                            }
                            if ($cliente['placa'] <> $placa) {
                                $concatenar = $concatenar . " `placa`='".$cliente['placa']."',";
                            }
                            if ($cliente['adicional2_proveedor'] <> $adicional2_proveedor) {
                                $concatenar = $concatenar . " `adicional2_proveedor`='".$cliente['adicional2_proveedor']."',";
                            }
                            if ($cliente['cedula'] <> $cedula) {
                                $concatenar = $concatenar . " `cedula`='".$cliente['cedula']."',";
                            }
                            
                            $concatenar =  trim($concatenar, ','); 
                            $ssql = "UPDATE personas SET  $concatenar,fecha_registro='".date('Y-m-d')."',hora_registro='".date("g:i:s-a")."'  WHERE id ='".$cliente['id']."' "; 
                            $resultado2 = $mysqli->query($ssql);
                            if ($resultado2) {
        
                            }
                            else
                            {
                            $Global->salir_json(2,"ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
                            }
                        }

                    
                }


            }
            else
            {
                $i = 100001;
            }    
        }
        /** ACTUALIZAMOS FECHA EJECUCION**/

        $ssql      = "UPDATE proceso SET estado=0";
        $resultado = $mysqli->query($ssql);
        if ($resultado) {
          
        } else {
            $Global->salir_json(2, "ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
        }


        $ssql      = "UPDATE proceso SET estatus=1 WHERE id ='3' ";
        $resultado = $mysqli->query($ssql);
        if ($resultado) {
        } else {
            $Global->salir_json(2, "ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
        }
         
        $txt_contador = $txt_contador+ 1;
        $Global->salir_json_contador(1,"",$txt_contador);
    $mysqli->close();
 }




 /*=============================================
    PROCESO 4
    =============================================*/
    public function proceso4($txt_manual,$txt_contador)
    {
        $dataxr       = array();
        $mysqli       = conexionMySQL();
        $Global       = new ModelGlobal();
        $concatenar   = '';
        set_time_limit(60000);

        $salida     = date('l', strtotime(date('Y-m-d')));
		
		if($txt_manual == 1)
		{
			$compa =  1==1;
		}
		else
		{
		//$compa = $salida == 'Friday';
			$compa =  1==1;
			
		}

        if($compa)
        {
            
            
			 $ssql      = "UPDATE proceso SET estado=1";
             $resultado = $mysqli->query($ssql);
             if ($resultado) {
               
             } else {
                 $Global->salir_json(2, "ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
             }
             $ssql      = "UPDATE proceso SET estatus=2,estado=1,fecha_ejecucion='".date('d-m-Y')."' WHERE id ='".$txt_contador."' ";
             $resultado = $mysqli->query($ssql);
             if ($resultado) {
                
             } else {
                 $Global->salir_json(2, "ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
             }


            /** VACIAMOS LA TABLA DE MOVIMIENTOS **/
            
                $ssql      = "TRUNCATE TABLE movimientos";
                $resultado = $mysqli->query($ssql);
                if ($resultado) {
                } else {
                    $Global->salir_json(2, "ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
                }


                $ssql      = "TRUNCATE TABLE movimientos_detalle";
                $resultado = $mysqli->query($ssql);
                if ($resultado) {
                } else {
                    $Global->salir_json(2, "ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
                }
            
            
            for($i = 1; $i <= 100000; $i++)
            {
            
                $headers = array(
                    'Content-Type:application/json',
                    'Authorization: QEQZGLXMQ0AGtil1rW70UxsEfw4QKgLQgmzFkDwE6Pw'
                );

                $process = curl_init('https://api.contifico.com/sistema/api/v1/movimiento-inventario/?result_size=1000&result_page='.$i);
                curl_setopt($process, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($process, CURLOPT_HEADER, 1);
                curl_setopt($process, CURLOPT_TIMEOUT, 3000000000000);
                curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
                $return = curl_exec($process);
                curl_close($process);


               ini_set('memory_limit', '1024M');

               if($return =='')
               {
                   $txt_contador = $txt_contador+ 1;
                   $Global->salir_json_contador(1,"",$txt_contador);
               }

                $strln = explode("SAMEORIGIN",$return);
                $datosbancos = json_decode($strln[1], true);

                $conteo =  strlen($strln[1]);
                /** *VERIFICAMOS SI EXISTEN DATOS**/
                if($conteo > 6)
                {

                    

                    foreach ($datosbancos as $cliente) {   
                        
                    
                            
                        $fecha=$cliente['fecha'];
                        $fecha = substr($fecha, 6,4).'-'. substr($fecha, 3,2).'-'.substr($fecha, 0,2);

                            $concatenar = '';
                            /** *VERIFICAMOS SI EXISTE EL PRODUCTO **/
                            $cod =$cliente['id'];
                            $sql = 'SELECT * FROM movimientos WHERE id = "' . $cod . '"';
                            $resultado = $mysqli->query($sql);
                            $n = $resultado->num_rows;
                            if ($n <= 0) {

                                
                                /** INSERTAMOS LOS MOVIMIENTOS**/
                                $ssql = "INSERT INTO movimientos 
                                (
                                `codigo`,
                                `bodega_id`, 
                                `tipo`, 
                                `fecha`, 
                                `generar_asiento`,
                                `pos`, 
                                `descripcion`, 
                                `bodega_destino_id`,
                                `codigo_interno`,
                                `maneja_venta`, 
                                `total`, 
                                `estado`,
                                `id`,
								`fecha_registro`,
								`hora_registro`
                                ) 
                                VALUES 
                                (
                                '".$this->sanear_string($cliente['codigo'])."',
                                '".$this->sanear_string($cliente['bodega_id'])."',
                                '".$this->sanear_string($cliente['tipo'])."',
                                '".$fecha."',
                                '".$this->sanear_string($cliente['generar_asiento'])."',
                                '".$this->sanear_string($cliente['pos'])."',
                                '".$this->sanear_string($cliente['descripcion'])."',
                                '".$this->sanear_string($cliente['bodega_destino_id'])."',
                                '".$this->sanear_string($cliente['codigo_interno'])."',
                                '".$this->sanear_string($cliente['maneja_venta'])."',
                                '".$this->sanear_string($cliente['total'])."',
                                '".$this->sanear_string($cliente['estado'])."',
                                '".$this->sanear_string($cliente['id'])."',
								'".date('Y-m-d')."',
								'".date("g:i:s-a")."'
                                )";
                                $resultado = $mysqli->query($ssql);
                                if ($resultado) {
            
                                }
                                else
                                {
                                    
                                   
                                    
                                    $Global->salir_json(2,"ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);



                                }

                                /** INSERTAMOS EL DETALLE DE MOVIMIENTOS**/
                                for ($a = 0; $a < count($cliente['detalles']); $a++) {

                                    $ssql = "INSERT INTO 
                                    `movimientos_detalle`
                                    (
                                        `movimientofk`,
                                        `serie`,
                                        `producto_id`,
                                        `edicion`,
                                        `precio`,
                                        `cantidad`,
										`fecha_registro`,
								        `hora_registro`
                                    ) 
                                    VALUES 
                                    (
                                        '" . $cliente['id'] . "',
                                        '" . $this->sanear_string($cliente['detalles'][$a]['serie']) . "',
                                        '" . $this->sanear_string($cliente['detalles'][$a]['producto_id']) . "',
                                        '" . $this->sanear_string($cliente['detalles'][$a]['edicion']) . "',
                                        '" . $this->sanear_string($cliente['detalles'][$a]['precio']) . "',
                                        '" . $this->sanear_string($cliente['detalles'][$a]['cantidad']) . "',
										'".date('Y-m-d')."',
										'".date("g:i:s-a")."'										
                                    ) ";

                                    $resultado1 = $mysqli->query($ssql);
                                    if ($resultado1) {
                
                                    }
                                    else
                                    {
                                    
                                    
                                        $Global->salir_json(2,"ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
                                    }
                                }      
                            }
                    
                    }   


                }
                else
                {
                    $i = 1000001;
                }
            }
            /** ACTUALIZAMOS FECHA EJECUCION**/

            $ssql      = "UPDATE proceso SET estado=0";
            $resultado = $mysqli->query($ssql);
            if ($resultado) {
            
            } else {
                $Global->salir_json(2, "ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
            }


            $ssql      = "UPDATE proceso SET estatus=1,fecha_ejecucion='".date('d-m-Y')."' WHERE id ='4' ";
            $resultado = $mysqli->query($ssql);
            if ($resultado) {
            } else {
                $Global->salir_json(2, "ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
            }
            $Global->salir_json(1,"");
        }
        else
        {
            
            $ssql      = "UPDATE proceso SET estado=0";
            $resultado = $mysqli->query($ssql);
            if ($resultado) {
            
            } else {
                $Global->salir_json(2, "ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
            }


            $ssql      = "UPDATE proceso SET estatus=1,estado=0 WHERE id =4 ";
            $resultado = $mysqli->query($ssql);
            if ($resultado) {
            } else {
                $Global->salir_json(2, "ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
            }
            
            $txt_contador = $txt_contador+ 1;
            $Global->salir_json_contador(1,"",$txt_contador);
        }    
        $mysqli->close();
 }


 private function  sanear_string($string)
 {
     $string = (utf8_encode($string));
     $string = str_replace(
         array("'", "¨", '"'),
         array(" ", " ", " "),
         $string
     );
     return $string;
 }

    /*=============================================
    PROCESO 5
    =============================================*/
    public function proceso5($txt_contador)
    {
        $dataxr       = array();
        $mysqli       = conexionMySQL();
        $Global       = new ModelGlobal();
        $concatenar   = '';
        set_time_limit(60000);

		ini_set('memory_limit', '1024M');
        $aniofecha = date("Y");
        $mesfecha = date("m");


        $ssql      = "UPDATE proceso SET estado=1";
        $resultado = $mysqli->query($ssql);
        if ($resultado) {
          
        } else {
            $Global->salir_json(2, "ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
        }
        $ssql      = "UPDATE proceso SET estatus=2,estado=1,fecha_ejecucion='".date('d-m-Y')."' WHERE id ='".$txt_contador."' ";
        $resultado = $mysqli->query($ssql);
        if ($resultado) {
           
        } else {
            $Global->salir_json(2, "ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
        }
        
        $ssql      = "DELETE docdet.* FROM documentos_detalle docdet INNER JOIN  documentos docdoc  ON
                      docdoc.id = docdet.id_documentofk  WHERE year(fecha_emision) = '$aniofecha' AND month(fecha_emision)= '$mesfecha';";
        $resultado = $mysqli->query($ssql);
        if ($resultado) {
        } else {
            $Global->salir_json(2, "ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
        }


        $ssql      = "DELETE doccob.* FROM  documentos_cobro doccob INNER JOIN documentos docdoc ON 
        docdoc.id = doccob.id_documentofkdos  WHERE year(fecha_emision) = '$aniofecha' AND month(fecha_emision)= '$mesfecha';";
        $resultado = $mysqli->query($ssql);
        if ($resultado) {
        } else {
            $Global->salir_json(2, "ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
        }


        $ssql      = "DELETE docdoc.* FROM documentos  docdoc WHERE year(fecha_emision) = '$aniofecha' AND month(fecha_emision)= '$mesfecha'; ";
        $resultado = $mysqli->query($ssql);
        if ($resultado) {
        } else {
            $Global->salir_json(2, "ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
        }

        



        for($i = 1; $i <= 10000; $i++)
        {
          
		 
	
            $headers = array(
                'Content-Type:application/json',
                'Authorization: QEQZGLXMQ0AGtil1rW70UxsEfw4QKgLQgmzFkDwE6Pw'
            );

            $process = curl_init('https://api.contifico.com/sistema/api/v1/documento/?result_size=1000&result_page='.$i);
            curl_setopt($process, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($process, CURLOPT_HEADER, 1);
            curl_setopt($process, CURLOPT_TIMEOUT, 300);
            curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
            $return = curl_exec($process);
            curl_close($process);

            if($return =='')
            {
                $txt_contador = $txt_contador+ 1;
                $Global->salir_json_contador(1,"",$txt_contador);
            }

            $strln = explode("SAMEORIGIN",$return);
            $datosbancos = json_decode($strln[1], true);


         

            $conteo =  strlen($strln[1]);
            /** *VERIFICAMOS SI EXISTEN DATOS**/


          
            if($conteo > 6)
            {
                foreach ($datosbancos as $cliente) {   
                    
        

                         $fechaemis=$cliente['fecha_emision'];
                        if (substr($fechaemis, 6, 4) < date("Y") and substr($fechaemis, 3, 2)  < date("M")) {
                        } else {
                            


                            /** *VERIFICAMOS SI EXISTE EL DOCUMENTO **/
                            $cod =$cliente['id'];
                            $sql = 'SELECT * FROM documentos WHERE id = "' . $cod . '"';
                            $resultado = $mysqli->query($sql);
                            $n = $resultado->num_rows;
                            if ($n > 0) {
                                $validar = 'SI';
                            }
                            else
                            {
                                $validar = '';
                            }

                            $fechacreacion  = str_replace('/','-', $cliente['fecha_creacion']);
                            $fechavence     = str_replace('/','-', $cliente['fecha_vencimiento']);
                            $fecha_emision  = str_replace('/','-', $cliente['fecha_emision']);

                            $fechacreacion  = explode('-', $fechacreacion);
                            $fechacreacion  = $fechacreacion[2].'-'.$fechacreacion[1].'-'.$fechacreacion[0];


                            $fechavence  = explode('-', $fechavence);
                            $fechavence  = $fechavence[2].'-'.$fechavence[1].'-'.$fechavence[0];


                            $fecha_emision  = explode('-', $fecha_emision);
                            $fecha_emision  = $fecha_emision[2].'-'.$fecha_emision[1].'-'.$fecha_emision[0];

                            if ($validar==''){
                                
                                $ssql = "INSERT INTO documentos 
                                (
                                `iva`,
                                `tarjeta_consumo_id`, 
                                `pos`, 
                                `vendedor_id`, 
                                `logistica`,
                                `subtotal_0`, 
                                `ice`, 
                                `descripcion`,
                                `total`,
                                `id`, 
                                `subtotal_12`, 
                                `servicio`,
                                `referencia`, 
                                `tipo_domicilio`, 
                                `autorizacion`, 
                                `hora_evento`, 
                                `url_ride`,
                                `fecha_creacion`, 
                                `fecha_vencimiento`, 
                                `fecha_emision`, 
                                `documento`,
                                `url_xml`, 
                                `saldo`,   
                                `persona_id`, 
                                `tipo_documento`,
                                `electronico`, 
                                `anulado`,   
                                `tipo_registro`,
                                `estado`,
								`fecha_registro`,
								`hora_registro`
                                ) 
                                VALUES 
                                (
                                '".$cliente['iva']."',
                                '".$cliente['tarjeta_consumo_id']."',
                                '".$cliente['pos']."',
                                '".$cliente['vendedor_id']."',
                                '".$cliente['logistica']."',
                                '".$cliente['subtotal_0']."',
                                '".$cliente['ice']."',
                                '".$this->sanear_string($cliente['descripcion'])."',
                                '".$cliente['total']."',
                                '".$cliente['id']."',
                                '".$cliente['subtotal_12']."',
                                '".$cliente['servicio']."',
                                '".$cliente['referencia']."',
                                '".$cliente['tipo_domicilio']."',
                                '".$cliente['autorizacion']."',
                                '".$cliente['hora_evento']."',
                                '".$cliente['url_ride']."',
                                '".$fechacreacion."',
                                '".$fechavence."',
                                '".$fecha_emision."',
                                '".$cliente['documento']."',
                                '".$cliente['url_xml']."',
                                '".$cliente['saldo']."',
                                '".$cliente['persona_id']."',
                                '".$cliente['tipo_documento']."',
                                '".$cliente['electronico']."',
                                '".$cliente['anulado']."',
                                '".$cliente['tipo_registro']."',
                                '".$cliente['estado']."',
								'".date('Y-m-d')."',
								'".date("g:i:s-a")."'
                                )";



                                $resultado = $mysqli->query($ssql);
                                /*
                                if ($resultado) {
            
                                }
                                else
                                {
                                    $Global->salir_json(2,"ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
                                }
                                */


                                

                                /** *VERIFICAMOS SI EXISTE EL DETALLE**/
                                $sql = 'SELECT * FROM 	documentos_detalle WHERE id_documentofk = "'.$cod.'"';
                                $resultado1 = $mysqli->query($sql);
                                $n = $resultado1->num_rows;
                                if ($n <= 0) {

                                    for ($b = 0; $b < count($cliente['detalles']); $b++) {
                                    
                                       $calculo = ($cliente['detalles'][$b]['precio']*$cliente['detalles'][$b]['cantidad'])*($cliente['detalles'][$b]['porcentaje_descuento']/100);

                                       $ssql ="INSERT INTO `documentos_detalle`
                                                (
                                                `id_documentofk`,
                                                `porcentaje_iva`,
                                                `cantidad`,
                                                `producto_id`,
                                                `producto_nombre`,
                                                `base_cero`,
                                                `base_gravable`,
                                                `porcentaje_descuento`,
                                                `valor_descuento`,
                                                `precio`,
												`fecha_registro`,
								                `hora_registro`
                                                )
                                                VALUES 
                                                (
                                                '".$cliente['id']."',
                                                '".$cliente['detalles'][$b]['porcentaje_iva']."',
                                                '".$cliente['detalles'][$b]['cantidad']."',
                                                '".$cliente['detalles'][$b]['producto_id']."',
                                                '".$this->sanear_string($cliente['detalles'][$b]['producto_nombre'])."',
                                                '".$cliente['detalles'][$b]['base_cero']."',
                                                '".$cliente['detalles'][$b]['base_gravable']."',
                                                '".$cliente['detalles'][$b]['porcentaje_descuento']."',
                                                '".$calculo."',
                                                '".$cliente['detalles'][$b]['precio']."',
												'".date('Y-m-d')."',
												'".date("g:i:s-a")."'
                                                ) ";
                                                
                                                 $resultado2 = $mysqli->query($ssql);
                                                 /*
                                                 if ($resultado2) {
                             
                                                 }
                                                 else
                                                 {
                                                     $Global->salir_json(2,"ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
                                                 }
                                                 */
                                               

                                    }
                                } 
                                

                                $fecha = $cliente['fecha_creacion'];
                                /** *VERIFICAMOS SI EXISTE EL DETALLE COBRO**/
                                $sql = 'SELECT * FROM 	documentos_cobro WHERE id_documentofkdos  = "'.$cod.'"';
                                $resultado3 = $mysqli->query($sql);
                                $n = $resultado3->num_rows;
                                if ($n <= 0) {

                                    for ($a = 0; $a < count($cliente['cobros']); $a++) { 

                                        $fechavalcob = '';
                                        $fechacobro  = '';
                                        $fechavalcob = $cliente['cobros'][$a]['fecha'];
                                        $fechacobro  = substr($fecha, 6,4).'-'. substr($fecha, 3,2).'-'.substr($fecha, 0,2);


                                        $ssql ="INSERT INTO `documentos_cobro`
                                                           (
                                                            `id_documentofkdos`,
                                                            `forma_cobro`, 
                                                            `numero_comprobante`,
                                                            `caja_id`,
                                                            `monto`,
                                                            `numero_tarjeta`,
                                                            `fecha`,
                                                            `nombre_tarjeta`,
                                                            `tipo_banco`,
                                                            `cuenta_bancaria_id`,
                                                            `bin_tarjeta`,
                                                            `monto_propina`,
                                                            `numero_cheque`,
                                                            `tipo_ping`,
                                                            `id`,
                                                            `lote`,
															`fecha_registro`,
															`hora_registro`
                                                            ) 
                                                            VALUES 
                                                            (
                                                             '".$cliente['id']."',
                                                             '".$cliente['cobros'][$a]['forma_cobro']."',
                                                             '".$cliente['cobros'][$a]['numero_comprobante']."',
                                                             '".$cliente['cobros'][$a]['caja_id']."',
                                                             '".$cliente['cobros'][$a]['monto']."',
                                                             '".$cliente['cobros'][$a]['numero_tarjeta']."',
                                                             '".$fechacobro."',
                                                             '".$cliente['cobros'][$a]['nombre_tarjeta']."',
                                                             '".$cliente['cobros'][$a]['tipo_banco']."',
                                                             '".$cliente['cobros'][$a]['cuenta_bancaria_id']."' ,
                                                             '".$cliente['cobros'][$a]['bin_tarjeta']."',
                                                             '".$cliente['cobros'][$a]['monto_propina']."',
                                                             '".$cliente['cobros'][$a]['numero_cheque']."',
                                                             '".$cliente['cobros'][$a]['tipo_ping']."',
                                                             '".$cliente['cobros'][$a]['id']."',
                                                             '".$cliente['cobros'][$a]['lote']."',
															 '".date('Y-m-d')."',
															'".date("g:i:s-a")."') ";
                                                              $resultado4 = $mysqli->query($ssql);
                                                              /*
                                                              if ($resultado4) {
                                          
                                                              }
                                                              else
                                                              {
                                                                  $Global->salir_json(2,"ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
                                                              }

                                                              */
                                                             

                                    }
                                }
                            }
                            else
                            {

                            }
                        }   
                    
                }   

            }
            else
            {
                $i = 1000001;
            }
        }
        /** ACTUALIZAMOS FECHA EJECUCION**/

        $ssql      = "UPDATE proceso SET estado=0";
        $resultado5 = $mysqli->query($ssql);
        if ($resultado5) {
          
        } else {
            $Global->salir_json(2, "ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
        }


        $ssql      = "UPDATE proceso SET estatus=1 WHERE id ='5' ";
        $resultado6 = $mysqli->query($ssql);
        if ($resultado6) {
        } else {
            $Global->salir_json(2, "ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
        }
         
        $txt_contador = $txt_contador+ 1;
        $Global->salir_json_contador(1,"",$txt_contador);
    $mysqli->close();
 }


    /*=============================================
    PROCESO 6
    =============================================*/
    public function proceso6($txt_contador)
    {
        $dataxr       = array();
        $mysqli       = conexionMySQL();
        $Global       = new ModelGlobal();
        $concatenar   = '';
        set_time_limit(600000);

        $ssql      = "UPDATE proceso SET estado=1";
        $resultado = $mysqli->query($ssql);
        if ($resultado) {
          
        } else {
            $Global->salir_json(2, "ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
        }
        $ssql      = "UPDATE proceso SET estatus=2,estado=1,fecha_ejecucion='".date('d-m-Y')."' WHERE id ='".$txt_contador."' ";
        $resultado = $mysqli->query($ssql);
        if ($resultado) {
           
        } else {
            $Global->salir_json(2, "ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
        }


            $ssql      = "TRUNCATE TABLE bodegaproductos";
            $resultado = $mysqli->query($ssql);
            if ($resultado) {
            } else {
                $Global->salir_json(2, "ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
            }


            $sql = 'SELECT * FROM productos  ORDER BY codigo DESC';
            $resultado = $mysqli->query($sql);
            $n = $resultado->num_rows;
            if ($n > 0) {

                while($row = mysqli_fetch_assoc($resultado)) {


                    $productoidit = '';
                    $productoidit = $row["id"];

                    $headers = array(
                        'Content-Type:application/json',
                        'Authorization: QEQZGLXMQ0AGtil1rW70UxsEfw4QKgLQgmzFkDwE6Pw'
                    );

                    $process = curl_init('https://api.contifico.com/sistema/api/v1/producto/'.$productoidit.'/stock/');
                    curl_setopt($process, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($process, CURLOPT_HEADER, 1);
                    curl_setopt($process, CURLOPT_TIMEOUT, 30000);
                    curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
                    $return = curl_exec($process);
                    curl_close($process);

                    if($return =='')
                    {
                        $txt_contador = $txt_contador+ 1;
                        $Global->salir_json_contador(1,"",$txt_contador);
                    }

                    $strln = explode("SAMEORIGIN",$return);
                    $datosbancos = json_decode($strln[1], true);
            
                    foreach ($datosbancos as $cliente) {
						
						
							

                        $ssql1 = "INSERT INTO bodegaproductos
                                (
                                `id_bodegaproductos`,
                                `bodega_nombre`,
                                `bodega_id`, 
                                `producto_id`, 
                                `cantidad`,
								`fecha_registro`,
                                `hora_registro`
                                ) 
                                VALUES  
                                (
                                 NULL, 
                                 '".$this->sanear_string($cliente['bodega_nombre'])."',
                                 '".$cliente['bodega_id']."',
                                 '".$productoidit."',
                                 '".$cliente['cantidad']."',
								 '".date('Y-m-d')."',
								 '".date("g:i:s-a")."'
                                 )";
								 if($productoidit == 'lwKe58RB8rsJXd31')
						{
							$arch = fopen("ssql1.txt", "a+"); 
							fwrite($arch,$ssql1."\r\n");
							fclose($arch);
						}
								 
								 
                                 $resultado1 = $mysqli->query($ssql1);
                                 if ($resultado1) {
                                 } else {
                                     $Global->salir_json(2, "ERROR EN LA BASE DE DATOS CONSULTA " . $ssql1);
                                 }

                    }
                    
                }
            }

            
        
        /** ACTUALIZAMOS FECHA EJECUCION**/

        $ssql      = "UPDATE proceso SET estado=0";
        $resultado = $mysqli->query($ssql);
        if ($resultado) {
          
        } else {
            $Global->salir_json(2, "ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
        }


        $ssql      = "UPDATE proceso SET estatus=1 WHERE id ='6' ";
        $resultado = $mysqli->query($ssql);
        if ($resultado) {
        } else {
            $Global->salir_json(2, "ERROR EN LA BASE DE DATOS CONSULTA " . $ssql);
        }
         
        $txt_contador = $txt_contador+ 1;
        $Global->salir_json_contador(1,"",$txt_contador);
    $mysqli->close();
 }
 
 

}
?>