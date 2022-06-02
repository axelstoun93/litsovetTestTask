<?= $this->extend('layout/page') ?>

<?= $this->section('meta') ?>
<title><?= $title ?></title>
    <meta content="<?= $description ?>" name="description">
    <meta name="googlebot" content="noindex">
<?= $this->endSection() ?>

<?= $this->section('sidebar') ?>
<?= $sidebar ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?= $content ?>
<?= $this->endSection() ?>

<?= $this->section('footer') ?>
<?= $footer ?>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<?= $this->endSection() ?>
