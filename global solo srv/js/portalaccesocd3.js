
/*=============================================
TABLE ESTACIONES
=============================================*/
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
			"url": "../../Controller/Controller_cd3.php",
			"data": parametros,
			"type": "POST"
		},
		"columns":
			[
				{ "data": "id" },
				{ "data": "Nombre" },
                { "data": "Cedula" },
                { "data": "estado" },
                { "data": "Antedentes" },
                { "data": "fechaIngreso" },
                { "data": "fecha" },
                { "data": "cd" },
                { "data": "Comentario" },
			]
	});
}

