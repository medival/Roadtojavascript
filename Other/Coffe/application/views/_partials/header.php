<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.8.2/css/bulma.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Coffeshop</title>
    <style type="text/css">
        html,
        body {
            font-family: 'Open Sans';
        }

        img {
            padding: 5px;
            border: 1px solid #ccc;
        }

        .column {
            display: flex;
            flex-direction: column;
        }
    </style>
</head>

<style type="text/css">
    html,
    body {
        font-family: 'Open Sans';
    }

    img {
        padding: 5px;
        border: 1px solid #ccc;
    }
</style>

<body>

    <nav class="navbar">
        <div class="container">
            <div class="navbar-brand">
                <a class="navbar-item" href="../">
                    <img src="https://github.githubassets.com/images/modules/logos_page/GitHub-Mark.png" alt="Logo">
                </a>
                <span class="navbar-burger burger" data-target="navbarMenu">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </div>
            <div id="navbarMenu" class="navbar-menu">
                <div class="navbar-end">
                    <div class="tabs is-right">
                        <li class="<?php echo ($this->uri->segment(2) == 'index') || ($this->uri->segment(2) == '') ? 'is-active' : '' ?>">
                            <a href="<?= base_url('admin/index'); ?>">Home</a>
                        </li>
                        <li class="<?php echo $this->uri->segment(2) == 'menu' ? 'is-active' : '' ?>">
                            <a href="<?= base_url('admin/menu') ?>">Menu</a>
                        </li>
                        <li class="<?php echo $this->uri->segment(2) == 'order' ? 'is-active' : '' ?>">
                            <a href="<?= base_url('admin/order') ?>"> Order
                                <i class="fa fa-shopping-cart is-primary" aria-hidden="true"></i>
                            </a>
                        </li>
                    </div>
                </div>
            </div>
        </div>
    </nav>