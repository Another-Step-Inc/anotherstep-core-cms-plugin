<?php
$section_title     = ! empty( $attributes['sectionTitle'] ) ? $attributes['sectionTitle'] : 'Upcoming Events';
$side_title        = ! empty( $attributes['sideTitle'] ) ? $attributes['sideTitle'] : 'New York City / Westchester News & Events';
$side_desc         = ! empty( $attributes['sideDescription'] ) ? $attributes['sideDescription'] : '';
$save_the_date     = ! empty( $attributes['saveTheDateText'] ) ? $attributes['saveTheDateText'] : 'Save the Date!';
$meeting_title     = ! empty( $attributes['meetingTitle'] ) ? $attributes['meetingTitle'] : 'Monthly Regional Meetings';
$meeting_desc      = ! empty( $attributes['meetingDescription'] ) ? $attributes['meetingDescription'] : '';
$in_person_title   = ! empty( $attributes['inPersonTitle'] ) ? $attributes['inPersonTitle'] : 'Join In Person';
$in_person_details = ! empty( $attributes['inPersonDetails'] ) ? $attributes['inPersonDetails'] : '';
$digital_title     = ! empty( $attributes['digitalTitle'] ) ? $attributes['digitalTitle'] : 'Join Digitally';
$zoom_url          = ! empty( $attributes['zoomUrl'] ) ? $attributes['zoomUrl'] : '#';
$zoom_button_text  = ! empty( $attributes['zoomButtonText'] ) ? $attributes['zoomButtonText'] : 'Launch Zoom Meeting';
$phone_text        = ! empty( $attributes['phoneText'] ) ? $attributes['phoneText'] : 'By Phone:';
$phone_details     = ! empty( $attributes['phoneDetails'] ) ? $attributes['phoneDetails'] : '';
$meeting_id        = ! empty( $attributes['meetingId'] ) ? $attributes['meetingId'] : '';

$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => 'py-24 bg-surface', 'id' => 'self-advocacy' ) );
?>

<section <?php echo $wrapper_attributes; ?>>
  <div class="max-w-7xl mx-auto px-6 md:px-12">
    <div class="flex flex-col lg:flex-row gap-12 items-start">
      
      <!-- Left Column / Sidebar -->
      <div class="lg:w-1/3">
        <div class="flex items-center gap-3 mb-6">
          <span class="material-symbols-outlined text-brand-blue text-3xl">calendar_month</span>
          <h2 class="text-[2.5rem] font-display font-black text-on-surface tracking-tight">
            <?php echo wp_kses_post( $section_title ); ?>
          </h2>
        </div>
        
        <div class="bg-brand-blue-container/5 p-8 rounded-xl border border-brand-blue/10">
          <h3 class="text-xl font-bold text-brand-blue mb-4">
            <?php echo wp_kses_post( $side_title ); ?>
          </h3>
          <p class="text-on-surface-variant mb-6 leading-relaxed">
            <?php echo wp_kses_post( $side_desc ); ?>
          </p>
          <div class="flex items-center gap-2 text-brand-red font-bold">
            <span class="material-symbols-outlined">notification_important</span>
            <span><?php echo wp_kses_post( $save_the_date ); ?></span>
          </div>
        </div>
      </div>

      <!-- Right Column / Grid -->
      <div class="lg:w-2/3 grid grid-cols-1 md:grid-cols-2 gap-8">
        
        <!-- Regional Meetings Banner -->
        <div class="bg-surface-container-low p-8 rounded-xl organic-shadow md:col-span-2">
          <h3 class="text-xl font-bold text-on-surface mb-4 flex items-center gap-2">
            <span class="material-symbols-outlined text-brand-blue">event_repeat</span>
            <?php echo wp_kses_post( $meeting_title ); ?>
          </h3>
          <p class="text-body-lg text-on-surface-variant mb-4">
            <?php echo wp_kses_post( $meeting_desc ); ?>
          </p>
        </div>

        <!-- Join In Person -->
        <div class="bg-surface-container-lowest p-8 rounded-xl border border-outline-variant/20">
          <h4 class="font-bold text-brand-blue mb-4 flex items-center gap-2">
            <span class="material-symbols-outlined">location_on</span>
            <?php echo wp_kses_post( $in_person_title ); ?>
          </h4>
          <p class="text-sm text-on-surface-variant leading-relaxed">
            <?php echo wp_kses_post( $in_person_details ); ?>
          </p>
        </div>

        <!-- Join Digitally -->
        <div class="bg-surface-container-lowest p-8 rounded-xl border border-outline-variant/20 flex flex-col">
          <h4 class="font-bold text-brand-blue mb-4 flex items-center gap-2">
            <span class="material-symbols-outlined">videocam</span>
            <?php echo wp_kses_post( $digital_title ); ?>
          </h4>
          <div class="space-y-4">
            <a class="bg-brand-blue text-on-brand-blue rounded-full px-6 py-3 font-bold text-center block hover:bg-brand-blue-container transition-colors" href="<?php echo esc_url( $zoom_url ); ?>" target="_blank">
              <?php echo wp_kses_post( $zoom_button_text ); ?>
            </a>
            <div class="text-xs text-on-surface-variant">
              <p class="font-bold mb-1"><?php echo wp_kses_post( $phone_text ); ?></p>
              <p><?php echo wp_kses_post( $phone_details ); ?></p>
              <p><?php echo wp_kses_post( $meeting_id ); ?></p>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</section>