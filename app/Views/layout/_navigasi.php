 <!-- Left side column. contains the logo and sidebar -->
 <?php $session = session(); ?>
 <aside class="main-sidebar">
     <!-- sidebar: style can be found in sidebar.less -->
     <section class="sidebar">
         <!-- Sidebar user panel -->
         <div class="user-panel">
             <div class="pull-left image">
                 <img src="<?= base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
             </div>
             <div class="pull-left info">
                 <p><?= $session->get('nama') ?></p>
                 <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
             </div>
         </div>
         <!-- search form -->
         <form action="#" method="get" class="sidebar-form">
             <div class="input-group">
                 <input type="text" name="q" class="form-control" placeholder="Search...">
                 <span class="input-group-btn">
                     <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                     </button>
                 </span>
             </div>
         </form>
         <!-- /.search form -->

         <!-- sidebar menu: : style can be found in sidebar.less -->
         <ul class="sidebar-menu">
             <li class="header">MAIN NAVIGATION</li>
             <li>
                 <a href="<?= base_url() ?>admin">
                     <i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
             </li>
             <li class="treeview">
                 <a href="#">
                     <i class="fa fa-edit"></i> <span>Master</span>
                     <span class="pull-right-container">
                         <i class="fa fa-angle-left pull-right"></i>
                     </span>
                 </a>
              <!--   <ul class="treeview-menu">
                     <li><a href="<?= base_url() ?>infouser"><i class="fa fa-circle-o"></i> User</a></li>
                 </ul>
                 <ul class="treeview-menu">
                     <li><a href="<?= base_url() ?>infokategori"><i class="fa fa-circle-o"></i>Kategori</a></li>
            </ul>-->
                 <ul class="treeview-menu">
                     <li><a href="<?= base_url() ?>infojasa"><i class="fa fa-circle-o"></i>Jasa</a></li>
                 </ul>
                 <ul class="treeview-menu">
                     <li><a href="<?= base_url() ?>infousers"><i class="fa fa-circle-o"></i>Pengguna</a></li>
                 </ul>
                 <ul class="treeview-menu">
                     <li><a href="<?= base_url() ?>infosurvei"><i class="fa fa-circle-o"></i>Survei</a></li>
                 </ul>
                 <ul class="treeview-menu">
                     <li><a href="<?= base_url() ?>infokontrak"><i class="fa fa-circle-o"></i>Kontrak</a></li>
                 </ul>
                 <ul class="treeview-menu">
                     <li><a href="<?= base_url() ?>infoinvoice"><i class="fa fa-circle-o"></i>Invoice</a></li>
                 </ul>
             </li>
             <li class="treeview">
                 <a href="#">
                     <i class="fa fa-table"></i> <span>Transaksi</span>
                     <span class="pull-right-container">
                         <i class="fa fa-angle-left pull-right"></i>
                     </span>
                 </a>
                 <ul class="treeview-menu">
                     <li><a href="<?= base_url() ?>infoinvoice"><i class="fa fa-circle-o"></i> Invoice</a></li>
                 </ul>
             </li>
             <li class="header">LAPORAN</li>
             <li>
                 <a href="<?= base_url() ?>infojurnal">
                     <i class="fa fa-list"></i> <span>Jurnal</span></a>
             </li>
         </ul>
     </section>
     <!-- /.sidebar -->
 </aside>