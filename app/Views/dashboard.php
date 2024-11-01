<section id="home" class="slider" data-stellar-background-ratio="0.5">
    <div class="container">
       <div class="row">
            <div class="owl-carousel owl-theme">
                <div class="item item-first">
                    <div class="caption">
                        <div class="col-md-offset-1 col-md-10">
                                <h3>Percayakan Noda Kendaraan Bersama Kami</h3>
                                <h1>LILKING - Car Wash</h1>
                                <a href="#about" class="section-btn btn btn-default smoothScroll">Tentang Kami</a>
                        </div>
                    </div>
                </div>

                <div class="item item-second">
                    <div class="caption">
                        <div class="col-md-offset-1 col-md-10">
                                <h3>Kinclongkan kendaraan anda hanya disini</h3>
                                <h1>LILKING - Car Wash</h1>
                                <a href="#appointment" class="section-btn btn btn-default btn-gray smoothScroll">Daftar Sekarang</a>
                        </div>
                    </div>
                </div>

                <div class="item item-third">
                    <div class="caption">
                        <div class="col-md-offset-1 col-md-10">
                                <h3>Dan Berikan Masukan Kepada Kami</h3>
                                <h1>Kepuasan Anda Adalah Semangat Kami</h1>
                                <a href="#saran" class="section-btn btn btn-default btn-blue smoothScroll">Kirim Saran</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="about-info">
                    <h2 class="wow fadeInUp" data-wow-delay="0.6s">Tentang Kami</h2>
                    <div class="wow fadeInUp" data-wow-delay="0.8s">
                        <p>LINGGA Carwash merupakan salah satu bidang usaha yang menawarkan jasa perawatan kendaraan berupa pencucian dan pembersihan kendaraan.</p>
                    </div>
                    <figure class="profile wow fadeInUp" data-wow-delay="1s">
                        <figcaption>
                            <h3>Dijamin Bersih</h3>
                        </figcaption>
                    </figure>
                    <figure class="profile wow fadeInUp" data-wow-delay="1s">
                        <figcaption>
                            <h3>Dijamin Kilat</h3>
                        </figcaption>
                    </figure>
                    <figure class="profile wow fadeInUp" data-wow-delay="1s">
                        <figcaption>
                            <h3>Dijamin Wangi</h3>
                        </figcaption>
                    </figure>
                    <figure class="profile wow fadeInUp" data-wow-delay="1s">
                        <figcaption>
                            <h3>Dijamin Puas</h3>
                        </figcaption>
                    </figure>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="saran">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <form id="saran-form" role="form" method="post" action="pages/proses_saran.php">
                    <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
                        <h2>Kritik dan Saran</h2>
                    </div>

                    <div class="wow fadeInUp" data-wow-delay="0.8s">
                        <div class="col-md-6 col-sm-6">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Anda" required="">
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email Anda">
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <label for="email">Pesan</label>
                            <input type="text" class="form-control" id="pesan" name="pesan" placeholder="Isi Pesan Anda" required="">
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <label for="email">Kebersihan</label>
                            <input type="number" class="form-control" id="email" name="kebersihan" placeholder="Nilai Point Kebersihan" maxlength="3" required="">
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <label for="email">Keramahan</label>
                            <input type="number" class="form-control" id="email" name="keramahan" placeholder="Nilai Point Keramahan" maxlength="3" required="">
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <label for="email">Ketelitian</label>
                            <input type="number" class="form-control" id="email" name="ketelitian" placeholder="Nilai Point Ketelitian" maxlength="3" required="">
                        </div>

                        <br><br><br><br><br>

                        <div class="col-md-12 col-sm-12">
                            <button type="submit" class="form-control" id="cf-submit" name="submit">Kirim Saran</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>