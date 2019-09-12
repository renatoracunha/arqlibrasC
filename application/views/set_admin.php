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

    function loadDataInTable(value){
      var lines = '';
      lines+='<tr>';

      lines+='<td>'+value.nome+'</td>';
      lines+='<td>'+value.cpf+'</td>';
      lines+='<td>';
      if (value.admin=='T') {
        lines+='<button onclick="set_satus_admin('+value.id+',1)" class="btn btn-danger">X</button>';
      }else{
        lines+='<button onclick="set_satus_admin('+value.id+',0)" class="btn btn-success">+</button>';
      }
      
      
      lines+='</td>';
      
      lines+='</tr>'; 
      
      return lines;
    }

    function loadData(status = 'T'){

     $.ajax({
      url: "<?php echo site_url();?>arqlibras/ajax_get_users",
      data:{status:status},
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
         $("#tabela tbody").append('<td colsplan="4">Não há outro admin no sistema. Adicione um na outra aba</td>');
       }
     },error:function(e){
      alert('erro');
    }
  })
   }

   function loadDataByNome(){
    nome = $('#pesquisar_nome').val();
    if (nome) {
      $('#div_btn_group').hide();
    }else{
      $('#div_btn_group').show();
    }
    $.ajax({
      url: "<?php echo site_url();?>arqlibras/ajax_get_users_by_name",
      data:{nome:nome},
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
         $("#tabela tbody").append('<td colsplan="4">Não há outro admin no sistema. Adicione um na outra aba</td>');
       }
     },error:function(e){
      alert('erro');
    }
  })
  }

  function set_satus_admin(id_item,status){
    status = status==1?'F':'T';
    $.ajax({
      url: "<?php echo site_url();?>arqlibras/ajax_set_satus_admin",
      dataType:"json",
      type:"get",
      data:{id_item:id_item,status:status},
      cache:false,
      success:function(data){
        loadData(status);
      },error:function(e){
        alert('erro');
      }
    })
  }

/*  function unset_admin(id_item){
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
  }*/
  /*function get_input_name(){
     // $('#brand').toggle();     
     $('#pesquisar_nome').toggle();                   
   }   */

   function hide_div_btn(){
    
   }
 </script>
 <style type="text/css">
   #div_search_name{
    margin: 3% auto;
    width: 70%;

  }
  #div_btn_group{
    margin: 0 28%;
    width: 50%
  }
</style>
</head>
<body style="background-color: black">
  <div id="header">
    <?php $this->load->view('navbar.php') ?>
  </div>
  <div class="col-lg-12">
    <h3 style="text-align: center;color: white;margin-top: 10px">GERENCIAR ADMINS</h3>
  </div>

  <div class="container"> 
   <div id="div_search_name">
    <input id="pesquisar_nome" class="form-control" type="search" onkeyup="loadDataByNome()" onblur="hide_div_btn()" placeholder="Pesquisar usuário por nome" aria-label="Pesquisar">
    <!--  <button type="button" class="btn btn-dark" id="btn_search" onclick="get_input_name()">pesquisar</button>-->
  </div> 
  <div id="div_btn_group">
    <div style="" class="btn-group" role="group" >
      <button type="button"  onclick="loadData('T')" class="btn btn-secondary">Admins</button>
      <button type="button" id="btn_users" onclick="loadData('F')" class="btn btn-secondary">Usuários</button>
    </div>
  </div>
  <div class="col-lg-12">
    <table style="color:white" id="tabela" class="table table-hover table-striped">
      <thead>
        <tr>
          <th>Nome</th>
          <th>CPF</th>
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