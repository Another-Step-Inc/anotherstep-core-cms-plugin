<?php
$title    = $attributes['title'] ?? 'Operating Hours';
$weekday  = $attributes['weekdayHours'] ?? '9:00 - 17:00';
$saturday = $attributes['saturdayHours'] ?? '10:00 - 14:00';
$sunday   = $attributes['sundayHours'] ?? 'Closed';
?>

<div class="bg-surface-container-low p-8 rounded-xl">
  <h3 class="text-xl font-bold text-brand-blue mb-4 flex items-center gap-2">
    <span class="material-symbols-outlined" data-icon="schedule">schedule</span>
    <?php echo wp_kses_post($title); ?>
  </h3>
  <ul class="space-y-3 text-on-surface-variant">
    <li class="flex justify-between">
      <span>Monday - Friday</span>
      <span class="font-bold"><?php echo wp_kses_post($weekday); ?></span>
    </li>
    <li class="flex justify-between">
      <span>Saturday</span>
      <span class="font-bold"><?php echo wp_kses_post($saturday); ?></span>
    </li>
    <li class="flex justify-between">
      <span>Sunday</span>
      <span class="font-bold"><?php echo wp_kses_post($sunday); ?></span>
    </li>
  </ul>
</div>