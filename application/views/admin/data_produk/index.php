<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('admin/header');
?>
<!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Produk
                <small>Administrator</small>
            </h1>
            
            <ol class="breadcrumb">

                <li><a href="#"><i class="fa fa-dashboard"></i> Master Data</a></li>
                <li class="active">Produk</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Small boxes (Stat box) -->
            <div class="row">

              <div class="col-lg-4">
                  <a href="<?php echo base_url('admin/produk/create/')?>" class="btn btn-sm btn-warning">Tambah Produk <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- /.row -->
            <br/>
            <!-- Main row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-user"></i> Data Produk </h3> 

                        </div>
                        <div class="panel-body col-12">
                         <div class="table-responsive">

                          <table id="table" class="table table-hover table-bordered">
                              <thead>
                                  <tr>
                                    <th><center>No </center></th>
                                    <th><center>Nama Barang </i></center></th>
                                    <th><center>Stok </center></th>
                                    <th><center>Harga </center></th>
                                    <th><center>Deskripsi </center></th>
                                     <th><center>Ukuran </center></th>
                                    <th><center>Gambar </center></th>
                                    <th><center>Tools</center></th>

                                </tr>
                            </thead>

                        </tbody>
                        <?php $no=1; ?>
                        <?php foreach ($data as $key) {
                            ?>
                            <tr><td><?php echo $no++; ?></td>
                                <td><a href="<?php echo base_url('admin/produk/detail/'.$key->id_barang)?>"><span class="glyphicon glyphicon-tag"></span> 
                                    <?php echo $key->nama_barang ?></td>
                                    <td><?php echo $key->stok ?></td>
                                    <td><center><?php echo $key->harga_sewa ?></center></td>
                                    <td><center><?php echo $key->deskripsi ?></center></td>
                                     <td><center><?php echo $key->ukuran ?></center></td>
                                    <td><center><img src="<?= base_url('assets/uploads/produk/').$key->gambar_barang ?>" alt="placeholder+image" style="width:100px;max-width:200px" /></center></td>

                                    <td><center><div id="thanks"><a class="btn btn-sm btn-primary" data-placement="bottom" data-toggle="tooltip" title="Edit Produk" href="<?php echo base_url('admin/produk/update/'.$key->id_barang)?>"><span class="glyphicon glyphicon-edit"></span></a>  

                                        <a onclick="return confirm ('Yakin hapus <?php echo $key->nama_barang ?>');" class="btn btn-sm btn-danger tooltips" data-placement="bottom" data-toggle="tooltip" title="Hapus Produk" href="<?php echo base_url('admin/produk/delete/'.$key->id_barang)?>"><span class="glyphicon glyphicon-trash"></a></center>
                                        </td></tr>

                                        <?php $no++ ?>
                                    <?php } ?>

                                </tbody>
                            </table>
                          
                      </div> 
                  </div>
              </div><!-- col-lg-12--> 
          </div><!-- /.row (main row) -->

      </section><!-- /.content -->
  </aside><!-- /.right-side -->
</div><!-- ./wrapper -->
<?php $this->load->view('admin/footer'); ?>
