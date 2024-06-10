<?php

include 'init.php'; // Veritabanı bağlantı dosyasını dahil edin

// Kullanıcı oturumu kontrolü ve rol kontrolü
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] != 1)) {
    echo "Bu sayfayı görüntüleyemezsiniz";
    exit();
}
?>
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
<div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Hakkımızda | Yeni Ekle</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                          <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form method="POST">
                  <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Başlık</label>
                        <input type="text" class="form-control" name="title">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Açıklama</label>
                        <textarea class="form-control" rows="5" name="description"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <!-- select -->
                      <div class="form-group">
                        <label>Durum</label>
                        <select class="form-control" name="statu[]">
                          <option value="1">Aktif</option>
                          <option value="2">Pasif</option>
                        </select>
                      </div>
                    </div>

                  </div>
                  <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal">KAPAT</button>
              <button type="submit" class="btn btn-success">KAYDET</button>
              <input type="hidden" name="save" value="1001">
            </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- general form elements disabled -->
            </div>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
