<h2>Our services</h2>

<p>Please read about some of our services that are available.</p>

<?php if (empty($services)): ?>

  <p>Sorry, no services available.</p>

<?php else: ?>

  <dl class="service-list">
    <?php foreach ($services as $serviceName => $serviceDesc): ?>
      <dt><?= $serviceName ?></dt>
      <dd><?= $serviceDesc ?></dd>
    <?php endforeach ?>
  </dl>

<?php endif ?>