<?php

include 'init.php'; // Veritabanı bağlantı dosyasını dahil edin
include 'header2.php';

?>



  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DUYURULAR</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
 <?php   
    if( isset($_POST["save"])){
      if(+$_POST['save'] == 1001 ){
        $title=$adminclass->getSecurity($_POST['title']);
        $description = $adminclass->getSecurity($_POST['description']);
        $adddate = date('Y-m-d H:i:s');
        $user_id=1;
        $statu = $adminclass->getSecurity($_POST['statu'][0]);
        $sql = "INSERT INTO qp_about( title, description, adddate, user_id, statu) VALUES (?,?,?,?,?)";
        $args = [$title,$description, $adddate, $user_id, $statu];
        $result = $adminclass->getSecurity($args);
        print $adminclass->pdoInsert($sql,$result);
      }
    }
    
    
  ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">


            <div class="card">
              <div class="card-header">
                 
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>id</th>
                    <th>Başlık</th>
                    <th>Açıklama</th>
                    <th>Durum</th>
                    <th>Tarih</th>
                  </tr>
                  </thead>
                  <tbody>
<?php $variable = $adminclass->getAbout(); foreach($variable as $value){ ?>
                  <tr>
                   <td><?php print $value['id']; ?></td>
                   <td><?php print $value['title']; ?></td>
                   <td><?php print $value['description']; ?></td>
                   <td><?php print $value['statu']; ?></td>
                   <td><?php print $value['adddate']; ?></td>
                  </tr>
<?php } ?>                  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>id</th>
                    <th>Başlık</th>
                    <th>Açıklama</th>
                    <th>Durum</th>
                    <th>Tarih</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <li class="nav-item">
                <a class="nav-link" href="yeni_ekle.php"> Yeni Ekle</a>
              </li>
  