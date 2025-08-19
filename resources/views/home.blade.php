<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>

<body>

    <nav class="navbar fixed-top navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">EstadosMX</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-logout">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container container-table mt-4">
        <h2 class="mb-4 text-center">Lista de Estados</h2>
        <table id="estados-table" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Nombre Abreviado</th>
                    <th>Población total</th>
                </tr>
            </thead>
        </table>
    </div>

    <div class="modal fade" id="estadoModal" tabindex="-1" aria-labelledby="estadoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="estadoModalLabel">Detalles del Estado</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <ul id="estado-detalles" class="list-group list-group-flush"></ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary rounded-3"
                        data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    <script>
        $(document).ready(function () {
            let table = $('#estados-table').DataTable({
                ajax: {
                    url: "{{ route('estados.data') }}",
                    type: "GET",
                    dataType: "json",
                    dataSrc: function (json) {
                        if (!json.data || json.data.length === 0) {
                            Swal.fire({
                                icon: 'info',
                                title: 'Sin Datos',
                                text: 'No se encontraron registros de estados.'
                            });
                            return [];
                        }
                        return json.data;
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No se pudo cargar la información de estados.'
                        });
                    }
                },
                columns: [
                    { data: 'nom_agee' },
                    { data: 'nom_abrev' },
                    { data: 'pob' }
                ],
                pageLength: 10,
                paging: true,
                info: true,
                ordering: true,
                searching: true,
                responsive: true,
                responsive: {
                    details: {
                        type: 'column',  
                        target: 'tr'     
                    }
                },
                columnDefs: [
                    { className: 'dtr-control', orderable: false, targets: 0 } 
                ],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Buscar..."
                }
            });

            $('#estados-table tbody').on('click', 'tr', function () {
                let data = table.row(this).data();
                if (!data) return;

                let detalles = `
                    <li class="list-group-item"><strong>CVE GEO:</strong> ${data.cvegeo}</li>
                    <li class="list-group-item"><strong>CVE AGEE:</strong> ${data.cve_agee}</li>
                    <li class="list-group-item"><strong>Nombre:</strong> ${data.nom_agee}</li>
                    <li class="list-group-item"><strong>Nombre Abreviado:</strong> ${data.nom_abrev}</li>
                    <li class="list-group-item"><strong>Población Total:</strong> ${data.pob}</li>
                    <li class="list-group-item"><strong>Población Femenina:</strong> ${data.pob_fem}</li>
                    <li class="list-group-item"><strong>Población Masculina:</strong> ${data.pob_mas}</li>
                    <li class="list-group-item"><strong>Viviendas:</strong> ${data.viv}</li>
                `;

                $('#estado-detalles').html(detalles);
                let modal = new bootstrap.Modal(document.getElementById('estadoModal'));
                modal.show();
            });
        });
    </script>
</body>

</html>