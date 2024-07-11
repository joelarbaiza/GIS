
    /***********************************************************************************************************************************
                                                    Inicializar Datatable tb_poligono
************************************************************************************************************************************/
$(function () {
    $("#tb_poligono")
      .DataTable({
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true,
        language: {
          decimal: "",
          emptyTable: "No hay datos disponibles en la tabla",
          info: "Mostrando _START_ a _END_ de _TOTAL_ entradas",
          infoEmpty: "Mostrando 0 a 0 de 0 entradas",
          lengthMenu: "Mostrar _MENU_ entradas",
          infoFiltered: "",
          infoPostFix: "",
          thousands: ",",
          loadingRecords: "Cargando...",
          processing: "Procesando...",
          search: "Buscar:",
          zeroRecords: "No se encontraron registros coincidentes",
          oPaginate: {
            sFirst: "Primero",
            sLast: "Último",
            sNext: "Siguiente",
            sPrevious: "Anterior",
          },
        },
      })
      
  });
