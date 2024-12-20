 <!-- Left side column. contains the logo and sidebar -->
 <?php $session = session(); ?>
 <aside class="main-sidebar">
     <!-- sidebar: style can be found in sidebar.less -->
     <section class="sidebar">
         <!-- Sidebar user panel -->
         <div class="user-panel">
             <div class="pull-left image">
                 <img src="<?= base_url() ?>assets/dist/img/cvlink.jpeg" class="img-circle" alt="User Image">
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
                 <a href="<?= base_url('surveyor') ?>">
                     <i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
             </li>
             <li>
                 <a href="<?= base_url('surveyor/view') ?>">
                     <i class="fa fa-dashboard"></i> <span>Hasil Survey</span>
                </a>
             </li>
             <li class="treeview">
                 <a href="#">
                     <i class="fa fa-edit"></i> <span>Master</span>
                     <span class="pull-right-container">
                         <i class="fa fa-angle-left pull-right"></i>
                     </span>
                 </a>
                 <ul class="treeview-menu">
                     <li><a href="<?= base_url() ?>infosurveyor"><i class="fa fa-circle-o"></i>Barang dan Jasa</a></li>
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