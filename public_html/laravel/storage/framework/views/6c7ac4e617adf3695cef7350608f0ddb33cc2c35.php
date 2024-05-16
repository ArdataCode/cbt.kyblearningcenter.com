<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    $template = App\Models\Template::where('id','<>','~')->first();
  ?>
  <title><?php echo e($template->nama); ?></title>
  <link href="<?php echo e(asset('image/global/icon.png')); ?>" rel="icon">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="<?php echo e(asset('css/skydash.css')); ?>">
</head>
<body>

</body>
<script src="https://kit.fontawesome.com/f121295e13.js" crossorigin="anonymous"></script>
<script>
	  // Initialize tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})

setTimeout( function(){
	window.location.href="<?php echo e(url('login')); ?>";
},0);
</script>
</html>


<?php /**PATH /home/1124801.cloudwaysapps.com/yvvguagumn/public_html/laravel/resources/views/utama/Home.blade.php ENDPATH**/ ?>