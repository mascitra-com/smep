<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sistem Monitoring dan Evaluasi Proyek Pemerintah Kabupaten Lumajang</title>
    <link rel="stylesheet" href="<?php echo base_url('libs/build/login/')?>/bootstrap.min.css">
    <style type="text/css">
        html, body {
            background-color: #333;
        }

        .row-full {
            height: 100vh;
            max-height: 100vh;
            overflow:hidden;
        }

        .box {
            box-shadow: 0px 1px 5px rgba(0,0,0,.5);
            border-radius: 5px;
            background-color: #FFF;
        }

        .bg-info, .bg-info *{
            color: #FFF;
        }

        h1,h2,h3,h4{
            font-weight: bolder;
        }

        .alert {
            width: 100%;
            position: absolute;
            top: 0;
            z-index: 9999;
            border-radius: 0
        }

        @media (max-width: 767px) {
            .row-full {
                overflow-y:auto;
            }

            .box{border-radius: 0}
        }
    </style>
</head>
<body>
<!-- MESSAGE -->
<div class="container-fluid">
    <div class="row row-full align-items-center justify-content-center">
        <div class="col-12 col-md-8">
            <div class="row box">
                <div class="col-12 col-md-6">
                    <form action="<?php echo base_url('index.php/login/proses')?>" method="POST" class="px-4 py-4">
                        <input type='hidden' name='csrf_token' value='f150e92d934e5ab4bad432b925a065b7'>
                        <h1 class="mb-0">LOGIN</h1>

                        <div class="form-group mt-4">
                            <label for="">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Isi Username" required/>
                        </div>
                        <div class="form-group">
                            <label for="">Kata sandi</label>
                            <input type="password" name="password" class="form-control" placeholder="Isi Password" required/>
                        </div>
                        <div class="form-group">
                            <label for="">Tahun</label>
                            <select name="tahun_anggaran" class="form-control">
                                <?php for ($i = date('Y'); $i >= 2017; $i--) { ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary mr-2">Masuk</button>
                            <a href="#">Lupa password?</a>
                        </div>
                    </form>
                </div>
                <div class="col-12 col-md-6 bg-info">
                    <div class="px-3 py-5" style="text-align: center">
                        <h5 class="mb-4">Selamat Datang</h5>
                        <img src="http://3.bp.blogspot.com/-mMNrsf9QAks/UHFy4Np-wsI/AAAAAAAAGzM/P9bYoHH5p88/s1600/LOGO+KABUPATEN+LUMAJANG.png"
                             alt="Logo Kabupaten Lumajang" class="img-responsive" width="100px"></br></br>
                        <h2>Sistem Monitoring dan Evaluasi Proyek</h2>
                        <h2>Kabupaten Lumajang</h3>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url('libs/vendors/jquery/dist/') ?>/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('libs/build/login/') ?>/bootstrap.min.js"></script>
</body>
</html>