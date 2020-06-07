<?php
$this->load->view('_partials/header');
?>
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
            <div class="column is-8">
                <article class="media">
                    <figure class="media-left">
                        <p class="image is-128x128 is-round">
                            <img src="https://bulma.io/images/placeholders/128x128.png">
                        </p>
                    </figure>
                    <div class="media-content" style="width: 500px; margin-top: 1.5rem">
                        <div class="content">
                            <div class="columns">
                                <div class="column is-5">
                                    <p class="title is-4">
                                        Americano
                                    </p>
                                    <p class="subtitle is-5">
                                        Rp. 14000
                                    </p>
                                </div>
                                <div class="column is-5" style="margin-top: 0.5rem">
                                    <div class="field has-addons">
                                        <p class="control">
                                            <a href="" class="button is-primary">
                                                <i class="fa fa-angle-left" aria-hidden="true"></i>
                                            </a>
                                        </p>
                                        <p class="control" style="width: 3rem">
                                            <input type="text" class="input" style="text-align:center">
                                        </p>
                                        <p class="control">
                                            <div class="button is-primary">
                                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                                            </div>
                                        </p>
                                    </div>
                                </div>
                                <div class="column" style="margin-top: 1rem">
                                    <button class="delete"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
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
                                <tbody>
                                    <tr">
                                        <td width="3rem"></i></td>
                                        <td>
                                            <p class="subtitle is-6">
                                                Americano
                                            </p>
                                        </td>
                                        <td>
                                            <p class="subtitle is-6" style="text-align: right;">
                                                1
                                            </p>
                                        </td>
                                        <td style="text-align:right">
                                            <p class="subtitle is-6">
                                                Rp. 75000
                                            </p>
                                        </td>
                                        </tr>
                                        <tr>
                                            <td width="3rem"></i></td>
                                            <td>
                                                <p class="subtitle is-6">
                                                    Capuccino Mocca
                                                </p>
                                            </td>
                                            <td>
                                                <p class="subtitle is-6" style="text-align: right;">
                                                    1
                                                </p>
                                            </td>
                                            <td style="text-align:right">
                                                <p class="subtitle is-6">
                                                    Rp. 75000
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="3rem"></i></td>
                                            <td>
                                                <p class="subtitle is-6">
                                                    Capuccino Mocca
                                                </p>
                                            </td>
                                            <td>
                                                <p class="subtitle is-6" style="text-align: right;">
                                                    1
                                                </p>
                                            </td>
                                            <td style="text-align:right">
                                                <p class="subtitle is-6">
                                                    Rp. 75000
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="3rem"></i></td>
                                            <td>
                                                <p class="subtitle is-6">
                                                    Ultraa
                                                </p>
                                            </td>
                                            <td>
                                                <p class="subtitle is-6" style="text-align: right;">
                                                    1
                                                </p>
                                            </td>
                                            <td style="text-align:right">
                                                <p class="subtitle is-6">
                                                    Rp. 75000
                                                </p>
                                            </td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <footer class="card-footer">
                        <p class="card-header-title">
                            Total
                        </p>
                        <div class="card-header-title level-right">
                            Rp. 30000
                        </div>
                    </footer>
                    <footer class="card-footer">
                        <button class="button is-primary is-fullwidth is-block"> Pay </button>
                    </footer>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$this->load->view('_partials/footer')
?>