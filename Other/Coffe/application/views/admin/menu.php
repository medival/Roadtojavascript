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
        </div>
    </section>
</section>
<?php
$this->load->view('_partials/footer')
?>
<script>
    const endpoint = '<?= base_url('admin/getmenu') ?>';
    const menuList = document.getElementById('menuList');
    // const listMenu = [];
    // fetch(endpoint)
    //     .then(result => result.json())
    //     .then(data => listMenu.push(data));

    fetch(endpoint)
        .then((resp) => resp.json())
        .then((data) => {
            const html = data.map((list) => {
                // console.log(list.MenuID);
                const baseUrl = '<?= base_url('/assets/menu/'); ?>'
                return `<div class="column">
                            <div class="card" style="width:200px">
                                <div class="card-content">
                                    <div class="card-image has-text-centered">
                                        <figure class="image">
                                            <img src="${baseUrl + list.Image}">
                                        </figure>
                                        <br>
                                        <p class="title is-5" style="margin-bottom:2rem;"> ${list.Menu} </p>
                                        <p class="subtitle is-6"> Rp. ${list.Price} </p>
                                    </div>
                                </div>
                                <footer class="card-footer">
                                    <button class="button is-primary is-fullwidth btnAdd" type="submit" onClick="addToCart(${list.MenuID})"> Add </button>
                                </footer>
                            </div>
                        </div>`;
            }).join('');
            menuList.innerHTML = html;
        });

    function addToCart(MenuID) {
        // const MenuID = MenuID;
        $.ajax({
            type: 'post',
            url: "<?= base_url('admin/addToCart') ?>",
            dataType: 'JSON',
            data: {
                MenuID: MenuID
            },
            success: function(data) {
                console.log('scc');
            }
        })
        console.log(MenuID)
        // return false;
    }
</script>