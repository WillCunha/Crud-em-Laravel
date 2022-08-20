<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
{{-- inicio do modal "adicionar funcionario" --}}
<div class="modal fade" id="addEmpregadoModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar Novo Empregado</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="add_empregado" enctype="multipart/form-data">
        @csrf
        <div class="modal-body p-4 bg-light">
          <div class="row">
            <div class="col-lg">
              <label for="pnomme">Primeiro nome</label>
              <input type="text" name="pnomme" class="form-control" placeholder="Primeiro Nome" required>
            </div>
            <div class="col-lg">
              <label for="unome">Último nome</label>
              <input type="text" name="unome" class="form-control" placeholder="último Nme" required>
            </div>
          </div>
          <div class="my-2">
            <label for="email">E-mail</label>
            <input type="email" name="email" class="form-control" placeholder="E-mail" required>
          </div>
          <div class="my-2">
            <label for="telefone">Telefone</label>
            <input type="tel" name="telefone" class="form-control" placeholder="Telefone" required>
          </div>
          <div class="my-2">
            <label for="post">Função</label>
            <input type="text" name="post" class="form-control" placeholder="Post" required>
          </div>
          <div class="my-2">
            <label for="avatar">Selecionar foto</label>
            <input type="file" name="avatar" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" id="adicionar_empregado_btn" class="btn btn-primary">Adicionar Empregado</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- fim do modal "adicionar funcionario" --}}

{{-- inicio do modal "editar funcionario" --}}
<div class="modal fade" id="editarEmpregado" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Empregado</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="editar_empregado" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="emp_id" id="emp_id">
        <input type="hidden" name="emp_avatar" id="emp_avatar">
        <div class="modal-body p-4 bg-light">
          <div class="row">
            <div class="col-lg">
              <label for="pnome">Primeiro nome</label>
              <input type="text" name="pnome" id="pnome" class="form-control" placeholder="Primeiro Nome" required>
            </div>
            <div class="col-lg">
              <label for="unome">Último Nome</label>
              <input type="text" name="unome" id="unome" class="form-control" placeholder="Último Nome" required>
            </div>
          </div>
          <div class="my-2">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="E-mail" required>
          </div>
          <div class="my-2">
            <label for="telefone">Telefone</label>
            <input type="tel" name="telefone" id="telefone" class="form-control" placeholder="Telefone" required>
          </div>
          <div class="my-2">
            <label for="post">Função</label>
            <input type="text" name="post" id="post" class="form-control" placeholder="Post" required>
          </div>
          <div class="my-2">
            <label for="avatar">Selecionar foto</label>
            <input type="file" name="avatar" class="form-control">
          </div>
          <div class="mt-2" id="avatar">

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" id="editar_empregado_btn" class="btn btn-success">Atualizar Empregado</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- fim do modal "editar funcionario" --}}

<body class="bg-light">
  <div class="container">
    <div class="row my-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header bg-danger d-flex justify-content-between align-items-center">
            <h3 class="text-light">Gerenciar empregados</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addEmpregadoModal"><i
                class="bi-plus-circle me-2"></i>Adicionar novo funcionário</button>
          </div>
          <div class="card-body" id="exibir_empregados">
            <h1 class="text-center text-secondary my-5">Carregando...</h1>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      $(function (){
        puxarEmpregados();

        function puxarEmpregados(){
            $.ajax({
                url: '{{ route('puxar') }}',
                method: 'get',
                success: function(res){
                    $('#exibir_empregados').html(res);
                    $("table").DataTable({
                        order: [0, 'desc']
                    });
                }
            });
        }

        $(document).on('click', '.deleteIcon', function(e){
            e.preventDefault();
            let id = $(this).attr('id');
            Swal.fire({
                title: 'Tem certeza?',
                text: "Você não poderá desfazer esta ação!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('deletar') }}',
                        method: 'post',
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(res){
                            Swal.fire(
                                'Concluído!',
                                'O empregado foi removido da lista com sucesso!',
                                'success'
                            )
                            puxarEmpregados();
                        }
                    })
                }
            })
        })
        $("#editar_empregado").submit(function (e){
          e.preventDefault();
          const fd = new FormData(this);
          $("#editar_empregado_btn").text("Aguarde, atualizando os dados!");
          $.ajax({
            url: '{{ route('atualizar') }}',
            method: 'post',
            data: fd,
            cache: false,
            processData: false,
            contentType: false,
            success: function(res){
                if(res.status == 200){
                    Swal.fire(
                        'Atualizado!',
                        'O empregado foi atualizado.',
                        'success'
                    )
                    puxarEmpregados();
                }
                $("#editar_empregado_btn").text("Atualizar Empregado");
                $("#editar_empregado")[0].reset();
                $("#editarEmpregado").modal("hide");

            }
          })
        })

        $(document).on('click', '.editIcon', function(e){
            e.preventDefault();
            let id = $(this).attr('id');
            $.ajax({
                url: '{{ route('editar') }}',
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res){
                    $("#pnome").val(res.primeiro_nome);
                    $("#unome").val(res.ultimo_nome);
                    $("#email").val(res.email);
                    $("#telefone").val(res.telefone);
                    $("#post").val(res.post);
                    $("#avatar").html(`<img src="storage/images/${res.imagem}" width="100" class="img-fluid img-thumbnail">`);
                    $("#emp_id").val(res.id)
                    $("#emp_avatar").val(res.imagem)
                }
            })
        })

        $("#add_empregado").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $("#adicionar_empregado_btn").text("Adicionando...");
            $.ajax({
                url: '{{route('store')}}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(res){
                    if(res.status == 200){
                        Swal.fire(
                            'Adicionado!',
                            'Empregado cadastrado com sucesso!',
                            'success',
                        )
                        puxarEmpregados();
                    }
                    $("#adicionar_empregado_btn").text("Adicionar Empregado");
                    $("#add_empregado")[0].reset();
                    $("#addEmpregadoModal").hide();
                }
            })
        });
      })
    </script>
</body>
</html>
