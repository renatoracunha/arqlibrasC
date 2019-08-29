<!DOCTYPE html>
<html lang="pt-br">
<head>
  <!-- Meta tags Obrigatórias -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.css') ?>">
  <!-- JavaScript (Opcional) -->
  <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
  <script src="<?php echo base_url('js/jquery.js') ?>"></script>
  <script src="<?php echo base_url('js/popper.js') ?>"></script>
  <script src="<?php echo base_url('js/bootstrap.js') ?>"></script>
  <script src="https://kit.fontawesome.com/8d24bc018e.js"></script>

  <title>Arqlibras!</title>
  <script type="text/javascript">
    $(document).ready(function(){
      loadData();
    });

    function editar(id_item){
      window.location.href = './editarPalavra/'+id_item; 
    }

    function loadDataInTable(value){
      var lines = '';
      lines+='<tr>';

      lines+='<td>'+value.palavra+'</td>';
      lines+='<td>';
      lines+='<button style="margin-right:4px;" onclick="editar('+value.id+')" class="btn btn-primary">E</button>';
      if (value.ativo=='T') {
        lines+='<button onclick="desabilitar('+value.id+')" class="btn btn-danger">X</button>';
      }else{
        lines+='<button onclick="habilitar('+value.id+')" class="btn btn-success">+</button>';
      }
      
      
      lines+='</td>';
      
      lines+='</tr>'; 
      
      return lines;
    }

    function loadData(status = 1){
     let url = 'ajax_get_editar_listar_palavras_ativas';
     if (status != 1) {
       url = 'ajax_get_editar_listar_palavras_inativas';
     }
     $.ajax({
      url: "<?php echo site_url();?>arqlibras/"+url+"",
      dataType:"json",
      type:"get",
      cache:false,
      success:function(data){
        var lines = '';
        $.each(data,function(index,value){
          lines+= loadDataInTable(value);
        });

        if (lines) {
          $("#tabela tbody").html('');
          $("#tabela tbody").append(lines);
        }else{
         $("#tabela tbody").html('');
         $("#tabela tbody").append('<td colsplan="2">Não há vídeos com esse status</td>');
       }
     },error:function(e){
      alert('erro');
    }
  })
   }

   function desabilitar(id_item){
    $.ajax({
      url: "<?php echo site_url();?>arqlibras/ajax_desabilitar_itens",
      dataType:"json",
      type:"get",
      data:{id_item:id_item},
      cache:false,
      success:function(data){
        loadData();
      },error:function(e){
        alert('erro');
      }
    })
  }

  function habilitar(id_item){
    $.ajax({
      url: "<?php echo site_url();?>arqlibras/ajax_habilitar_itens",
      dataType:"json",
      type:"get",
      data:{id_item:id_item},
      cache:false,
      success:function(data){
        loadData(0);
      },error:function(e){
        alert('erro');
      }
    })
  }
</script>

</head>
<body style="background-color: black">
  <div id="header">
    <?php $this->load->view('navbar.php') ?>
  </div>
  <div class="col-lg-12">
    <h3 style="text-align: center;color: white;margin-top: 10px">GERENCIAR PALAVRAS</h3>
  </div>
  <div class="container">  
    <div style="left:25%" class="btn-group" role="group" >
      <button type="button" onclick="loadData(1)" class="btn btn-secondary">Ativos</button>
      <button type="button" onclick="loadData(0)" class="btn btn-secondary">Inativos</button>
    </div>
    <div class="col-lg-12">
      <table style="color:white" id="tabela" class="table table-hover table-striped">
        <thead>
          <tr>
            <th>Palavra</th>
            <th>Opções</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table> 
    </div>
  </div>



</body>
</html>