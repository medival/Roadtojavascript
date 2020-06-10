<?php
$this->load->view('_partials/header')
?>
<section class="hero is-fullheight is-default is-bold">
    <section class="hero">
        <div class="hero-body">
            <div class="container has-text-centered">
                <h1 class="title">
                    Menu
                </h1>
                <h2 class="subtitle">
                    Coffe available
                </h2>
            </div>
        </div>
    </section>

    <section class="container ">
        <div class="columns features is-multiline" id="menuList">
            <?php foreach ($menu as $key => $Menu) : ?>
                <div class="column">
                    <div class="card" style="width:200px">
                        <div class="card-content">
                            <div class="card-image has-text-centered">
                                <figure class="image">
                                    <img src="<?= base_url('assets/menu/' . $Menu->Image); ?>">
                                </figure>
                                <br>
                                <p class="title is-5 MenuName" style="margin-bottom:2rem;"> <?= $Menu->Menu ?> </p>
                                <p class="subtitle is-6"> Rp. <?= $Menu->Price ?> </p>
                            </div>
                        </div>
                        <footer class="card-footer">
                            <button class="add_cart button is-primary is-fullwidth" data-MenuID="<?= $Menu->MenuID; ?>" data-Menu="<?= $Menu->Menu ?>" data-Price="<?= $Menu->Price ?>" data-image="<?= $Menu->Image ?>"> Add </button>
                        </footer>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</section>

<?php
$this->load->view('_partials/footer')
?>
<script>
    $(document).ready(function() {

        capitalize();

        const detailCart = document.getElementById('detail_cart');

        $('.add_cart').on('click', function() {
            console.log(this);
            var MenuID = $(this).data("menuid");
            var Menu = $(this).data("menu");
            var Image = $(this).data("image");
            var Price = $(this).data("price");
            console.log(MenuID, Menu, Image, Price);
            $.ajax({
                type: 'POST',
                url: '<?= base_url('admin/addtocart'); ?>',
                data: {
                    MenuID: MenuID,
                    Menu: Menu,
                    Image: Image,
                    Price: Price
                },
                success: function(data) {
                    $(detailCart).html(data)
                }
            })
        });

        function capitalize() {
            const MenuName = document.querySelectorAll('p.MenuName');
            MenuName.forEach(element => {
                element.style.textTransform = "capitalize"
            });
        }
    })
</script>