<?php  session_start(); ?>
<?php include('../server/connection.php'); ?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Hello World!</title>
    <meta
      http-equiv="Content-Security-Policy"
      content="script-src 'self' 'unsafe-inline';"
    />
    <link
      href="./node_modules/bootstrap/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/index.css" />
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="stylesheet" href="../assets/css/edit_product.css">
  </head>
  <body>
    <nav
      class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-3 shadow"
    >
      <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#"
        >CAT COMPANY</a
      >
      <?php if(isset($_SESSION['admin_logged_in'])){ ?>
      <input
        class="form-control form-control-dark w-100"
        type="text"
        placeholder="Search"
        aria-label="Search"
      />
      <?php };?>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <?php if(isset($_SESSION['admin_logged_in'])){ ?>
          <a class="nav-link" href="logout.php?logout=1">Sign out</a>
          <?php };?>
        </li>
      </ul>
    </nav>