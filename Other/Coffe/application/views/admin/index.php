<?php
$this->load->view('_partials/header.php');
?>
<section class="hero is-medium">
    <div class="hero-body">
        <div class="container has-text-centered">
            <h1 class="title is-2">
                Superhero Scaffolding
            </h1>
            <h2 class="subtitle is-4">
                Let this cover page describe a product or service.
            </h2>
            <br>
            <p class="has-text-centered">
                <a class="button is-medium is-info is-outlined" href="<?= base_url('admin/menu') ?>">
                    Order Now
                </a>
            </p>
        </div>
</section>
<?php
$this->load->view('_partials/footer.php');
?>