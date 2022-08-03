<?php include 'template/header.php';?>
<?php 
if(!empty($_POST['add_barang'])){
    $id = $_POST['id_barang'];
    $nama = $_POST['nama_barang'];
    $harga = $_POST['harga_barang'];
    $tgl = $_POST['tgl_input'];
    $hargaasli = $_POST['harga_asli'];
    $stok = $_POST['stok'];
    
    mysqli_query($conn,"insert into barang values('','$id','$nama','$harga','$tgl','$hargaasli','$stok')")
    or die(mysqli_error($conn));
    echo '<script>window.location="barang.php"</script>';
}

$query = mysqli_query($conn, "SELECT max(id_barang) as kodeTerbesar FROM barang");
$data = mysqli_fetch_array($query);
$kodeBarang = $data['kodeTerbesar'];
$urutan = (int) substr($kodeBarang, 3, 3);
$urutan++;
$huruf = "BRG";
$kodeBarang = $huruf . sprintf("%03s", $urutan);
?>

  <div class="col-md-9 mb-2">
    <div class="row">

    <!-- barang -->
    <div class="col-md-12 mb-3">
        <div class="card">
        <div class="card-header bg-purple">
                <div class="card-tittle text-white"><i class="fa fa-shopping-cart"></i> <b>Tambah Barang</b></div>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label><b>Kode Barang</b></label>
                        <input type="text" name="id_barang" class="form-control" value="<?php echo $kodeBarang;?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                        <label><b>Nama Barang</b></label>
                        <input type="text" name="nama_barang" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                        <label><b>Harga Barang</b></label>
                        <input type="number" name="harga_barang" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                        <label><b>Tanggal Input</b></label>
                            <div class="input-group">
                                <input type="text" name="tgl_input" class="form-control" value="<?php echo  date("j F Y, G:i");?>" readonly>
                                <div class="input-group-append">
                                    <button name="add_barang" value="simpan" class="btn btn-purple" type="submit">
                                    <i class="fa fa-plus mr-2"></i>Tambah</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                        <label><b>Harga asli</b></label>
                        <input type="number" name="harga_asli" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                        <label><b>stok</b></label>
                        <input type="number" name="" class="form-control" required>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end barang -->


    <!-- table barang -->
    <div class="col-md-12 mb-2">
        <div class="card">
        <div class="card-header bg-purple">
                <div class="card-tittle text-white"><i class="fa fa-table"></i> <b>Data Barang</b></div>
            </div>
            <div class="card-body">
            <table class="table table-striped table-bordered table-sm dt-responsive nowrap" id="table_barang" width="100%">
                        <thead class="thead-purple">
                            <tr>
                                <th>No</th>
                                <th>Id Barang</th>
                                <th>Nama Barang</th>
                                <th>Harga barang</th>
                                <th>Tanggal Input</th>
                                <th>harga asli</th>
                                <th>stok</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                       
                       $totalBeli = 0;
                       $totalJual = 0;
                       $totalStok = 0;
                       if($_GET['stok'] == 'yes')
                       {
                           $hasil = $lihat -> barang_stok();

                       }else{
                           $hasil = $lihat -> barang();
                       }
                       $no=1;
                       foreach($hasil as $isi) {
                   ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d['id_barang']; ?></td>
                            <td><?php echo $d['nama_barang']; ?></td>
                            <td><?php echo $d['harga_barang']; ?></td>
                            <td><?php echo $d['tgl_input']; ?></td>
                           
						</tr>
                        <?php }?>
					</tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end table barang -->

    </div><!-- end row col-md-9 -->
  </div>
  <?php 
	include 'config.php';
	if(!empty($_GET['id'])){
		$id= $_GET['id'];
		$hapus_data = mysqli_query($conn, "DELETE FROM barang WHERE id_barang ='$id'");
		echo '<script>window.location="barang.php"</script>';
	}

?>
<?php include 'template/footer.php';?>
