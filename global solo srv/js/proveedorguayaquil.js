var parametros =
{
    "txt_option": '2',
    "table": "#table_clientes"

}
table_clientes(parametros);
function table_clientes(parametros) {

	$(parametros.table).dataTable().fnDestroy();
	var dt = $(parametros.table).DataTable({
		"processing": true,
		"paging": true,
		"lengthChange": true,
		"searching": true,
		"ordering": true,
		"info": true,
		"responsive": false,
		"autoWidth": false,
		"pageLength": 20,
		"ajax": {
			"url": "../../Controller/Controller_proveedorgye.php",
			"data": parametros,
			"type": "POST"
		},
		"columns":
			[
				{ "data": "id" },
				{ "data": "Nombre" },
                { "data": "Cedula" },
                { "data": "DocIess" },
                { "data": "Examen_seguridad" },
                { "data": "Antedentes" },
                { "data": "Razon_Social" },
                { "data": "Fecha_de_documentacion" },
                { "data": "fechaIngreso" },
                { "data": "fechaIngreso" },
                { "data": "Comentario" },
			]
	});
}


