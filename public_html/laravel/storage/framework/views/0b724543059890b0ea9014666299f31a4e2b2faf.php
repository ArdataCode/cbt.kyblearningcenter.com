

<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card card-border">
        <div class="card-body">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo e(url('home')); ?>"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item active" aria-current="page">Paket Saya</li>
            </ol>
          </nav>
          <p class="card-description">
            <h3 class="font-weight-bold"><b>Pilih Kategori Paket Belajar</b></h3>
          </p>
          <div class="row mt-4">
            <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 grid-margin stretch-card">
              <a href="<?php echo e(url('paketsayasubktg')); ?>/<?php echo e(Crypt::encrypt($key->id)); ?>" class="hrefpaket">
                <div class="card card-border" style="height: 100%;">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-6">
                        <i class="p-2 ti-layers-alt iconpaket"></i>
                      </div>
                      <div class="col-6 text-right">
                        <i class="ti-arrow-top-right"></i>
                      </div>
                    </div>
                    <div class="mt-4">
                      <h4><b><?php echo e($key->judul); ?></b></h4>
                      <h6><?php echo e($key->ket); ?></h6>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 grid-margin stretch-card">
              <a href="<?php echo e(url('paketgratis')); ?>" class="hrefpaket">
                <div class="card card-border" style="height: 100%;">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-6">
                        <i class="p-2 ti-layers-alt iconpaket"></i>
                      </div>
                      <div class="col-6 text-right">
                        <i class="ti-arrow-top-right"></i>
                      </div>
                    </div>
                    <div class="mt-4">
                      <h4><b>Paket Gratis</b></h4>
                      <h6></h6>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
<!-- SweetAlert2 -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  // Initialize tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
  $(document).ready(function(){
    $(document).on('click', '.btn-kerjakan', function (e) {

    });
  });
</script>
<!-- Loading Overlay -->
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.Skydash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/1124801.cloudwaysapps.com/yvvguagumn/public_html/laravel/resources/views/user/paketsayaktg.blade.php ENDPATH**/ ?>