<?php
$this->load->view('_partials/header');
?>
<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
<section class="hero is-fullheight is-default is-bold">
    <section class="hero">
        <div class="hero-body">
            <div class="container">
                <h1 class="subtitle">
                    ORDER LIST
                </h1>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="columns">
            <div class="column is-8" id="CartItemList">
            </div>
            <div class="column is-5">
                <div class="card events-card">
                    <header class="card-header">
                        <p class="card-header-title">
                            Details Order
                        </p>
                    </header>
                    <div class="card-table">
                        <div class="content">
                            <table class="table">
                                <tbody id="TableItem">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <footer class="card-footer">
                        <p class="card-header-title">
                            Total
                        </p>
                        <div class="card-header-title level-right" id="TotalOrder">
                        </div>
                    </footer>
                    <footer class="card-footer" id="ischeckout">
                    </footer>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$this->load->view('_partials/footer')
?>
<script>
    $(document).ready(function() {

        // const html = '';

        ShowItemChart();
        ShowDetailItem();
        capitalize();

        function removeItem(ID) {
            $.ajax({
                type: 'post',
                url: '<?= base_url('admin/removeItemFromChart') ?>',
                dataType: 'json',
                async: false,
                data: {
                    ID: ID
                },
                success: function(data) {
                    ShowItemChart();
                    ShowDetailItem();
                    capitalize();
                }
            })
        }

        function ShowItemChart() {
            const CartItemList = document.getElementById('CartItemList');
            const UrlShowCart = '<?= base_url('admin/showcart') ?>';
            $.ajax({
                type: 'ajax',
                url: UrlShowCart,
                dataType: 'json',
                async: false,
                success: function(data) {
                    var html = '';
                    data['data'].forEach((Menu, index) => {
                        const baseUrl = '<?= base_url('/assets/menu/') ?>' + Menu['Image'];
                        html += `
                            <article class="media">
                                    <figure class="media-left">
                                        <p class="image is-128x128 is-round">
                                            <img src="${baseUrl}">
                                        </p>
                                    </figure>
                                    <div class="media-content" style="width: 500px; margin-top: 1.5rem">
                                        <div class="content">
                                            <div class="columns">
                                                <div class="column is-5">
                                                    <p class="title is-4 MenuName">
                                                        ${Menu['Menu']}
                                                    </p>
                                                    <p class="subtitle is-5">
                                                        Rp. ${Menu['Price']}
                                                    </p>
                                                </div>
                                                <div class="column is-5" style="margin-top: 0.5rem">
                                                    <div class="field has-addons">
                                                        <p class="control">
                                                            <button class="button is-primary is-light increaseQuantity" data-ID="${Menu['ID']}" data-Quantity="${Menu['Quantity']}" data-MenuID="${Menu['MenuID']}">
                                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                                            </button>
                                                        </p>
                                                        <p class="control" style="width: 3rem">
                                                            <input type="number" class="input inputQuantity" min="0" style="text-align:center; outline: none;" value="${Menu['Quantity']}" data-ID="${Menu['ID']}" data-MenuID="${Menu['MenuID']}">
                                                        </p>
                                                        <p class="control">
                                                            <button class="button is-primary is-light decreaseQuantity" data-ID="${Menu['ID']}" data-Quantity="${Menu['Quantity']}" data-MenuID="${Menu['MenuID']}">
                                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                                            </button>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="column" style="margin-top: 1rem">
                                                    <button class="delete" data-key="${Menu['ID']}"></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            `
                    })
                    CartItemList.innerHTML = html;
                    const button = document.querySelectorAll('.delete');
                    button.forEach((element, index) => {
                        const key = $(element).data('key');
                        element.addEventListener('click', function() {
                            removeItem(key);
                        })
                    });
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    html = `
                            <article class="media">
                                    <div class="media-content" style="width: 500px; margin-top: 1.5rem">
                                        <h1> There is no order yet</h1>
                                    </div>
                                </article>
                            `
                    CartItemList.innerHTML = html;
                }
            })
            // return false;
        }

        function ShowDetailItem() {
            const TableItem = document.getElementById('TableItem');
            const IsCheckout = document.getElementById('ischeckout');
            const TotalOrder = document.getElementById('TotalOrder');
            const UrlShowCart = '<?= base_url('admin/showcart') ?>';
            $.ajax({
                type: 'ajax',
                url: UrlShowCart,
                dataType: 'json',
                async: false,
                success: function(data) {
                    var html = '';
                    // var html2 = '';
                    data['data'].forEach(Menu => {
                        html += `
                                    <tr>
                                        <td width="3rem"></i></td>
                                        <td>
                                            <p class="subtitle is-6 MenuName">
                                                ${Menu['Menu']}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="subtitle is-6" style="text-align: right;">
                                                ${Menu['Quantity']}
                                            </p>
                                        </td>
                                        <td style="text-align:right">
                                            <p class="subtitle is-6">
                                                Rp. ${Menu['SubTotal']}
                                            </p>
                                        </td>
                                    </tr>
                                 `
                        IsCheckout.innerHTML = `<button class="button is-primary is-fullwidth is-block" data-OrderID="${Menu['OrderID']}" id="checkout"> Checkout </button>`;;
                    });
                    TableItem.innerHTML = html;
                    TotalOrder.innerHTML = ` Rp. ${data['Total']['TotalOrder']}`;

                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    html = `
                                    <tr>
                                        <td width="3rem"></i></td>
                                        <td colspan=3>
                                            <p class="subtitle is-6 MenuName">
                                            There is no order yet
                                            </p>
                                        </td>
                                    </tr>
                                 `
                    TableItem.innerHTML = html;
                }
            })
            return false;
        }

        function updateQuantity(ID, MenuID, Quantity) {
            $.ajax({
                type: 'POST',
                url: '<?= base_url('admin/updateQuantity'); ?>',
                dataType: 'json',
                data: {
                    ID: ID,
                    MenuID: MenuID,
                    Quantity: Quantity
                },
                success: function(data) {
                    ShowItemChart();
                    ShowDetailItem();
                    capitalize();

                    const inputQuantity = document.querySelectorAll('input.inputQuantity');
                    inputQuantity.forEach((element, index) => {
                        element.addEventListener('change', function() {
                            const ID = $(element).data('id');
                            const MenuID = $(element).data('menuid');
                            const Quantity = $(element).val();
                            updateQuantity(ID, MenuID, Quantity);
                        });
                    })

                    const increaseQuantity = document.querySelectorAll('button.increaseQuantity');
                    increaseQuantity.forEach((element, index) => {
                        element.addEventListener('click', function() {
                            const Quantity = $(element).data('quantity');
                            const ID = $(element).data('id');
                            const MenuID = $(element).data('menuid');
                            updateQuantity(ID, MenuID, Quantity + 1);
                        })
                    });


                    const decreaseQuantity = document.querySelectorAll('button.decreaseQuantity');
                    decreaseQuantity.forEach((element, index) => {
                        element.addEventListener('click', function() {
                            const Quantity = $(element).data('quantity');
                            const ID = $(element).data('id');
                            const MenuID = $(element).data('menuid');
                            updateQuantity(ID, MenuID, Quantity - 1);
                        })
                    });
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert('Minimal Item 1');
                }
            })
            return false;
        }

        const inputQuantity = document.querySelectorAll('input.inputQuantity');
        inputQuantity.forEach((element, index) => {
            element.addEventListener('change', function() {
                const ID = $(element).data('id');
                const MenuID = $(element).data('menuid');
                const Quantity = $(element).val();
                updateQuantity(ID, MenuID, Quantity);
            });
        })

        function capitalize() {
            const MenuName = document.querySelectorAll('p.MenuName');
            MenuName.forEach(element => {
                element.style.textTransform = "capitalize"
            });
        }

        const increaseQuantity = document.querySelectorAll('button.increaseQuantity');
        increaseQuantity.forEach((element, index) => {
            element.addEventListener('click', function() {
                const Quantity = $(element).data('quantity');
                const ID = $(element).data('id');
                const MenuID = $(element).data('menuid');
                updateQuantity(ID, MenuID, Quantity + 1);
            })
        });

        const decreaseQuantity = document.querySelectorAll('button.decreaseQuantity');
        decreaseQuantity.forEach((element, index) => {
            element.addEventListener('click', function() {
                const Quantity = $(element).data('quantity');
                const ID = $(element).data('id');
                const MenuID = $(element).data('menuid');
                updateQuantity(ID, MenuID, Quantity - 1);
            })
        });

        const CheckoutCart = document.getElementById('checkout');
        CheckoutCart.addEventListener('click', function() {
            const OrderID = $(CheckoutCart).data('orderid');
            $.ajax({
                type: 'post',
                url: '<?= base_url('admin/checkoutCart') ?>',
                dataType: 'json',
                data: {
                    OrderID: OrderID
                },
                success: function(data) {
                    // console.log(data);
                    ShowItemChart();
                    ShowDetailItem();
                    capitalize();

                    const inputQuantity = document.querySelectorAll('input.inputQuantity');
                    inputQuantity.forEach((element, index) => {
                        element.addEventListener('change', function() {
                            const ID = $(element).data('id');
                            const MenuID = $(element).data('menuid');
                            const Quantity = $(element).val();
                            updateQuantity(ID, MenuID, Quantity);
                        });
                    })

                    const increaseQuantity = document.querySelectorAll('button.increaseQuantity');
                    increaseQuantity.forEach((element, index) => {
                        element.addEventListener('click', function() {
                            const Quantity = $(element).data('quantity');
                            const ID = $(element).data('id');
                            const MenuID = $(element).data('menuid');
                            updateQuantity(ID, MenuID, Quantity + 1);
                        })
                    });

                    const decreaseQuantity = document.querySelectorAll('button.decreaseQuantity');
                    decreaseQuantity.forEach((element, index) => {
                        element.addEventListener('click', function() {
                            const Quantity = $(element).data('quantity');
                            const ID = $(element).data('id');
                            const MenuID = $(element).data('menuid');
                            updateQuantity(ID, MenuID, Quantity - 1);
                        })
                    });
                }
            })
        })
        // console.log(OrderID);
    })
</script>