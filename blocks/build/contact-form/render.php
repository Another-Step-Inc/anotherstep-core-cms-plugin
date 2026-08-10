<?php
$title    = $attributes['title'] ?? 'Send a Message';
$subtitle = $attributes['subtitle'] ?? 'Tell us how we can best support you today.';
?>

<div class="md:col-span-2">
  <div class="bg-surface-container-lowest p-10 md:p-14 rounded-xl shadow-[0_32px_64px_-16px_rgba(0,0,0,0.06)] relative overflow-hidden border border-outline-variant/10">
    <div class="absolute -top-24 -right-24 w-64 h-64 bg-brand-blue-fixed opacity-20 rounded-full blur-3xl"></div>
    <h2 class="text-3xl font-black text-brand-blue mb-2"><?php echo wp_kses_post($title); ?></h2>
    <p class="text-on-surface-variant mb-10 text-lg"><?php echo wp_kses_post($subtitle); ?></p>
    
    <form class="space-y-8" action="#" method="POST">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="space-y-2">
          <label class="block text-brand-blue font-bold text-lg ml-1">Full Name</label>
          <input class="w-full bg-surface-container-high border-none rounded-xl px-6 py-5 text-lg focus:ring-4 focus:ring-brand-blue-fixed-dim transition-all outline-none" placeholder="Your Name" type="text" name="full_name" required>
        </div>
        <div class="space-y-2">
          <label class="block text-brand-blue font-bold text-lg ml-1">Email Address</label>
          <input class="w-full bg-surface-container-high border-none rounded-xl px-6 py-5 text-lg focus:ring-4 focus:ring-brand-blue-fixed-dim transition-all outline-none" placeholder="email@example.com" type="email" name="email" required>
        </div>
      </div>
      <div class="space-y-2">
        <label class="block text-brand-blue font-bold text-lg ml-1">How can we help?</label>
        <select class="w-full bg-surface-container-high border-none rounded-xl px-6 py-5 text-lg focus:ring-4 focus:ring-brand-blue-fixed-dim transition-all outline-none appearance-none" name="subject">
          <option>General Inquiry</option>
          <option>Technical Support</option>
          <option>Service Information</option>
          <option>Billing Question</option>
        </select>
      </div>
      <div class="space-y-2">
        <label class="block text-brand-blue font-bold text-lg ml-1">Message</label>
        <textarea class="w-full bg-surface-container-high border-none rounded-xl px-6 py-5 text-lg focus:ring-4 focus:ring-brand-blue-fixed-dim transition-all outline-none resize-none" placeholder="Tell us more about your needs..." rows="5" name="message" required></textarea>
      </div>
      <div class="pt-4">
        <button class="w-full md:w-auto bg-brand-blue text-on-brand-blue px-12 py-5 rounded-full text-xl font-black shadow-xl hover:bg-brand-blue-container hover:translate-y-[-2px] active:scale-95 transition-all flex items-center justify-center gap-3" type="submit">
          Send Message
          <span class="material-symbols-outlined" data-icon="send">send</span>
        </button>
      </div>
    </form>
  </div>
</div>